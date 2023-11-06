<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;


// login
Route::post('login', [LoginController::class, 'login']);
// recipes
Route::get('recipes', [RecipeController::class, 'index']);
Route::get('recipes/{recipe}', [RecipeController::class, 'show']);
//ingredients
Route::get('ingredients', [IngredientController::class, 'index']);
Route::get('ingredients/{ingredient}', [IngredientController::class, 'show']);

Route::middleware('auth:sanctum')->group(function() {
    //user
    Route::get('users/{user}', [UserController::class, 'show']); 
    // recipes
    Route::post('recipes', [RecipeController::class, 'store']);
    Route::put('recipes/{recipe}', [RecipeController::class, 'update']);
    Route::delete('recipes/{recipe}', [RecipeController::class, 'destroy']);
    //ingredients
    Route::post('ingredients', [IngredientController::class, 'store']);
    Route::put('ingredients/{ingredient}', [IngredientController::class, 'update']);
    Route::delete('ingredients/{ingredient}', [IngredientController::class, 'destroy']);
    // Comment
    Route::get('comments', [CommentController::class, 'index']);
    Route::post('comments', [CommentController::class, 'store']);
    Route::delete('comments/{comment}', [CommentController::class, 'destroy']);
    // Favorite
    Route::get('favorites', [FavoriteController::class, 'index']);
    Route::post('favorites', [FavoriteController::class, 'store']);
    Route::delete('favorites/{favorite}', [FavoriteController::class, 'destroy']);
});
