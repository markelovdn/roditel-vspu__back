<?php

namespace Tests\Feature;

use App\Models\Contract;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ConsultantContractTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {   $role = Role::where('code', Role::ADMIN)->first();
        $user = User::where('role_id', $role->id)->first();
        Auth::login($user);
        $constract = Contract::first();
        $response = $this->get('/api/contracts');
        // $response->dd();

        $response->assertStatus(200)
        ->assertJsonFragment(['id' => $constract->id]);
    }
}
