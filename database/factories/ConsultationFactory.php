<?php

namespace Database\Factories;

use App\Models\ConsultationCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consultation>
 */
class ConsultationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'closed' => fake()->boolean(),
            'user_id' => User::factory(),
            'specialization_id' => fake()->numberBetween(1, 5),
            'created_at' => fake()->dateTimeBetween('29.11.2023', '05.12.2023'),
            'updated_at' => fake()->dateTimeBetween('29.11.2023', '05.12.2023'),
        ];
    }
}
