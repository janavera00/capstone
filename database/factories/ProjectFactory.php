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
            'client_id' => $this->faker->randomDigit()+1,
            'engineer' => $this->faker->randomDigit()+1,
            'location' => $this->faker->address(),
            'survey_number' => 'Lot '.$this->faker->randomNumber(1, true).' Psd-'.$this->faker->randomNumber(2, true).'-'.$this->faker->randomNumber(6, true),
            'lot_area' => $this->faker->randomNumber(3).' sqr.m.',
            'land_owner' => $this->faker->name(),
            'status' => $this->faker->randomElement(['Active', 'Completed', 'Archived']),
        ];
    }
}
