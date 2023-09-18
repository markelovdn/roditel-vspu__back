<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Vebinar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VebinarPartisipant>
 */
class VebinarPartisipantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vebinar_id' => Vebinar::factory(),
            'user_id' => User::factory(),
        ];
    }
}
