<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Favorite;
use App\Http\Resources\FavoriteResource;
use App\Http\Resources\PaginateResource;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $query = Favorite::query();
        $query->where('users_id', Auth::user()->id);
        $perPage = $request->input('per_page', 10); 
        $paginate = $query->paginate($perPage);
        return new PaginateResource($paginate, FavoriteResource::class);
    }

    public function store(Request $request)
    {
        $favorite = new Favorite;
        $favorite->recipe_id = $request->input('recipe_id', 0); 
        $favorite->users_id = $request->input('users_id', Auth::user()->id); 
        $favorite->save(); 
         return(new FavoriteResource($favorite))
               ->response()
               ->setStatusCode(201);
    }

    public function destroy(Favorite $favorite)
    {
        $favorite->delete();
        return new FavoriteResource($favorite); 
    }
}
