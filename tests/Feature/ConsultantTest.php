<?php

namespace Tests\Feature;

use App\Models\Consultant;
use App\Models\Profession;
use App\Models\Role;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ConsultantTest extends TestCase
{
    use DatabaseTransactions;

    public function test_index_consultants(): void
    {
        $response = $this->get('/api/consultants');

        $response->assertStatus(200)
                 ->assertJson(fn (AssertableJson $json) =>
                        $json->has('data'));;
    }

    public function test_store_consultant(): void
    {
        $role = Role::where('code', Role::CONSULTANT)->first();
        $user = User::where('role_id', $role->id)->first();
        Auth::login($user);

        $response = $this->post('api/consultants', [
            'user_id' => $user->id,
            'photo' => UploadedFile::fake()->image('photo.jpg'),
            'description' => 'описание консультанта',
        ]);

        $response->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
            $json->has('message'));
    }

    public function test_show_consultant(): void
    {
        $response = $this->get('/api/consultants/'.Consultant::find(1)->id);

        $response->assertStatus(200)
                 ->assertJson(fn (AssertableJson $json) =>
                        $json->has('data'));;
    }

    public function test_update_consultant(): void
    {
        //TODO: Сделать загрузка файла через постман в raw формате
        $role = Role::where('code', Role::CONSULTANT)->first();
        $user = User::where('role_id', $role->id)->first();
        Auth::login($user);

        $response = $this->put('api/consultants/'.Consultant::where('user_id', $user->id)->first()->id, [
            'user_id' => $user->id,
            'photo' => UploadedFile::fake()->image('photo.jpg'),
            'description' => 'новое описание консультанта',
            'specialization_id' => Specialization::find(1)->id,
            'profession_id' => Profession::find(1)->id,
        ]);

        $this->assertDatabaseHas('consultants', [
            'user_id' => $user->id,
            'description' => 'новое описание консультанта',
        ]);

        $response->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
            $json->has('data'));
    }

    public function test_destroy_consultant(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $consultant = Consultant::where('user_id', 10)->first();

        $response = $this->delete('/api/consultants/'.$consultant->id);

        $this->assertModelMissing($consultant);

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
            $json->has('message'));
    }
}
