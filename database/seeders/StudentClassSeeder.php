<?php

namespace Database\Seeders;

use App\Models\StudentClass;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //StudentClass::factory()->count(10)->create();
        StudentClass::create([
            'user_id' => 1,
            'name' => 'SIX',
        ]);
        StudentClass::create([
            'user_id' => 1,
            'name' => 'SEVEN',
        ]);
        StudentClass::create([
            'user_id' => 1,
            'name' => 'EIGHT',
        ]);
        StudentClass::create([
            'user_id' => 1,
            'name' => 'NINE',
        ]);
        StudentClass::create([
            'user_id' => 1,
            'name' => 'TEN',
        ]);
        
    }
}
