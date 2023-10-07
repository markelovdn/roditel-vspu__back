<?php

namespace Tests\Feature;

use App\Models\Parented;
use App\Models\Region;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ParentedsTest extends TestCase
{
    use DatabaseTransactions;

    public function test_index(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $response = $this->get('/api/parenteds');

        $response->assertStatus(200)
        ->assertJsonIsObject();;
    }

    public function test_show(): void
    {
        $parented = Parented::first();
        $user = User::where('id', $parented->user_id)->first();
        Auth::login($user);

        $response = $this->get('/api/parenteds/'.$parented->id);

        $response->assertStatus(200)
        ->assertJsonIsObject();;
    }

    public function test_update(): void
    {
        $parented = Parented::first();
        $user = User::where('id', $parented->user_id)->first();
        Auth::login($user);

        $response = $this->put('/api/parenteds/'.$parented->id, [
            "regionId" => Region::first()->id
        ]);

        $this->assertDatabaseHas('parenteds', [
            'region_id' => Region::first()->id,
        ]);

        $response->assertStatus(200)
        ->assertJsonIsObject();;
    }

    public function test_destroy(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $parented = Parented::first();

        $response = $this->delete('/api/parenteds/'.$parented->id);

        $this->assertSoftDeleted($parented);

        $response->assertStatus(200)
        ->assertJsonIsObject();;
    }
}
