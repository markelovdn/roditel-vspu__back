<?php

namespace Tests\Feature;

use App\Models\Lector;
use App\Models\Role;
use App\Models\User;
use App\Models\Webinar;
use App\Models\WebinarLector;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LectorTest extends TestCase
{
    use DatabaseTransactions;

    // public function test_index(): void
    // {
    //     $lector = Lector::first();
    //     $webinar = Webinar::whereHas('lectors', function ($query) use ($lector) {
    //     $query->where('id', $lector->id);})->first();

    //     $response = $this->get('/api/webinar/'.$webinar->id.'/webinarLectors');
    //     // $response->dd();

    //     $response->assertStatus(200)
    //     ->assertJsonFragment(["lectorName" => $webinarLector->lector_name]);
    // }

    // public function test_store(): void
    // {
    //     $role = Role::where('code', Role::ADMIN)->first();
    //     $admin = User::where('role_id', $role->id)->first();
    //     Auth::login($admin);

    //     $webinar = Webinar::first();

    //     $response = $this->post('/api/webinar/'.$webinar->id.'/webinarLectors', [
    //         'lectorName' => 'Тестовый текст',
    //         'lectorDescription' => 'Тестовый текст',
    //         'lectorDepartment' => 'Тестовый текст',
    //         'lectorPhoto' => UploadedFile::fake()->image('photo.jpg'),
    //         'webinarId' => $webinar->id,
    //     ]);
    //     // $response->dd();

    //     $this->assertDatabaseHas('webinar_lectors', [
    //         'lector_name' => 'Тестовый текст'
    //     ]);

    //     $response->assertStatus(200)
    //     ->assertJsonFragment(['message' => 'WebinarLector successfully added']);
    // }

    // public function test_show(): void
    // {
    //     $webinarLector = WebinarLector::first();
    //     $response = $this->get('/api/webinarLectors/'.$webinarLector->id);
    //     // $response->dd();

    //     $response->assertStatus(200)
    //     ->assertJsonFragment(["lectorName" => $webinarLector->lector_name]);
    // }

    // public function test_update(): void
    // {
    //     $role = Role::where('code', Role::ADMIN)->first();
    //     $admin = User::where('role_id', $role->id)->first();
    //     Auth::login($admin);

    //     $webinarLector = WebinarLector::first();

    //     $response = $this->put('/api/webinarLectors/'.$webinarLector->id, [
    //         'lectorName' => 'Тестовый текст2',
    //         'lectorDescription' => 'Тестовый текст2',
    //         'lectorDepartment' => 'Тестовый текст2',
    //         'lectorPhoto' => UploadedFile::fake()->image('photo.jpg'),
    //     ]);

    //     $this->assertDatabaseHas('webinar_lectors', [
    //         'lector_name' => 'Тестовый текст2'
    //     ]);

    //     $response->assertStatus(200)
    //     ->assertJsonFragment(['message' => 'WebinarLector successfully update']);
    // }

    // public function test_destroy(): void
    // {
    //     $role = Role::where('code', Role::ADMIN)->first();
    //     $admin = User::where('role_id', $role->id)->first();
    //     Auth::login($admin);

    //     $webinarLector = WebinarLector::first();

    //     $response = $this->delete('/api/webinarLectors/'.$webinarLector->id);

    //     $this->assertDatabaseMissing('webinar_lectors', [
    //         'id' => $webinarLector->id
    //     ]);

    //     $response->assertStatus(200)
    //     ->assertJsonFragment(['message' => 'WebinarLector successfully deleted']);
    // }
}
