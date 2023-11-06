<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\Cart;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Humberto',
            'email' => 'test@example.com',
            'password' => bcrypt('helloworld'),
            'role' => 'admin'
       ]);

        $ingredients = Ingredient::factory(10)->create();

        Recipe::factory(20)->create()->each(function($recipe) use($ingredients) {
            $numberOfIngredients = rand(0, 6);
            if ($numberOfIngredients) {
                $recipe->ingredients()->attach(
                    $ingredients->random($numberOfIngredients)->pluck('id')->toArray()
                ); 
            }
        });

         $this->call(CommentSeeder::class);
         $this->call(FavoriteSeeder::class);
    }
}
