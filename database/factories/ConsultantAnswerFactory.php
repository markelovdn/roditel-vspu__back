<?php

namespace Database\Factories;

use App\Models\Consultation;
use App\Models\ParentedQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ConsultantAnswer>
 */
class ConsultantAnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'answer_text'=> fake()->text(),
            'consultant_id' => fake()->numberBetween(1,5),
            'consultation_id' => Consultation::factory(),
            'parented_question_id'=> ParentedQuestion::factory()

        ];
    }
}
