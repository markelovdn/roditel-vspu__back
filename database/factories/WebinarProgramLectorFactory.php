<?php

namespace Database\Factories;

use App\Models\WebinarLector;
use App\Models\WebinarProgram;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class WebinarProgramLectorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'webinar_program_id' => WebinarProgram::factory(),
            'webinar_lector_id' => WebinarLector::factory(),
        ];
    }
}
