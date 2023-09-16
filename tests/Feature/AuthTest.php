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
        $role = Role::where('code', 'consultant')->first();
        //codeception
        $response = $this->post('/api/register', [
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
}
