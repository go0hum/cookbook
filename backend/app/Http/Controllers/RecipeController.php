<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Recipe;
use App\Http\Resources\RecipeResource;
use App\Http\Resources\PaginateResource;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function index(Request $request) : PaginateResource
    {
        $query = Recipe::query();
        $query->with('userOne', 'approved', 'ingredients');

        if ($request->has('type')) {
            $type = $request->input('type', "");
            $search = $request->input('search', '');

            $name = match($type) {
                'name' => "name",
                'time' => "preparation_time",
                'ingredient' => "ingredient",
                default => false
            };

            if ($name == 'name') {
                $query->where($name, 'like', '%' . $search . '%');
            }

            if ($name == 'preparation_time') {
                $query->where($name, $search);
            }

            if ($name == 'ingredient') {
                $query->whereHas('ingredients', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
            }
        }

        $perPage = $request->input('per_page', 10); 
        $paginated = $query->paginate($perPage);

        return new PaginateResource($paginated, RecipeResource::class);
    }

    public function show(Recipe $recipe)
    {
        return new RecipeResource($recipe);  
    }

    public function store(Request $request)
    {
        $recipe = new Recipe;
        $recipe->name = $request->input('name', ""); 
        $recipe->instructions = $request->input('instructions', ""); 
        $recipe->preparation_time = $request->input('preparation_time', "0:00"); 
        $recipe->users_id = $request->input('users_id', Auth::user()->id); 
        $recipe->update_id = $request->input('update_id', Auth::user()->id); 
        $recipe->approved_id = $request->input('approved_id', 0);
        $recipe->save(); 
         return(new RecipeResource($recipe))
               ->response()
               ->setStatusCode(201);
    }

    public function update(Request $request, Recipe $recipe)
    {
        $recipe->name = $request->input('name'); 
        $recipe->instructions = $request->input('instructions'); 
        $recipe->preparation_time = $request->input('preparation_time'); 
        $recipe->users_id = $request->input('users_id'); 
        $recipe->update_id = $request->input('update_id', Auth::user()->id); 
        $recipe->approved_id = $request->input('approved_id', 0);
        $recipe->save();
        return new RecipeResource($recipe);  
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return new RecipeResource($recipe);  
    }
}
