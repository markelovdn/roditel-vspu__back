<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class SpecializationsTest extends TestCase
{
    use DatabaseTransactions;

    public function test_index(): void
    {

        $response = $this->get('/api/specializations');

        $response->assertStatus(200)
        ->assertJsonIsObject();
    }

    public function test_store(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $response = $this->post('/api/specializations', [
            'title' => 'тест'
        ]);

        $this->assertDatabaseHas('specializations', [
            'title' => 'тест',
        ]);

        $response->assertStatus(200)
        ->assertJsonIsObject();
    }

    public function test_show(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $specialization = Specialization::first();
        $response = $this->get('/api/specializations/'.$specialization->id);

        $response->assertStatus(200)
        ->assertJsonIsObject();
    }

    public function test_update(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $specialization = Specialization::first();
        $response = $this->put('/api/specializations/'.$specialization->id, [
            'title' => 'тест новый'
        ]);

        $this->assertDatabaseHas('specializations', [
            'title' => 'тест новый',
        ]);

        $response->assertStatus(200)
        ->assertJsonIsObject();
    }

    public function test_destroy(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $specialization = Specialization::first();
        $response = $this->delete('/api/specializations/'.$specialization->id);

        $this->assertSoftDeleted($specialization);

        $response->assertStatus(200)
        ->assertJsonIsObject();
    }
}
