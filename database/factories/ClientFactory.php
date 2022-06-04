<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'contact' => '09'.$this->faker->randomNumber(9, true),
            'email' => $this->faker->unique()->safeEmail(),
            'image' => 'photo.jpg',
            'password' => bcrypt('password'), // password
        ];
    }
}
