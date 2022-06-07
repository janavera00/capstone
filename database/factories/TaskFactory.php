<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'task' => $this->faker->word(),
            'date' => $this->faker->dateTimeInInterval('now', '2 months')->format("Y-m-d"),
            'time' => $this->faker->time(),
            'status' => 'Active',
            'project_id' => $this->faker->randomDigit()+1,
        ];
    }
}
