<?php

namespace Database\Factories;

use App\Models\Vebinar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VebinarProgram>
 */
class VebinarProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'time_start' => fake()->time(),
            'subject' => fake()->text(),
            'lector_description' => fake()->name(),
            'lector_department' => fake()->text(),
            'lector_photo' => fake()->imageUrl(354, 472, 'people', true),
            'vebinar_id' => Vebinar::factory(),
        ];
    }
}
