<?php

namespace Tests\Feature;

use App\Models\Children;
use App\Models\Parented;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ChildrensTest extends TestCase
{
    use DatabaseTransactions;

    public function test_index_childrens(): void
    {
        $children = Children::first();
        $parented = Parented::where('id', $children->parented_id)->first();
        $user = User::where('id', $parented->user_id)->first();
        Auth::login($user);

        $response = $this->get('/api/parented/'.$parented->id.'/children');

        $response->assertStatus(200)
                 ->assertJsonIsObject();
    }

    public function test_store_childrens(): void
    {
        $children = Children::first();
        $parented = Parented::where('id', $children->parented_id)->first();
        $user = User::where('id', $parented->user_id)->first();
        Auth::login($user);

        $response = $this->post('/api/parented/'.$parented->id.'/children', [
            'age' => 14,
            'parented_id' => $parented->id
        ]);

        $response->assertStatus(200)
                 ->assertJsonIsObject();
    }

    public function test_show_children(): void
    {
        $children = Children::first();
        $parented = Parented::where('id', $children->parented_id)->first();
        $user = User::where('id', $parented->user_id)->first();
        Auth::login($user);

        $response = $this->get('/api/parented/'.$parented->id.'/children'.'/'.$children->id);

        $response->assertStatus(200)
                 ->assertJsonIsObject();
    }

    public function test_update_children(): void
    {
        $children = Children::first();
        $parented = Parented::where('id', $children->parented_id)->first();
        $user = User::where('id', $parented->user_id)->first();
        Auth::login($user);

        $response = $this->put('/api/parented/'.$parented->id.'/children'.'/'.$children->id, [
            'age' => 15,
            'parented_id' => $parented->id,
        ]);

        $this->assertDatabaseHas('childrens', [
            'age' => 15,
            'parented_id' => $parented->id,
        ]);

        $response->assertStatus(200)
                 ->assertJsonIsObject();
    }

    public function test_destroy_children(): void
    {
        $children = Children::first();
        $parented = Parented::where('id', $children->parented_id)->first();
        $user = User::where('id', $parented->user_id)->first();
        Auth::login($user);

        $response = $this->delete('/api/parented/'.$parented->id.'/children'.'/'.$children->id);

        $this->assertDatabaseMissing('childrens', [
            'id' => $children->id
        ]);

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
            $json->has('message'));
    }
}
