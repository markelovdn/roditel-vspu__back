<?php

namespace Tests\Feature;

use App\Models\Consultant;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
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

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
            $json->has('data'));
    }

    public function test_store_user_as_consultant(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $role = Role::where('code', 'consultant')->first();
        //codeception
        $response = $this->postJson('/api/users', [
            'second_name' => 'Иван',
            'first_name' => 'Иванов',
            'patronymic' => 'Иванович',
            'email' => 'ivan@test.ru',
            'phone' => '+7 (000) 000-00-00',
            'role_id' => $role->id,
            'password' => '123123'
        ]);

        $this->assertDatabaseHas('users', [
            'second_name' => 'Иван',
            'first_name' => 'Иванов',
            'patronymic' => 'Иванович',
        ]);

        $response
        ->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
            $json->has('data'));
    }

    public function test_store_user_as_parented(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $role = Role::where('code', 'parented')->first();
        //codeception
        $response = $this->post('/api/users', [
            'second_name' => 'Иван',
            'first_name' => 'Иванов',
            'patronymic' => 'Иванович',
            'email' => 'ivan@test.ru',
            'phone' => '+7 (000) 000-00-00',
            'role_id' => $role->id,
            'password' => '123123'
        ]);

        $this->assertDatabaseHas('users', [
            'second_name' => 'Иван',
            'first_name' => 'Иванов',
            'patronymic' => 'Иванович',
        ]);

        $response->assertStatus(200);
    }

    public function test_show_user(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $user = User::where('id', 1)->first();

        $response = $this->get('/api/users/'.$user->id);

        $response->assertStatus(200);
    }

    public function test_update_user(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $user = User::where('id', 1)->first();

        $response = $this->put('/api/users/'.$user->id, [
            'second_name' => 'Иван',
            'first_name' => 'Иванов',
            'patronymic' => 'Иванович',
            'email' => 'ivan@test.ru',
            'phone' => '+7 (000) 000-00-00',
            'role_id' => $role->id,
            'password' => '123123'
        ]);

        $this->assertDatabaseHas('users', [
            'second_name' => 'Иван',
            'first_name' => 'Иванов',
            'patronymic' => 'Иванович',
        ]);

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
            $json->has('data'));
    }

    public function test_destroy_consultant(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $user = User::where('id', 10)->first();

        $response = $this->delete('/api/users/'.$user->id);

        $this->assertModelMissing($user);

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
            $json->has('message'));
    }

}
