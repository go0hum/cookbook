import { useEffect, useState } from "react";
import { useLocation } from "react-router-dom";
import { useTitle } from "../../hooks/useTitle";

import { ProductCard } from "../../components";

import { getProductList } from "../../services";
import { toast } from "react-toastify";

export const ProductsList = () => {
  const [products, setProducts] = useState([]);
  const search = useLocation().search;
  const searchTerm = new URLSearchParams(search).get("search");
  const type = new URLSearchParams(search).get("type");
  useTitle("Explore eBooks Collection");
 
  useEffect(() => {
    async function fetchProducts(){
      try{
        const data = await getProductList(type, searchTerm);
        setProducts(data.data); 
      } catch(error){
        toast.error(error.message, {closeButton: true, position: "bottom-center" });
      }
    }
    fetchProducts();
  }, [searchTerm]);

  return (
    <main>
        <section className="my-5">
          <div className="my-5 flex justify-between">
            <span className="text-2xl font-semibold dark:text-slate-100 mb-5">All recipes ({products.length})</span>
          
          </div>    

          <div className="flex flex-wrap justify-center lg:flex-row">
            { products.map((product) => (
              <ProductCard key={product.id} product={product} />
            )) }            
          </div>  
        </section>
    </main> 
  )
}
