<?php

namespace Tests\Feature;

use App\Models\Children;
use App\Models\Parented;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ChildrensTest extends TestCase
{
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
}
