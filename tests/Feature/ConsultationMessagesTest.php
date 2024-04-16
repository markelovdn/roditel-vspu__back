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
    public function test_store()
    {
        $consultation = Consultation::first();
        $user = User::where('id', $consultation->parented_user_id)->first();
        Auth::login($user);

        $response = $this->post('/api/consultations/' . $consultation->id . '/messages', [
            'text' => 'Тестовый текст',
            'consultationId' => $consultation->id,
            'user_id' => $user->id,
            'readed' => false,
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Message successfully added']);
    }

    public function test_show(): void
    {
        $consultation = Consultation::first();
        $message = $consultation->messages()->first();
        $user = User::where('id', $consultation->parented_user_id)->first();
        Auth::login($user);

        $response = $this->get('/api/messages/' . $message->id);
        // $response->dd();

        $response->assertStatus(200)
            ->assertJsonFragment(['userId' => $user->id]);
    }

    public function test_update()
    {
        $consultation = Consultation::first();
        $message = $consultation->messages()->first();
        $user = User::where('id', $consultation->parented_user_id)->first();
        Auth::login($user);

        $response = $this->put('/api/messages/' . $message->id, [
            'text' => 'Тестовый текст обновленный',
            'consultationId' => $consultation->id,
            'user_id' => $user->id,
            'readed' => false,
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Message successfully updated']);
    }

    public function test_destroy(): void
    {
        $consultation = Consultation::first();
        $message = $consultation->messages()->first();
        $user = User::where('id', $consultation->parented_user_id)->first();
        Auth::login($user);

        $response = $this->delete('/api/messages/' . $message->id);

        $this->assertDatabaseMissing('consultation_messages', [
            'id' => $message->id
        ]);

        $response->assertStatus(200)
            ->assertJsonIsObject();
    }
}
