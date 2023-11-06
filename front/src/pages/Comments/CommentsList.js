import { useEffect, useState } from "react";
import { getCommentList, deleteComment } from "../../services";
import { toast } from "react-toastify";
import { Link } from "react-router-dom";

export const CommentsList = () => {

    const [comments, setComments] = useState([]);
    
    useEffect(() => {
        async function fetchProducts(){
            try{
              const data = await getCommentList();
              setComments(data.data); 
            } catch(error){
              toast.error(error.message, {closeButton: true, position: "bottom-center" });
            }
        }
        fetchProducts();
    }, []);

    const HandleDelete = (comment) => {
        async function deleteCommentFunc() {
            try{
                const data = await deleteComment(comment.id);
                const newData = comments.filter((comment) => comment.id != data.data.id);
                setComments(newData);
            } catch(error){
            toast.error(error.message, {closeButton: true, position: "bottom-center" });
            }
        }
        deleteCommentFunc();
    }

    return (<main>
        <section className="my-5">
<div className="relative overflow-x-auto">
    <table className="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" className="px-6 py-3">
                    Name
                </th>
                <th scope="col" className="px-6 py-3">
                    Rating
                </th>
                <th scope="col" className="px-6 py-3">
                </th>
            </tr>
        </thead>
        <tbody>

            { comments.map((comment) => (
              <tr className="bg-white border-b dark:bg-gray-800 dark:border-gray-700" key={comment.id}>
                <th scope="row" className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {comment.comment}
                </th>
                <td className="px-6 py-4">
                    {comment.stars}
                </td>
                <td className="px-6 py-4">
                    <Link onClick={() => HandleDelete(comment)} className="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete</Link>
                </td>
            </tr>
            )) } 
        </tbody>
    </table>
</div>
</section>
</main>
)}