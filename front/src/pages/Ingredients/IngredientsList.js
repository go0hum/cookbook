import { useEffect, useState } from "react";
import { getIngredientList, deleteIngredient } from "../../services";
import { toast } from "react-toastify";
import { Link } from "react-router-dom";

export const IngredientsList = () => {

    const [ingredients, setIngredients] = useState([]);
    
    useEffect(() => {
        async function fetchProducts(){
          try{
            const data = await getIngredientList();
            setIngredients(data.data); 
          } catch(error){
            toast.error(error.message, {closeButton: true, position: "bottom-center" });
          }
        }
        fetchProducts();
      }, []);

      const HandleDelete = (ingredient) => {
        async function deleteCommentFunc() {
            try{
                const data = await deleteIngredient(ingredient.id);
                const newData = ingredients.filter((ingredient) => ingredient.id != data.data.id);
                setIngredients(newData);
            } catch(error){
            toast.error(error.message, {closeButton: true, position: "bottom-center" });
            }
        }
        deleteCommentFunc();
    }

    return (<main>
        <section className="my-5">
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                </th>
            </tr>
        </thead>
        <tbody>

            { ingredients.map((ingredient) => (
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {ingredient.name}
                </th>
                <td class="px-6 py-4">
                <Link to={`/edit-ingredient/${ingredient.id}`} >View</Link>  | <Link onClick={() => HandleDelete(ingredient)} >Delete</Link> 
                </td>
            </tr>
            )) } 
        </tbody>
    </table>
</div>
</section>
</main>
)}