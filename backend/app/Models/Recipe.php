<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'instructions',
        'preparation_time',
        'users_id',
        'update_id',
        'approved_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }

    public function favorite(): BelongsTo
    {
        return $this->belongsTo(Favorite::class);
    }

    public function userOne(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }

    public function approved(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'approved_id');
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class, 'recipes_ingredients', 'recipe_id', 'ingredient_id');
    }
}
