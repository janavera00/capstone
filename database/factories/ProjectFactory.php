<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'service_id' => rand(1, 4),
            'stepNo' => 1,
            'client_id' => 1,
            'user_id' => 1,
            'location' => $this->faker->address(),
            'lot_number' => 'Lot '.$this->faker->randomNumber(1, true),
            'survey_number' => 'Psd-'.$this->faker->randomNumber(2, true).'-'.$this->faker->randomNumber(6, true),
            'lot_area' => $this->faker->randomNumber(3).' sqr.m.',
            'land_owner' => $this->faker->name(),
            'status' => $this->faker->randomElement(['Active', 'Completed', 'Archived']),
        ];
    }
}
