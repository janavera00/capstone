<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\File;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ServiceSeeder::class);
        // User::factory(10)->create();
        // Project::factory(20)->create();
        // File::factory(30)->create();
        // Task::factory(20)->create();

        // $userKeys = User::all()->keys();
        // for($i = 0;$i < count($userKeys);$i++){
        //     $userKeys[$i] += 1;
        // }

        // $tasks = Task::all();

        // foreach($tasks as $task){
        //     for($i = 0;$i < rand(1, count($userKeys));$i++){
        //         $task->employees()->attach($userKeys->random());
        //     }
        // }
        // $this->call(UserSeeder::class);
    }
}
