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
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;


class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function test_index_users(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $response = $this->get('/api/users');
        // $response->dd();

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->has('data'));
    }

    // public function test_store_user_as_consultant(): void
    // {
    //     $role = Role::where('code', Role::ADMIN)->first();
    //     $admin = User::where('role_id', $role->id)->first();
    //     Auth::login($admin);

    //     $role = Role::where('code', 'consultant')->first();
    //     //codeception
    //     $response = $this->postJson('/api/users', [
    //         'second_name' => 'Иван',
    //         'first_name' => 'Иванов',
    //         'patronymic' => 'Иванович',
    //         'email' => 'ivan@test.ru',
    //         'phone' => '+7 (000) 000-00-00',
    //         'role_code' => $role->code,
    //         'password' => '123123'
    //     ]);

    //     $this->assertDatabaseHas('users', [
    //         'second_name' => 'Иван',
    //         'first_name' => 'Иванов',
    //         'patronymic' => 'Иванович',
    //     ]);

    //     $response
    //     ->assertStatus(200)
    //     ->assertJson(fn (AssertableJson $json) =>
    //         $json->has('data'));
    // }

    // public function test_store_user_as_parented(): void
    // {
    //     $role = Role::where('code', Role::ADMIN)->first();
    //     $admin = User::where('role_id', $role->id)->first();
    //     Auth::login($admin);

    //     $role = Role::where('code', 'parented')->first();
    //     //codeception
    //     $response = $this->post('/api/users', [
    //         'second_name' => 'Иван',
    //         'first_name' => 'Иванов',
    //         'patronymic' => 'Иванович',
    //         'email' => 'ivan@test.ru',
    //         'phone' => '+7 (000) 000-00-00',
    //         'role_code' => $role->code,
    //         'password' => '123123'
    //     ]);

    //     $this->assertDatabaseHas('users', [
    //         'second_name' => 'Иван',
    //         'first_name' => 'Иванов',
    //         'patronymic' => 'Иванович',
    //     ]);

    //     $response->assertStatus(200);
    // }

    public function test_show_user(): void
    {
        $user = User::first();
        Auth::login($user);

        $response = $this->get('/api/users/'.$user->id);

        $response->assertStatus(200);
    }

    public function test_update_user(): void
    {
        $user = User::where('email', 'consultant@consultant.ru')->first();
        Auth::login($user);

        $response = $this->put('/api/users/'.$user->id, [
            'secondName' => 'Иван',
            'firstName' => 'Иванов',
            'patronymic' => 'Иванович',
            'email' => 'consultant@consultant.ru',
            'phone' => '+7 (000) 000-00-00',
            'photo' => UploadedFile::fake()->image('photo.jpg'),
            'description' => 'новое описание консультанта',
            'specializationId' => Specialization::find(1)->id,
            'professionId' => Profession::find(1)->id,
        ]);

        $this->assertDatabaseHas('users', [
            'second_name' => 'Иван',
            'first_name' => 'Иванов',
            'patronymic' => 'Иванович',
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonFragment(['message' => 'User data successfully updated']);
    }

    public function test_destroy_user(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $user = User::first();

        $response = $this->delete('/api/users/'.$user->id);

        $this->assertSoftDeleted($user);

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
            $json->has('message'));
    }

    // public function test_getUserByToken(): void
    // {
        // $user = User::first();

        // $this->post('/api/login', [
        //     'email' => $user->email,
        //     'password' => $user->password
        // ]);

        // $token = DB::table('personal_access_tokens')->where('tokenable_id', $user->id)->first();

        // $response = $this->post('/api/getUserByToken', [
        //     'token' => $token->token
        // ]);

        // $response
        //     ->assertStatus(200)
        //     ->assertJson(fn (AssertableJson $json) =>
        //     $json->has('data'));
    // }

}
