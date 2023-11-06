<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Favorite extends Model
{
    use HasFactory;

    public function recipes(): HasOne
    {
        return $this->hasOne(Recipe::class, 'id', 'recipe_id');
    } 

    public function users(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }
}
