<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ConsultantTest extends TestCase
{
    /**
     * A basic feature test example.
     */
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
 
        ]);

        $response->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
            $json->has('message'));
    }
}
