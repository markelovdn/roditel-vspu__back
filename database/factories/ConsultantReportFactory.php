<?php

namespace Database\Factories;

use App\Models\Consultant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ConsultantReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'file_url' => fake()->url(),
            'upload_status' => fake()->randomElement(['Загружен', 'Не загружен']),
            'consultant_id' => fake()->randomElement([1,3]),
        ];
    }
}
