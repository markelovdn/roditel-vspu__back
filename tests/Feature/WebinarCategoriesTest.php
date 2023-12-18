<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use App\Models\WebinarCategory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class WebinarCategoriesTest extends TestCase
{

    use DatabaseTransactions;

    public function test_index(): void
    {
        $response = $this->get('/api/webinarCategories');

        $response->assertStatus(200)->assertJsonFragment(["title" => "Родителеьский университет"]);
    }

    public function test_store(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $response = $this->post('api/webinarCategories', [
            'title' => fake()->title()
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonFragment(['message' => 'Webinar category successfully added']);
    }

    public function test_show(): void
    {
        $webinar = WebinarCategory::first();
        $response = $this->get('api/webinarCategories/' . $webinar->id);

        $response
            ->assertStatus(200)
            ->assertJsonIsObject();
    }

    public function test_update(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $webinar = WebinarCategory::first();

        $response = $this->put('api/webinarCategories/' . $webinar->id, [
            'title' => fake()->title(),
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonIsObject();
    }

    // public function test_destroy_webinarsCategory(): void
    // {
    //     $role = Role::where('code', Role::ADMIN)->first();
    //     $admin = User::where('role_id', $role->id)->first();
    //     Auth::login($admin);

    //     $webinar = WebinarCategory::first();
    //     $response = $this->delete('api/webinarCategories/'.$webinar->id);

    //     $this->assertModelMissing($webinar);
    //     $response
    //         ->assertStatus(200)
    //         ->assertJsonIsObject();
    // }

}
