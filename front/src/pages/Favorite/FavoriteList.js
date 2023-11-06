import { useEffect, useState } from "react";
import { useLocation } from "react-router-dom";
import { useTitle } from "../../hooks/useTitle";

import { ProductCard } from "../../components";

import { getFavoriteList } from "../../services";
import { toast } from "react-toastify";

export const FavoriteList = () => {
  const [products, setProducts] = useState([]);

  useTitle("Explore Favorites Collection");
 
  useEffect(() => {
    async function fetchProducts(){
      try{
        const data = await getFavoriteList();
        setProducts(data.data); 
      } catch(error){
        toast.error(error.message, {closeButton: true, position: "bottom-center" });
      }
    }
    fetchProducts();
  }, []);

  return (
    <main>
        <section className="my-5">
          <div className="my-5 flex justify-between">
            <span className="text-2xl font-semibold dark:text-slate-100 mb-5">All favorites ({products.length})</span>
          
          </div>    

          <div className="flex flex-wrap justify-center lg:flex-row">
            { products.map((product) => (
              <ProductCard key={product.recipes.id} product={product} />
            )) }            
          </div>  
        </section>
    </main> 
  )
}
