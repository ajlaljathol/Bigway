<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Driver User',
            'email' => 'driver@example.com',
            'password' => bcrypt('password'),
            'role' => 'driver',
        ]);

                User::create([
            'name' => 'Caretaker User',
            'email' => 'caretaker@example.com',
            'password' => bcrypt('password'),
            'role' => 'caretaker',
        ]);

                User::create([
            'name' => 'Guardian User',
            'email' => 'guardian@example.com',
            'password' => bcrypt('password'),
            'role' => 'guardian',
        ]);

                User::create([
            'name' => 'Student User',
            'email' => 'student@example.com',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);
    }
}
