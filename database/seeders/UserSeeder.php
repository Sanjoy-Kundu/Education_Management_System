<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Amir',
            'email' => 'amir@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'name' => 'Nurul',
            'email' => 'nurul@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'student',
        ]);

        User::create([
            'name' => 'Rifqi',
            'email' => 'rifqi@gmail.com',
            'password' => Hash::make('12345678')
        ]);
    }
}
