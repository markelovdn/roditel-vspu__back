<?php

namespace Tests\Feature;

use App\Models\Consultant;
use App\Models\Consultation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ConsultationMessagesTest extends TestCase
{
    public function testStore()
    {

        $user = User::where('id', 93)->first();
        Auth::login($user);
        $consultation = Consultation::where('user_id', $user->id)->first();

        $response = $this->post('/api/consultations/'.$consultation->id.'/messages', [
            'text' => 'Тестовый текст',
            'consultationId' => $consultation->id,
            'user_id' => $user->id,
            'readed' => false,
        ]);

        $response->assertStatus(200)
        ->assertJsonFragment(['message' => 'Message successfully added']);

    }
}
