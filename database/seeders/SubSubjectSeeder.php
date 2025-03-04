<?php

namespace Database\Seeders;

use App\Models\SubSubject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //six
        //bangla
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 1,
            'student_class_id' => 1,
            'sub_subject_name' => 'First Paper',
            'sub_subject_code' => 101,
            'full_marks' => 100,
        ]);
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 1,
            'student_class_id' => 1,
            'sub_subject_name' => 'Second Paper',
            'sub_subject_code' => 102,
            'full_marks' => 100,
        ]);
        //english
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 2,
            'student_class_id' => 1,
            'sub_subject_name' => 'First Paper',
            'sub_subject_code' => 101,
            'full_marks' => 100,
        ]);
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 2,
            'student_class_id' => 1,
            'sub_subject_name' => 'Second Paper',
            'sub_subject_code' => 102,
            'full_marks' => 100,
        ]);
        //math
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 3,
            'student_class_id' => 1,
            'sub_subject_code' => 103,
            'full_marks' => 100,
        ]);
        //science
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 4,
            'student_class_id' => 1,
            'sub_subject_code' => 104,
            'full_marks' => 100,
        ]);
        //social science
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 5,
            'student_class_id' => 1,
            'sub_subject_code' => 105,
            'full_marks' => 100,
        ]);
        //social science
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 6,
            'student_class_id' => 1,
            'sub_subject_code' => 106,
            'full_marks' => 100,
        ]);

        //class 7
        //bangla
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 7,
            'student_class_id' => 2,
            'sub_subject_name' => 'First Paper',
            'sub_subject_code' => 101,
            'full_marks' => 100,
        ]);
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 7,
            'student_class_id' => 2,
            'sub_subject_name' => 'Second Paper',
            'sub_subject_code' => 102,
            'full_marks' => 100,
        ]);
        //english
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 8,
            'student_class_id' => 2,
            'sub_subject_name' => 'First Paper',
            'sub_subject_code' => 101,
            'full_marks' => 100,
        ]);
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 8,
            'student_class_id' => 2,
            'sub_subject_name' => 'Second Paper',
            'sub_subject_code' => 102,
            'full_marks' => 100,
        ]);
        //math
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 9,
            'student_class_id' => 2,
            'sub_subject_code' => 103,
            'full_marks' => 100,
        ]);
        //science
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 10,
            'student_class_id' => 2,
            'sub_subject_code' => 104,
            'full_marks' => 100,
        ]);
        //social science
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 11,
            'student_class_id' => 2,
            'sub_subject_code' => 105,
            'full_marks' => 100,
        ]);
        //social science
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 12,
            'student_class_id' => 2,
            'sub_subject_code' => 106,
            'full_marks' => 100,
        ]);

        //class 8
        //bangla
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 13,
            'student_class_id' => 3,
            'sub_subject_name' => 'First Paper',
            'sub_subject_code' => 101,
            'full_marks' => 100,
        ]);
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 13,
            'student_class_id' => 3,
            'sub_subject_name' => 'Second Paper',
            'sub_subject_code' => 102,
            'full_marks' => 100,
        ]);
        //english
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 14,
            'student_class_id' => 3,
            'sub_subject_name' => 'First Paper',
            'sub_subject_code' => 101,
            'full_marks' => 100,
        ]);
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 14,
            'student_class_id' => 3,
            'sub_subject_name' => 'Second Paper',
            'sub_subject_code' => 102,
            'full_marks' => 100,
        ]);
        //math
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 15,
            'student_class_id' => 3,
            'sub_subject_code' => 103,
            'full_marks' => 100,
        ]);
        //science
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 16,
            'student_class_id' => 3,
            'sub_subject_code' => 104,
            'full_marks' => 100,
        ]);
        //social science
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 17,
            'student_class_id' => 3,
            'sub_subject_code' => 105,
            'full_marks' => 100,
        ]);
        //social science
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 18,
            'student_class_id' => 3,
            'sub_subject_code' => 106,
            'full_marks' => 100,
        ]);

        //class 9
        //bangla
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 19,
            'student_class_id' => 4,
            'sub_subject_name' => 'First Paper',
            'sub_subject_code' => 101,
            'full_marks' => 100,
        ]);
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 19,
            'student_class_id' => 4,
            'sub_subject_name' => 'Second Paper',
            'sub_subject_code' => 102,
            'full_marks' => 100,
        ]);
        //english
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 20,
            'student_class_id' => 4,
            'sub_subject_name' => 'First Paper',
            'sub_subject_code' => 101,
            'full_marks' => 100,
        ]);
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 20,
            'student_class_id' => 4,
            'sub_subject_name' => 'Second Paper',
            'sub_subject_code' => 102,
            'full_marks' => 100,
        ]);
        //math
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 21,
            'student_class_id' => 4,
            'sub_subject_code' => 103,
            'full_marks' => 100,
        ]);
        //ict
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 22,
            'student_class_id' => 4,
            'sub_subject_code' => 104,
            'full_marks' => 100,
        ]);
        //physic
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 23,
            'student_class_id' => 4,
            'sub_subject_name' => 'First Paper',
            'sub_subject_code' => 221,
            'full_marks' => 100,
        ]);
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 23,
            'student_class_id' => 4,
            'sub_subject_name' => 'Second Paper',
            'sub_subject_code' => 222,
            'full_marks' => 100,
        ]);
        //Chemistry
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 24,
            'student_class_id' => 4,
            'sub_subject_name' => 'First Paper',
            'sub_subject_code' => 223,
            'full_marks' => 100,
        ]);
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 24,
            'student_class_id' => 4,
            'sub_subject_name' => 'Second Paper',
            'sub_subject_code' => 224,
            'full_marks' => 100,
        ]);

        //Biology
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 25,
            'student_class_id' => 4,
            'sub_subject_name' => 'First Paper',
            'sub_subject_code' => 225,
            'full_marks' => 100,
        ]);
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 25,
            'student_class_id' => 4,
            'sub_subject_name' => 'Second Paper',
            'sub_subject_code' => 226,
            'full_marks' => 100,
        ]);

        //geography
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 26,
            'student_class_id' => 4,
            'sub_subject_name' => 'First Paper',
            'sub_subject_code' => 511,
            'full_marks' => 100,
        ]);
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 26,
            'student_class_id' => 4,
            'sub_subject_name' => 'Second Paper',
            'sub_subject_code' => 512,
            'full_marks' => 100,
        ]);

        //history
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 27,
            'student_class_id' => 4,
            'sub_subject_name' => 'First Paper',
            'sub_subject_code' => 515,
            'full_marks' => 100,
        ]);
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 27,
            'student_class_id' => 4,
            'sub_subject_name' => 'Second Paper',
            'sub_subject_code' => 516,
            'full_marks' => 100,
        ]);

        //civics
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 28,
            'student_class_id' => 4,
            'sub_subject_name' => 'First Paper',
            'sub_subject_code' => 505,
            'full_marks' => 100,
        ]);
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 28,
            'student_class_id' => 4,
            'sub_subject_name' => 'Second Paper',
            'sub_subject_code' => 506,
            'full_marks' => 100,
        ]);

        //Echonomics
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 29,
            'student_class_id' => 4,
            'sub_subject_name' => 'First Paper',
            'sub_subject_code' => 303,
            'full_marks' => 100,
        ]);
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 29,
            'student_class_id' => 4,
            'sub_subject_name' => 'Second Paper',
            'sub_subject_code' => 304,
            'full_marks' => 100,
        ]);


        //class 10
        //bangla
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 30,
            'student_class_id' => 5,
            'sub_subject_name' => 'First Paper',
            'sub_subject_code' => 101,
            'full_marks' => 100,
        ]);
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 30,
            'student_class_id' => 5,
            'sub_subject_name' => 'Second Paper',
            'sub_subject_code' => 102,
            'full_marks' => 100,
        ]);
        //english
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 31,
            'student_class_id' => 5,
            'sub_subject_name' => 'First Paper',
            'sub_subject_code' => 101,
            'full_marks' => 100,
        ]);
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 31,
            'student_class_id' => 5,
            'sub_subject_name' => 'Second Paper',
            'sub_subject_code' => 102,
            'full_marks' => 100,
        ]);
        //math
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 32,
            'student_class_id' => 5,
            'sub_subject_code' => 103,
            'full_marks' => 100,
        ]);
        //ict
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 33,
            'student_class_id' => 5,
            'sub_subject_code' => 104,
            'full_marks' => 100,
        ]);
        //physic
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 34,
            'student_class_id' => 5,
            'sub_subject_name' => 'First Paper',
            'sub_subject_code' => 221,
            'full_marks' => 100,
        ]);
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 34,
            'student_class_id' => 5,
            'sub_subject_name' => 'Second Paper',
            'sub_subject_code' => 222,
            'full_marks' => 100,
        ]);
        //Chemistry
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 35,
            'student_class_id' => 5,
            'sub_subject_name' => 'First Paper',
            'sub_subject_code' => 223,
            'full_marks' => 100,
        ]);
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 35,
            'student_class_id' => 5,
            'sub_subject_name' => 'Second Paper',
            'sub_subject_code' => 224,
            'full_marks' => 100,
        ]);

        //Biology
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 36,
            'student_class_id' => 5,
            'sub_subject_name' => 'First Paper',
            'sub_subject_code' => 225,
            'full_marks' => 100,
        ]);
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 36,
            'student_class_id' => 5,
            'sub_subject_name' => 'Second Paper',
            'sub_subject_code' => 226,
            'full_marks' => 100,
        ]);

        //geography
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 37,
            'student_class_id' => 5,
            'sub_subject_name' => 'First Paper',
            'sub_subject_code' => 511,
            'full_marks' => 100,
        ]);
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 37,
            'student_class_id' => 5,
            'sub_subject_name' => 'Second Paper',
            'sub_subject_code' => 512,
            'full_marks' => 100,
        ]);

        //history
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 38,
            'student_class_id' => 5,
            'sub_subject_name' => 'First Paper',
            'sub_subject_code' => 515,
            'full_marks' => 100,
        ]);
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 38,
            'student_class_id' => 5,
            'sub_subject_name' => 'Second Paper',
            'sub_subject_code' => 516,
            'full_marks' => 100,
        ]);

        //civics
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 39,
            'student_class_id' => 5,
            'sub_subject_name' => 'First Paper',
            'sub_subject_code' => 505,
            'full_marks' => 100,
        ]);
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 39,
            'student_class_id' => 5,
            'sub_subject_name' => 'Second Paper',
            'sub_subject_code' => 506,
            'full_marks' => 100,
        ]);

        //Echonomics
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 40,
            'student_class_id' => 5,
            'sub_subject_name' => 'First Paper',
            'sub_subject_code' => 303,
            'full_marks' => 100,
        ]);
        SubSubject::create([
            'user_id' => 1,
            'subject_id' => 40,
            'student_class_id' => 5,
            'sub_subject_name' => 'Second Paper',
            'sub_subject_code' => 304,
            'full_marks' => 100,
        ]);
    }
}
