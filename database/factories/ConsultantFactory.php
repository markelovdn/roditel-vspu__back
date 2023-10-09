<?php

namespace Database\Factories;

use App\Models\Contract;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consultant>
 */
class ConsultantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'photo' => fake()->imageUrl(354, 472, 'people', true),
            'description' => fake()->text(),
            'user_id' => User::factory(),
            'specialization_id' => fake()->numberBetween(1,5),
            'profession_id' => fake()->numberBetween(1,3),
        ];
    }
}
