<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Http\Resources\IngredientResource;
use App\Http\Resources\PaginateResource;

class IngredientController extends Controller
{
    public function index(Request $request)
    {
        $query = Ingredient::query();
        $perPage = $request->input('per_page', 10); 
        $paginate = $query->paginate($perPage);

        return new PaginateResource($paginate, IngredientResource::class);
    }

    public function show(Ingredient $ingredient)
    {
        return new IngredientResource($ingredient); 
    }

    public function store(Request $request)
    {
        $ingredient = new Ingredient;
        $ingredient->name = $request->input('name', ""); 
        $ingredient->quantity = $request->input('quantity', 0); 
        $ingredient->save(); 
         return(new IngredientResource($ingredient))
               ->response()
               ->setStatusCode(201);
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $ingredient->name = $request->input('name', ""); 
        $ingredient->quantity = $request->input('quantity', 0); 
        $ingredient->save(); 
        return new IngredientResource($ingredient);  
    }

    public function destroy(Ingredient $ingredient)
    {
        $ingredientId = $ingredient->id ?? 0;
        Recipe::whereHas('ingredients', function ($query) use ($ingredientId) {
            $query->where('ingredient_id', $ingredientId);
        })->get()->each(function ($recipe) use ($ingredientId) {
            $recipe->ingredients()->detach($ingredientId);
        });

        $ingredient->delete();
        return new IngredientResource($ingredient); 
    }
}
