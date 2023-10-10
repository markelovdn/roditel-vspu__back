<?php

namespace Database\Factories;

use App\Models\Option;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SelectedOption>
 */
class SelectedOptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question_id' => Question::factory(),
            'option_id' => Option::factory(),
            'user_id' => User::factory(),
        ];
    }
}
