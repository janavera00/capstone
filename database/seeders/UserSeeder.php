<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user['name'] = "Admin";
        $user['address'] = "Address";
        $user['contact'] = "09123456789";
        $user['email'] = "admin@example.com";
        $user['username'] = "Admin";
        $user['password'] = bcrypt('password');
        $user['image'] = "default.svg";
        $user['role'] = "Admin";
        $user->save();

        
        $user = new User();
        $user['name'] = "Secretary";
        $user['address'] = "Address";
        $user['contact'] = "09123456789";
        $user['email'] = "secretary@example.com";
        $user['username'] = "Secretary";
        $user['password'] = bcrypt('password');
        $user['image'] = "default.svg";
        $user['role'] = "Secretary";
        $user->save();

        $user = new User();
        $user['name'] = "Engineer";
        $user['address'] = "Address";
        $user['contact'] = "09123456789";
        $user['email'] = "engineer@example.com";
        $user['username'] = "Engineer";
        $user['password'] = bcrypt('password');
        $user['image'] = "default.svg";
        $user['role'] = "Engineer";
        $user->save();

        $user = new User();
        $user['name'] = "Surveyor";
        $user['address'] = "Address";
        $user['contact'] = "09123456789";
        $user['email'] = "surveyor@example.com";
        $user['username'] = "Surveyor";
        $user['password'] = bcrypt('password');
        $user['image'] = "default.svg";
        $user['role'] = "Surveyor";
        $user->save();

        $user = new User();
        $user['name'] = "Client";
        $user['address'] = "Address";
        $user['contact'] = "09123456789";
        $user['email'] = "client@example.com";
        $user['username'] = "Client";
        $user['password'] = bcrypt('password');
        $user['image'] = "default.svg";
        $user['role'] = "Client";
        $user->save();
    }
}
