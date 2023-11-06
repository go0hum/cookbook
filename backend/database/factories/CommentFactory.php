<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Recipe;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'comment' => $this->faker->sentence,
            'stars' => rand(1,5),
            'recipe_id' => function () {
                return Recipe::inRandomOrder()->first()->id; //Recipe::factory(5)->create();
            },
            'users_id' => function () {
                return User::inRandomOrder()->first()->id; //User::factory(5)->create();
            }
        ];
    }
}
