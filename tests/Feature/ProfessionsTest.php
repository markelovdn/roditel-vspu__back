<?php

namespace Tests\Feature;

use App\Models\Profession;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProfessionsTest extends TestCase
{
    use DatabaseTransactions;

    public function test_index(): void
    {
        $response = $this->get('/api/professions');

        $response->assertStatus(200)
        ->assertJsonIsObject();;
    }

    public function test_store(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $response = $this->post('/api/professions/', [
            'title' => 'test'
        ]);

        $this->assertDatabaseHas('professions', [
            'title' => 'test',
        ]);

        $response->assertStatus(200)
        ->assertJsonIsObject();;
    }

    public function test_show(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $profession = Profession::first();
        $response = $this->get('/api/professions/'.$profession->id);

        $response->assertStatus(200)
        ->assertJsonIsObject();;
    }

    public function test_update(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $profession = Profession::first();

        $response = $this->put('/api/professions/'.$profession->id, [
            'title' => 'test2'
        ]);

        $this->assertDatabaseHas('professions', [
            'title' => 'test2',
        ]);

        $response->assertStatus(200)
        ->assertJsonIsObject();;
    }

    public function test_destroy(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $profession = Profession::first();

        $response = $this->delete('/api/professions/'.$profession->id);

        $this->assertSoftDeleted($profession);

        $response->assertStatus(200)
        ->assertJsonIsObject();;
    }
}
