<?php

namespace Tests\Feature;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use DatabaseTransactions;

    public function test_register_user_as_consultant(): void
    {
        $role = Role::where('code', 'consultant')->first();

        $response = $this->post('/api/register', [
            'second_name' => 'Иван',
            'first_name' => 'Иванов',
            'patronymic' => 'Иванович',
            'email' => 'ivan@test.ru',
            'phone' => '+7 (000) 000-00-00',
            'role_id' => $role->id,
            'password' => '123123',
            'password_confirmation' => '123123',
        ]);

        $this->assertDatabaseHas('users', [
            'second_name' => 'Иван',
            'first_name' => 'Иванов',
            'patronymic' => 'Иванович',
        ]);

        $response->assertStatus(200);
    }
}
