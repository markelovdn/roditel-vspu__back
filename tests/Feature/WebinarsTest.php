<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use App\Models\Webinar;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class WebinarsTest extends TestCase
{
    use DatabaseTransactions;

    public function test_index_webinars(): void
    {
        $response = $this->get('api/webinars');
        $response
            ->assertStatus(200)
            ->assertJsonIsObject();
    }

    public function test_store_webinars(): void
    {
        $webinar = Webinar::first();
        //TODO::сделать проверки на уникальность семинара и проверку на время
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $response = $this->post('api/webinars',[
            'title' => fake()->title(),
            'date' => fake()->date(),
            'timeStart' => fake()->time(),
            'timeEnd' => fake()->time(),
            'lectorName' => fake()->name(),
            'logo' => UploadedFile::fake()->image('photo.jpg'),
            'cost' => 0.00,
            'videoLink' => fake()->url(),
            'webinarCategoryId' => $webinar->id,
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonIsObject();
    }

    public function test_show_webinars(): void
    {
        $webinar = Webinar::first();
        $response = $this->get('api/webinars/'.$webinar->id);

        $response
            ->assertStatus(200)
            ->assertJsonIsObject();
    }

    public function test_update_webinars(): void
    {
        //TODO::сделать проверки на уникальность семинара и проверку на время
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('role_id', $role->id)->first();
        Auth::login($admin);

        $webinar = Webinar::first();

        $response = $this->put('api/webinars/'.$webinar->id,[
            'title' => fake()->title(),
            'date' => fake()->date(),
            'timeStart' => fake()->time(),
            'timeEnd' => fake()->time(),
            'lectorName' => fake()->name(),
            'logo' => UploadedFile::fake()->image('photo.jpg'),
            'cost' => 0.00,
            'videoLink' => fake()->url(),
            'webinarCategoryId' => $webinar->id,
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonIsObject();
    }

    public function test_getWebinarLectors(): void
    {
        //TODO: доработать тест
        $response = $this->get('api/webinarLectors');
        $response
            ->assertStatus(200);
    }

    // public function test_destroy_webinars(): void
    // {
        // $role = Role::where('code', Role::ADMIN)->first();
        // $admin = User::where('role_id', $role->id)->first();
        // Auth::login($admin);

        // $webinar = Webinar::first();
        // $response = $this->delete('api/webinars/'.$webinar->id);

        // $this->assertModelMissing($webinar);
        // $response
        //     ->assertStatus(200)
        //     ->assertJsonIsObject();
    // }
}
