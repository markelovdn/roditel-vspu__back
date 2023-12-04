<?php

namespace Tests\Feature;

use App\Http\Resources\ConsultationResource;
use App\Models\Consultant;
use App\Models\Consultation;
use App\Models\Parented;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ConsultationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_index(): void
    {
        $user = User::where('id', 93)->first();
        Auth::login($user);

        $response = $this->get('/api/users/' . $user->id . '/consultations');
        // $response->dd();

        $response->assertStatus(200);
    }

    public function test_store()
    {
        $parented = Parented::first();
        $user = User::where('id', $parented->user_id)->first();
        $consultant = Consultant::first();

        $request = [
            'title' => 'Test Consultation',
            'specializationId' => 1,
            'consultantId' => $consultant->id,
            'messageText' => 'Test message',
            'allConsultants' => true
        ];

        Auth::login($user);
        $response = $this->postJson('/api/users/' . $user->id . '/consultations', $request);
        // $response->dd();

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Consultation successfully added'
            ]);
    }

    public function test_destroy(): void
    {
        $parented = Parented::first();
        $user = User::where('id', $parented->user_id)->first();
        Auth::login($user);

        // Test case 1: Successful deletion
        $consultation = Consultation::factory()->create([
            'parented_user_id' => $user->id,
            'specialization_id' => 1,
            'title' => 'Test Consultation',
            'closed' => false,
        ]);
        $response = $this->json('DELETE', '/api/consultations/' . $consultation->id);
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Consultation successfully deleted'
            ]);
    }
}
