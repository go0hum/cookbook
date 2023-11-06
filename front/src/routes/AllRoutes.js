import { Routes, Route } from "react-router-dom";
import { HomePage, ProductsList, ProductDetail, Login, Register, CartPage, PageNotFound, FavoriteList, AddProduct, RecipesList, CommentsList, IngredientsList, IngredientsEdit } from "../pages";
import { ProtectedRoute } from "./ProtectedRoute";

export const AllRoutes = () => {
  return (
    <>
    <Routes>
        <Route path="/" element={<HomePage />} />
        <Route path="products" element={<ProductsList />} />
        <Route path="products/:id" element={<ProductDetail />} />
        <Route path="favorites" element={<FavoriteList />} />

        <Route path="login" element={<Login />} />
        <Route path="register" element={<Register />} />

        <Route path="cart" element={<CartPage />} />
        <Route path="add-recipes" element={<ProtectedRoute><AddProduct /></ProtectedRoute>} />
        <Route path="recipes" element={<ProtectedRoute><RecipesList /></ProtectedRoute>} />
        <Route path="ingredients" element={<ProtectedRoute><IngredientsList /></ProtectedRoute>} />
        <Route path="comments" element={<ProtectedRoute><CommentsList /></ProtectedRoute>} />
        <Route path="edit-ingredient/:id" element={<ProtectedRoute><IngredientsEdit /></ProtectedRoute>} />
        

        <Route path="*" element={<PageNotFound />} />
    </Routes>
    </>
  )
}
