<?php

namespace Tests\Feature;

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
}
