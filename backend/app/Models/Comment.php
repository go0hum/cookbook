<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function recipes(): HasOne
    {
        return $this->hasOne(Recipe::class);
    } 

    public function users(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
