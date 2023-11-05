<?php

namespace Tests\Feature;

use App\Models\Consultant;
use App\Models\Profession;
use App\Models\Role;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
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
                 ->assertJsonIsObject();
    }

    public function test_store_consultant(): void
    {
        $consultant = Consultant::first();
        $user = User::where('id', $consultant->user_id)->first();
        Auth::login($user);

        $response = $this->post('api/consultants', [
            'userId' => $user->id,
            'photo' => UploadedFile::fake()->image('photo.jpg'),
            'description' => 'описание консультанта',
        ]);

        $response->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
            $json->has('message'));
    }

    public function test_show_consultant(): void
    {
        $consultant = Consultant::first();
        $user = User::where('id', $consultant->user_id)->first();
        Auth::login($user);
        
        $response = $this->get('/api/consultants/'.Consultant::find(1)->id);

        $response->assertStatus(200)
                 ->assertJson(fn (AssertableJson $json) =>
                        $json->has('data'));;
    }

    public function test_update_consultant(): void
    {
        //TODO: Сделать загрузка файла через постман в raw формате
        $consultant = Consultant::first();
        $user = User::where('id', $consultant->user_id)->first();
        Auth::login($user);

        $response = $this->put('api/consultants/'.Consultant::where('user_id', $user->id)->first()->id, [
            'photo' => UploadedFile::fake()->image('photo.jpg'),
            'description' => 'новое описание консультанта',
            'specializationId' => Specialization::find(1)->id,
            'professionId' => Profession::find(1)->id,
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

        $consultant = Consultant::first();

        $response = $this->delete('/api/consultants/'.$consultant->id);
        // $response->dd();

        $this->assertSoftDeleted($consultant);

        $response
            ->assertStatus(200)
            ->assertJsonFragment(['message' => 'Record successfully deleted']);
    }
}
