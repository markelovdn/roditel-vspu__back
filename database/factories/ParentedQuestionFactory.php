<?php

namespace Database\Factories;

use App\Models\Consultant;
use App\Models\Consultation;
use App\Models\Specialization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ParentedQuestion>
 */
class ParentedQuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question_text' => fake()->text(1000),
            'specialization_id' => fake()->numberBetween(1,3),
            'consultant_id' => fake()->numberBetween(1,3),
            'consultation_id' => Consultation::factory(),
            'parented_id' => fake()->numberBetween(1,3),
        ];
    }
}
