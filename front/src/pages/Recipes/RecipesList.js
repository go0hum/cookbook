import { useEffect, useState } from "react";
import { getProductList } from "../../services";
import { toast } from "react-toastify";

export const RecipesList = () => {

    const [recipes, setRecipes] = useState([]);
    
    useEffect(() => {
        async function fetchProducts(){
          try{
            const data = await getProductList();
            setRecipes(data.data); 
          } catch(error){
            toast.error(error.message, {closeButton: true, position: "bottom-center" });
          }
        }
        fetchProducts();
      }, []);

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
                    Instructions
                </th>
                <th scope="col" class="px-6 py-3">
                    Preparation time
                </th>
                <th scope="col" class="px-6 py-3">
                </th>
            </tr>
        </thead>
        <tbody>

            { recipes.map((recipe) => (
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {recipe.name}
                </th>
                <td class="px-6 py-4">
                    {recipe.instructions}
                </td>
                <td class="px-6 py-4">
                    {recipe.preparation_time}
                </td>
                <td class="px-6 py-4">
                    View | Delete | Approved
                </td>
            </tr>
            )) } 
        </tbody>
    </table>
</div>
</section>
</main>
)}