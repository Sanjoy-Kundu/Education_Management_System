<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction(); // Transaction Start
        
        try {
            // Admin Insert
            User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
            ]);

            // Teachers List
            $teachers = [
                ['name' => 'SM. Kamrul Hassan', 'email' => 'kamrul@gmail.com'],
                ['name' => 'Swapna Kundu', 'email' => 'swapna@gmail.com'],
                ['name' => 'Jhankar Mahbub', 'email' => 'mahbub@gmail.com'],
                ['name' => 'Hasin Hayder', 'email' => 'hasin@gmail.com'],
            ];

            foreach ($teachers as $teacher) {
                $user = User::create([
                    'name' => $teacher['name'],
                    'email' => $teacher['email'],
                    'password' => Hash::make('12345678'),
                    'role' => 'teacher',
                ]);

                // Teacher Table-এ Insert
                Teacher::create([
                    'user_id' => $user->id,
                ]);
            }

            //  Student Insert
            User::create([
                'name' => 'Nurul',
                'email' => 'nurul@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'student',
            ]);

            // Default User (No Role)
            User::create([
                'name' => 'Rifqi',
                'email' => 'rifqi@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'student',
            ]);

            DB::commit(); //  Transaction Commit
            echo " User & Teacher Data Seeded Successfully\n";

        } catch (\Exception $e) {
            DB::rollBack(); 
            echo "Error Seeding Data: " . $e->getMessage() . "\n";
        }
    }
}