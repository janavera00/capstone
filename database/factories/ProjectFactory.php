<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
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
        $users = User::all();
        $clientKeys = $users->where('role', '=', 'Client')->keys();
        $userKeys = $users->where('role', '!=', 'Client')->keys();

        for($i = 0;$i < count($clientKeys);$i++){
            $clientKeys[$i] += 1;
        }
        for($i = 0;$i < count($userKeys);$i++){
            $userKeys[$i] += 1;
        }

        return [
            'service_id' => rand(1, 4),
            'stepNo' => 1,
            'client_id' => $clientKeys->random(),
            'user_id' => $userKeys->random(),
            'location' => $this->faker->address(),
            'lot_number' => 'Lot '.$this->faker->randomNumber(1, true),
            'survey_number' => 'Psd-'.$this->faker->randomNumber(2, true).'-'.$this->faker->randomNumber(6, true),
            'lot_area' => $this->faker->randomNumber(3).' sqr.m.',
            'land_owner' => $this->faker->name(),
            'status' => $this->faker->randomElement(['Active', 'Archived']),
        ];
    }
}
