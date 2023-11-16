<?php

namespace Tests\Feature;

use App\Models\Parented;
use App\Models\Questionnaire;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class SelectedOptionTest extends TestCase
{
    public function test_store(): void
    {
        $parented = Parented::first();
        $user = User::where('id', $parented->user_id)->first();
        Auth::login($user);
        $questionnaire = Questionnaire::with('questions')->first();

        $response = $this->post(
            '/api/questionnaire/' . $questionnaire->id . '/selectedOptions',
            [
                'selected' => [['questionId' => $questionnaire->questions->first()->id, 'optionId' => $questionnaire->questions->first()->options[0]->id],],
                'other' => [['questionId' => $questionnaire->questions->first()->id, 'text' => 'свой вариант ответа']],
            ]
        );
        // $response->dd();

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Options add success']);
    }

    // public function test_update(): void
    // {
    //     $parented = Parented::first();
    //     $user = User::where('id', $parented->user_id)->first();
    //     Auth::login($user);
    //     $questionnaire = Questionnaire::with('questions')->first();

    //     $response = $this->put('/api/selectedOptions/'.$questionnaire->questions->first()->id,
    //     [
    //         ['option_id' => $questionnaire->questions->first()->options[0]->id,],
    //         ['option_id' => $questionnaire->questions->first()->options[2]->id,],
    //         ['text' => 'свой вариант ответа обновленный'],
    //     ]
    //     );

    //     $response->assertStatus(200)
    //     ->assertJsonFragment(['message' => 'Options update success']);
    // }
}
