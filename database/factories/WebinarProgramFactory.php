<?php

namespace Database\Factories;

use App\Models\Webinar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WebinarProgram>
 */
class WebinarProgramFactory extends Factory
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
            'webinar_id' => Webinar::factory(),
        ];
    }
}
