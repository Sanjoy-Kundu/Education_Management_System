<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Day::create([
            'user_id' => 1,
            'name' => 'Saturday',
        ]);
        
        Day::create([
            'user_id' => 1,
            'name' => 'Sunday',
        ]);
        Day::create([
            'user_id' => 1,
            'name' => 'Monday',
        ]);
        Day::create([
            'user_id' => 1,
            'name' => 'Tuesday',
        ]);
        Day::create([
            'user_id' => 1,
            'name' => 'Wednesday',
        ]);
        Day::create([
            'user_id' => 1,
            'name' => 'Thursday',
        ]);
        Day::create([
            'user_id' => 1,
            'name' => 'Friday',
        ]);
    }
}
