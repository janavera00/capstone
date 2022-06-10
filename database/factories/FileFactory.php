<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\File>
 */
class FileFactory extends Factory
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
            'title' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'project_id' => $projectKeys->random(),
            'status' => $this->faker->randomElement(['In Folder', 'Digital', 'Away']),
            'image_path' => "copy-solid.svg",
        ];
    }
}
