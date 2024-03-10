<?php

namespace Tests\Feature;

use App\Models\Consultation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ConsultationRatingTest extends TestCase
{
    public function testStore()
    {
        $user = User::where('id', 93)->first();
        Auth::login($user);

        $consultation = Consultation::factory()->create([
            'parented_user_id' => $user->id,
            'title' => 'Test Consultation',
            'closed' => false,
        ]);

        $requestData = [
            'consultation_id' => $consultation->id,
            'ratings' => [
                ['rating_question_id' => 1, 'rating_answer' => 5,],
                ['rating_question_id' => 2, 'rating_answer' => 4,],
                ['rating_question_id' => 3, 'rating_answer' => 3,],
                ['rating_question_id' => 4, 'rating_answer' => 2,],
                ['rating_question_id' => 5, 'rating_answer' => "Отлично",],
                ['rating_question_id' => 6, 'rating_answer' => "Хорошо",],
            ]
        ];

        $response = $this->postJson('/api/consultationRatings', $requestData);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Rating successfully created!',
            ]);
    }
}
