<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use App\Models\Webinar;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class WebinarPartisipantTest extends TestCase
{
    use DatabaseTransactions;

    public function test_index_webinar_partisipant(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $response = $this->get('api/webinarPartisipants');

        $response->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
            $json->has('data'));;
    }

    public function test_store_webinar_partisipant(): void
    {
        $role = Role::where('code', Role::PARENTED)->first();
        $user = User::where('role_id', $role->id)->first();
        Auth::login($user);

        $webinar = Webinar::first();

        $response = $this->post('api/webinarPartisipants', [
            'webinar_id' => $webinar->id,
            'user_id' => $user->id
        ]);

        $response->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) =>
            $json->has('message'));
    }
}
