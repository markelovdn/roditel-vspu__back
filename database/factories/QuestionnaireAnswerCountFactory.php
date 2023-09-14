<?php

namespace Database\Factories;

use App\Models\QuestionnaireAnswer;
use App\Models\QuestionnaireParentedAnswer;
use App\Models\QuestionnaireQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuestionnaireAnswerCount>
 */
class QuestionnaireAnswerCountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'questionnaire_question_id' => QuestionnaireQuestion::factory(),
            'questionnaire_answer_id' => QuestionnaireAnswer::factory(),
            'parented_answer_id' => QuestionnaireParentedAnswer::factory()
        ];
    }
}
