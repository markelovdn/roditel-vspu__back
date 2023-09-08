<?php

namespace Database\Factories;

use App\Models\Consultant;
use App\Models\Parented;
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
            'parented_id' => fake()->numberBetween(1,5),
            'consultant_id' => fake()->numberBetween(1,5),
            'status' => fake()->numberBetween(1,2),
        ];
    }
}
