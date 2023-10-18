<?php

namespace Database\Factories;

use App\Models\Webinar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WebinarLector>
 */
class WebinarLectorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lector_name' => fake()->name(),
            'lector_description' => fake()->text(),
            'lector_department' => fake()->title(),
            'lector_photo' => fake()->imageUrl(354, 472, 'people', true),
            'webinar_id' => Webinar::factory(),
        ];
    }
}
