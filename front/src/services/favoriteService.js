import { getSession } from './dataService';

export async function getFavoriteList()
{
    const browserData = getSession();
    const requestOptions = {
        method: "GET",
        headers: {"Content-Type": "application/json", Authorization: `Bearer ${browserData.token}`}
    }

    const response = await fetch(`${process.env.REACT_APP_HOST}/favorites`, requestOptions);
    if(!response.ok){
        throw { message: response.statusText, status: response.status }; //eslint-disable-line
    }
    const data = await response.json()
    console.log(data);
    return data;
}

export const removeFromFav = (id) => {
    /*const navigate = useNavigate();
    async function fetchRemoveFav(){
        try{
          await deleteFavoriteList(id);
        } catch(error){
          toast.error(error.message, {closeButton: true, position: "bottom-center" });
        }
      }
      fetchRemoveFav();*/
}