<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Role;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    public function test_register_user_as_consultant(): void
    {
        $role = Role::where('code', Role::CONSULTANT)->first();
        //codeception
        $response = $this->post('/api/register', [
            'secondName' => 'Иван',
            'firstName' => 'Иванов',
            'patronymic' => 'Иванович',
            'email' => 'ivan@test.ru',
            'phone' => '+7 (000) 000-00-00',
            'specializationId' => [1, 2, 3],
            'professionId' => 1,
            'roleCode' => $role->code,
            'password' => '123123'
        ]);

        $this->assertDatabaseHas('users', [
            'second_name' => 'Иван',
            'first_name' => 'Иванов',
            'patronymic' => 'Иванович',
        ]);

        $response->assertStatus(200);
    }

    public function test_login_user(): void
    {
        $response = $this->post('/api/login', [
            'email' => 'test@test.ru',
            'password' => 'password'
        ]);

        $response->assertStatus(200);
    }

    public function test_login_incorrect_credentials(): void
    {
        $response = $this->post('/api/login', [
            'email' => 'test@test1.ru',
            'password' => 'password1'
        ]);

        $response->assertStatus(401);
    }
}
