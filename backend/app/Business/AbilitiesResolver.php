<?php
namespace App\Business;

use App\Models\User;

class AbilitiesResolver 
{
    public static function resolveAbilities(User $user)
    {
        return match($user->role) {
            'admin' => [
                'comment:store',
                'comment:destroy',
                'favorites:add',
                'favorites:destroy',
                'recipes:update',
                'recipes:destroy',
                'recipes:store',
                'ingredient:index',
                'ingredient:update',
                'ingredient:destroy',
                'ingredient:store',
                'ingredient:index',
            ],
            'authenticate' => [
                'comment:store',
                'favorites:add',
                'favorites:delete',
            ],
            default => []
        };
    }
}