<?php

namespace Database\Seeders;

use App\Models\ExamSchedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExamSheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExamSchedule::create([
            'user_id' => 1,
            'subject_id'=> 13,
            'sub_subject_id' => 17,
            'student_class_id' => 3,
            'name' => 'First Semister',
            'exam_date' => '2025-01-09',
            'start_time' => '14:00:00',
            'end_time' => '17:00:00',
        ]);
        
        ExamSchedule::create([
            'user_id' => 1,
            'subject_id'=> 13,
            'sub_subject_id' => 18,
            'student_class_id' => 3,
            'name' => 'First Semister',
            'exam_date' => '2025-01-11',
            'start_time' => '14:00:00',
            'end_time' => '17:00:00',
        ]);


        ExamSchedule::create([
            'user_id' => 1,
            'subject_id'=> 14,
            'sub_subject_id' => 19,
            'student_class_id' => 3,
            'name' => 'First Semister',
            'exam_date' => '2025-01-12',
            'start_time' => '14:00:00',
            'end_time' => '17:00:00',
        ]);
        ExamSchedule::create([
            'user_id' => 1,
            'subject_id'=> 14,
            'sub_subject_id' => 20,
            'student_class_id' => 3,
            'name' => 'First Semister',
            'exam_date' => '2025-01-13',
            'start_time' => '14:00:00',
            'end_time' => '17:00:00',
        ]);

        ExamSchedule::create([
            'user_id' => 1,
            'subject_id'=> 15,
            'sub_subject_id' => 21,
            'student_class_id' => 3,
            'name' => 'First Semister',
            'exam_date' => '2025-01-14',
            'start_time' => '14:00:00',
            'end_time' => '17:00:00',
        ]);
        ExamSchedule::create([
            'user_id' => 1,
            'subject_id'=> 16,
            'sub_subject_id' => 22,
            'student_class_id' => 3,
            'name' => 'First Semister',
            'exam_date' => '2025-01-15',
            'start_time' => '14:00:00',
            'end_time' => '17:00:00',
        ]);
        ExamSchedule::create([
            'user_id' => 1,
            'subject_id'=> 17,
            'sub_subject_id' => 23,
            'student_class_id' => 3,
            'name' => 'First Semister',
            'exam_date' => '2025-01-16',
            'start_time' => '14:00:00',
            'end_time' => '17:00:00',
        ]);
        ExamSchedule::create([
            'user_id' => 1,
            'subject_id'=> 18,
            'sub_subject_id' => 24,
            'student_class_id' => 3,
            'name' => 'First Semister',
            'exam_date' => '2025-01-18',
            'start_time' => '14:00:00',
            'end_time' => '17:00:00',
        ]);


       
    }
}
