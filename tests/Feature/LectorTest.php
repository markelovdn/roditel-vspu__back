<?php

namespace Tests\Feature;

use App\Models\Lector;
use App\Models\Role;
use App\Models\User;
use App\Models\Webinar;
use App\Models\WebinarLector;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LectorTest extends TestCase
{
    use DatabaseTransactions;

    public function test_index(): void
    {
        $lector = Lector::first();

        $response = $this->get('/api/lectors');
        // $response->dd();

        $response->assertStatus(200)
        ->assertJsonFragment(["lectorName" => $lector->lector_name]);
    }

    public function test_store(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $response = $this->post('/api/lectors', [
            'name' => 'Тестовый текст',
            'description' => 'Тестовый текст',
            'department' => 'Тестовый текст',
            'photo' => UploadedFile::fake()->image('photo.jpg'),
        ]);
        // $response->dd();

        $this->assertDatabaseHas('lectors', [
            'lector_name' => 'Тестовый текст'
        ]);

        $response->assertStatus(200)
        ->assertJsonFragment(['message' => 'Lector successfully added']);
    }

    public function test_show(): void
    {
        $lector = Lector::first();
        $response = $this->get('/api/lectors/'.$lector->id);
        // $response->dd();

        $response->assertStatus(200)
        ->assertJsonFragment(["lectorName" => $lector->lector_name]);
    }

    public function test_update(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $lector = Lector::first();

        $response = $this->put('/api/lectors/'.$lector->id, [
            'name' => 'Тестовый текст2',
            'description' => 'Тестовый текст2',
            'department' => 'Тестовый текст2',
            'photo' => UploadedFile::fake()->image('photo.jpg'),
        ]);

        $this->assertDatabaseHas('lectors', [
            'lector_name' => 'Тестовый текст2'
        ]);

        $response->assertStatus(200)
        ->assertJsonFragment(['message' => 'Lector successfully update']);
    }

    public function test_destroy(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $lector = Lector::first();

        $response = $this->delete('/api/lectors/'.$lector->id);

        $this->assertSoftDeleted($lector);
        $response->assertStatus(200)
        ->assertJsonFragment(['message' => 'Lector successfully deleted']);
    }
}
