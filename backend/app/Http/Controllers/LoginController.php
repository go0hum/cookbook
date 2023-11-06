<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Business\AbilitiesResolver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;

class LoginController extends Controller
{
    public function login()
    {
        $user = User::where('email', request('email'))->first();
        
        if ($user && Hash::check(request('password'), $user->password)) {
            $token = $user->createToken('login', AbilitiesResolver::resolveAbilities($user));
            
            return [
                'token' => $token->plainTextToken,
                'user' => new UserResource($user)
            ]; 
        }

        return response()->json([
            'message' => 'invalid credentials'
        ], 401);
    }

}
