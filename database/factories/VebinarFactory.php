<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vebinar>
 */
class VebinarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->text(),
            'date' => fake()->date(),
            'time_start' => fake()->time(),
            'time_end' => fake()->time(),
            'lector_name' => fake()->name(),
            'logo' => fake()->imageUrl(354, 472, 'people', true),
            'video_link' =>fake()->url(),
            'vebinar_category_id' => fake()->randomElement([1,3]),
        ];
    }
}
