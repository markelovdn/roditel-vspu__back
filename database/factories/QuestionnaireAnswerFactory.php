<?php

namespace Database\Factories;

use App\Models\Questionnaire;
use App\Models\QuestionnaireQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuestionnaireAnswer>
 */
class QuestionnaireAnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'text' => fake()->text(),
            'questionnaire_id' => Questionnaire::factory(),
            'question_id' => QuestionnaireQuestion::factory()
        ];
    }
}
