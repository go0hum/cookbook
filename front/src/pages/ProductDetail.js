import { useEffect, useState } from "react"
import { useParams } from "react-router-dom";
import { toast } from "react-toastify";
import { useTitle } from "../hooks/useTitle";
import { Rating } from "../components";
import { useCart } from "../context";
import { getProduct } from "../services";

export const ProductDetail = () => {
  const { cartList, addToCart, removeFromCart } = useCart();
  const [inCart, setInCart] = useState(false);
  const [product, setProduct] = useState({});
  const { id } = useParams();
  useTitle(product.name);
  
  useEffect(() => {
    async function fetchProducts(){
      try{
        const data = await getProduct(id);
        setProduct(data);
      } catch(error){
        toast.error(error.message, {closeButton: true, position: "bottom-center" });
      }      
    }
    fetchProducts();
  }, [id]);

  useEffect(() => {
    const productInCart = cartList.find(item => item.id === product.id);

    if(productInCart){
        setInCart(true);
    } else {
        setInCart(false);
    }

  }, [cartList, product.id]);

  return (
    <main>
        <section>
          <h1 className="mt-10 mb-5 text-4xl text-center font-bold text-gray-900 dark:text-slate-200">{product.name}</h1>
          <div className="flex flex-wrap justify-around">
            <div className="max-w-xl my-3">
              <p className="text-lg text-gray-900 dark:text-slate-200">
                {product.instructions}
              </p>
              <p className="my-3"> 
                <span>
                  <Rating rating={product.rating} />
                </span>
              </p>
              <p className="my-4 select-none">
                <span className="font-semibold text-blue-500 border bg-slate-100 rounded-lg px-3 py-1 mr-2">{product.size} PZA</span>
              </p>
            </div>
            <div className="max-w-xl my-3">
              <p className="my-3">
                { !inCart && <button onClick={() => addToCart(product)} className={`inline-flex items-center py-2 px-5 text-lg font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800`}>Add To Cart <i className="ml-1 bi bi-plus-lg"></i></button> } 
                { inCart && <button onClick={() => removeFromCart(product)} className={`inline-flex items-center py-2 px-5 text-lg font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800`} >Remove Item <i className="ml-1 bi bi-trash3"></i></button> }  
              </p>
            </div>
          </div>
        </section>
      </main> 
  )
}
