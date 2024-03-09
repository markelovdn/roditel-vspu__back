<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Webinar>
 */
class WebinarFactory extends Factory
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
            'date' => fake()->dateTimeBetween('25.10.2023', '01.02.2024'),
            'time_start' => fake()->time(),
            'time_end' => fake()->time(),
            'logo' => 'https://markelovdn.ru/storage/webinars/logo/_logo.jpg',
            'video_link' => fake()->url(),
            'prefix_sertificate' => fake()->text(),
            'number_sertificate' => fake()->randomNumber(8, true),
            'webinar_category_id' => fake()->randomElement([1, 3]),
        ];
    }
}
