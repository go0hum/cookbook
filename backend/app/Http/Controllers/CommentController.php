<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comment;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PaginateResource;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $query = Comment::query();
        $perPage = $request->input('per_page', 10); 
        $paginate = $query->paginate($perPage);

        if ($request->has('recipe_id')) {
            $recipe_id = $request->input('recipe_id', 0);
            $query->where('recipe_id', $recipe_id);
        }

        return new PaginateResource($paginate, CommentResource::class);
    }

    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->comment = $request->input('comment', ""); 
        $comment->stars = $request->input('stars', 0); 
        $comment->recipe_id = $request->input('recipe_id', 0); 
        $comment->users_id = $request->input('users_id', Auth::user()->id); 
        $comment->save(); 
         return(new CommentResource($comment))
               ->response()
               ->setStatusCode(201);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return new CommentResource($comment); 
    }
}
