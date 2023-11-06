export async function getProductList(typeTerm, searchTerm){
    const response = await fetch(`${process.env.REACT_APP_HOST}/recipes?type=${typeTerm ? typeTerm : ""}&search=${searchTerm ? searchTerm : ""}`);
    if(!response.ok){
        throw { message: response.statusText, status: response.status }; //eslint-disable-line
    }
    const data = await response.json()
    return data;
}

export async function getProduct(id){
    const response = await fetch(`${process.env.REACT_APP_HOST}/recipes/${id}`);
    if(!response.ok){
        throw { message: response.statusText, status: response.status }; //eslint-disable-line
    }
    const data = await response.json()
    return data.data;
}
