<?php

namespace Tests\Feature;

use App\Models\Parented;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ParentedsTest extends TestCase
{
    use DatabaseTransactions;

    public function test_index_parenteds(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $response = $this->get('/api/parenteds');

        $response->assertStatus(200)
            ->assertJsonIsObject();
    }
}
