<?php

namespace Tests\Feature;

use App\Models\Region;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RegionsTest extends TestCase
{
    use DatabaseTransactions;

    public function test_index(): void
    {
        $response = $this->get('/api/regions');

        $response->assertStatus(200)
        ->assertJsonIsObject();;
    }

    public function test_store(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $response = $this->post('/api/regions', [
            'code' => '34',
            'title' => 'test'
        ]);

        $this->assertDatabaseHas('regions', [
            'code' => '34',
            'title' => 'test',
        ]);

        $response->assertStatus(200)
        ->assertJsonIsObject();;
    }

    public function test_show(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $region = Region::first();
        $response = $this->get('/api/regions/'.$region->id);

        $response->assertStatus(200)
        ->assertJsonIsObject();;
    }

    public function test_update(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $region = Region::first();

        $response = $this->put('/api/regions/'.$region->id, [
            'title' => 'test2'
        ]);

        $this->assertDatabaseHas('regions', [
            'title' => 'test2',
        ]);

        $response->assertStatus(200)
        ->assertJsonIsObject();;
    }

    public function test_destroy(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $region = Region::first();

        $response = $this->delete('/api/regions/'.$region->id);

        $this->assertSoftDeleted($region);

        $response->assertStatus(200)
        ->assertJsonIsObject();;
    }
}
