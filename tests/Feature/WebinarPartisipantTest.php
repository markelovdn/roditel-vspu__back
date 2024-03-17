<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use App\Models\Webinar;
use App\Models\WebinarPartisipant;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class WebinarPartisipantTest extends TestCase
{
    use DatabaseTransactions;

    public function test_index(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);
        $webinarPartisipant = WebinarPartisipant::first();
        $webinar = Webinar::where('id', $webinarPartisipant->webinar_id)->first();

        $response = $this->get('/api/webinar/'.$webinar->id.'/webinarPartisipants');
        // $response->dd();

        $response->assertStatus(200)
        ->assertJsonFragment(["userId" => $webinarPartisipant->user_id]);
    }

    public function test_store(): void
    {
        $role = Role::where('code', Role::PARENTED)->first();
        $user = User::where('role_id', $role->id)->first();
        Auth::login($user);
        $webinarPartisipant = WebinarPartisipant::first();
        $webinar = Webinar::where('id', $webinarPartisipant->webinar_id)->first();

        $response = $this->post('/api/webinar/'.$webinar->id.'/webinarPartisipants', [
            'webinarId' => $webinar->id,
            'userId' => $user->id
        ]);

        $response->assertStatus(200)
        ->assertJsonFragment(["message" => 'User successfully added for webinar']);
    }

    public function test_destroy(): void
    {
        $webinarPartisipant = WebinarPartisipant::first();

        $user = User::where('id', $webinarPartisipant->user_id)->first();

        Auth::login($user);
        $webinarPartisipant = WebinarPartisipant::where('user_id', $user->id)->first();

        $response = $this->delete('/api/webinarPartisipants/'.$webinarPartisipant->id);


        $this->assertDatabaseMissing('webinar_partisipants', [
            'id' => $webinarPartisipant->id
        ]);

        $response->assertStatus(200)
        ->assertJsonFragment(["message" => 'User successfully deleted for webinar']);
    }
}
