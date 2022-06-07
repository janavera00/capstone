<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\LaravelIgnition\Support\Composer\FakeComposer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
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
            'username' => $this->faker->firstname(),
            'password' => bcrypt('password'),
            'image' => "default.svg",
            'role' => $this->faker->randomElement(['Secretary', 'Engineer', 'Surveyor']),
        ];
    }
}
