<?php

namespace Database\Factories;

use App\Models\Vebinar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VebinarQuestion>
 */
class VebinarQuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question_text' => fake()->text(),
            'vebinar_id' => Vebinar::factory(),
        ];
    }
}
