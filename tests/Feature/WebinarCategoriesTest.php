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

    public function test_index_webinarCategories(): void
    {
        $response = $this->get('/api/webinarCategories');

        $response->assertStatus(200)->assertJsonIsObject();
    }

    public function test_store_webinars(): void
    {
        $webinarCategory = WebinarCategory::first();
        //TODO::сделать проверки на уникальность семинара и проверку на время
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $response = $this->post('api/webinarCategories', [
            'title' => fake()->title()
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonIsObject();
    }

    public function test_show_webinarsCategories(): void
    {
        $webinar = WebinarCategory::first();
        $response = $this->get('api/webinarCategories/'.$webinar->id);

        $response
            ->assertStatus(200)
            ->assertJsonIsObject();
    }

    public function test_update_webinarsCategory(): void
    {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $webinar = WebinarCategory::first();

        $response = $this->put('api/webinarCategories/'.$webinar->id,[
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
