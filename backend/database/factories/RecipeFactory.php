<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $dateTime = $this->faker->dateTimeThisCentury;
        return [
            'name' => $this->faker->text(50),
            'instructions' => $this->faker->text(50),
            'preparation_time' => $dateTime->format('H:i:00'),
            'users_id' => User::inRandomOrder()->first()->id,
            'update_id' => User::inRandomOrder()->first()->id,
            'approved_id' => User::inRandomOrder()->where('role', 'admin')->first()->id
        ];
    }
}
