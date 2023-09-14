<?php

namespace Database\Factories;

use App\Models\Questionnaire;
use App\Models\QuestionnaireQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuestionnaireParentedAnswer>
 */
class QuestionnaireParentedAnswerFactory extends Factory
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
            'questionnaire_question_id' => QuestionnaireQuestion::factory()
        ];
    }
}
