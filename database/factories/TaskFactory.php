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
        $projectKeys = Project::all()->keys();
        for($i = 0;$i < count($projectKeys);$i++){
            $projectKeys[$i] += 1;
        }
        return [
            'task' => $this->faker->word(),
            'date' => $this->faker->dateTimeInInterval('now')->format("Y-m-d"),
            'time' => $this->faker->time(),
            'status' => 'Active',
            'project_id' => $projectKeys->random(),
        ];
    }
}
