<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use App\Models\Webinar;
use App\Models\WebinarQuestion;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class WebinarQuestionsTest extends TestCase
{
    use DatabaseTransactions;

    public function test_index(): void
    {
        $webinarQuestion = WebinarQuestion::first();
        $webinar = Webinar::where('id', $webinarQuestion->webinar_id)->first();

        $response = $this->get('/api/webinar/'.$webinar->id.'/webinarQuestions');

        $response->assertStatus(200)
        ->assertJsonFragment(["questionText" => $webinarQuestion->question_text]);
    }

    public function test_store(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $webinar = Webinar::first();

        $response = $this->post('/api/webinar/'.$webinar->id.'/webinarQuestions', [
            'questionText' => 'Тестовый текст'
        ]);

        $this->assertDatabaseHas('webinar_questions', [
            'question_text' => 'Тестовый текст'
        ]);

        $response->assertStatus(200)
        ->assertJsonFragment(['message' => 'WebinarQuestion successfully added']);
    }

    public function test_show(): void
    {
        $webinarQuestion = WebinarQuestion::first();
        $response = $this->get('/api/webinarQuestions/'.$webinarQuestion->id);

        $response->assertStatus(200)
        ->assertJsonFragment(["questionText" => $webinarQuestion->question_text]);
    }

    public function test_update(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $webinarQuestion = WebinarQuestion::first();

        $response = $this->put('/api/webinarQuestions/'.$webinarQuestion->id, [
            'questionText' => 'Тестовый текст2'
        ]);

        $this->assertDatabaseHas('webinar_questions', [
            'question_text' => 'Тестовый текст2'
        ]);

        $response->assertStatus(200)
        ->assertJsonFragment(['message' => 'WebinarQuestion successfully update']);
    }

    public function test_destroy(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $webinarQuestion = WebinarQuestion::first();

        $response = $this->delete('/api/webinarQuestions/'.$webinarQuestion->id);

        $this->assertDatabaseMissing('webinar_questions', [
            'id' => $webinarQuestion->id
        ]);

        $response->assertStatus(200)
        ->assertJsonFragment(['message' => 'WebinarQuestion successfully deleted']);
    }
}
