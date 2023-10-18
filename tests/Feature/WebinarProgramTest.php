<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use App\Models\Webinar;
use App\Models\WebinarProgram;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class WebinarProgramTest extends TestCase
{
    use DatabaseTransactions;

    public function test_index(): void
    {
        $webinarProgram = WebinarProgram::first();
        $webinar = Webinar::where('id', $webinarProgram->webinar_id)->first();

        $response = $this->get('/api/webinar/'.$webinar->id.'/webinarPrograms');
        // $response->dd();

        $response->assertStatus(200)
        ->assertJsonFragment(["subject" => $webinarProgram->subject]);
    }

    public function test_store(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $webinar = Webinar::first();

        $response = $this->post('/api/webinar/'.$webinar->id.'/webinarPrograms', [
            'timeStart' => '10:00',
            'subject' => 'Тестовый текст',
            'webinarId' => $webinar->id,
        ]);

        $this->assertDatabaseHas('webinar_programs', [
            'subject' => 'Тестовый текст'
        ]);

        $response->assertStatus(200)
        ->assertJsonFragment(['message' => 'WebinarProgram successfully added']);
    }

    public function test_show(): void
    {
        $webinarProgram = WebinarProgram::first();
        $response = $this->get('/api/webinarPrograms/'.$webinarProgram->id);
        // $response->dd();

        $response->assertStatus(200)
        ->assertJsonFragment(["subject" => $webinarProgram->subject]);
    }

    public function test_update(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $webinarProgram = WebinarProgram::first();

        $response = $this->put('/api/webinarPrograms/'.$webinarProgram->id, [
            'timeStart' => '10:01',
            'subject' => 'Тестовый текст2',
        ]);

        $this->assertDatabaseHas('webinar_programs', [
            'subject' => 'Тестовый текст2'
        ]);

        $response->assertStatus(200)
        ->assertJsonFragment(['message' => 'WebinarProgram successfully update']);
    }

    public function test_destroy(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $webinarProgram = WebinarProgram::first();

        $response = $this->delete('/api/webinarPrograms/'.$webinarProgram->id);

        $this->assertDatabaseMissing('webinar_programs', [
            'id' => $webinarProgram->id
        ]);

        $response->assertStatus(200)
        ->assertJsonFragment(['message' => 'WebinarProgram successfully deleted']);
    }
}
