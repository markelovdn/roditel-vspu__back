<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Webinar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WebinarPartisipant>
 */
class WebinarPartisipantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'webinar_id' => Webinar::factory(),
            'user_id' => User::factory(),
        ];
    }
}
