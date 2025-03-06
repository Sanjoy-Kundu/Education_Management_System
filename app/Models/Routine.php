<?php

namespace App\Models;

use App\Models\Day;
use App\Models\Subject;
use App\Models\SubSubject;
use App\Models\StudentClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Routine extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_class_id',
        'subject_id',
        'sub_subject_id',
        'day_id',
        'date',
        'starting_time',
        'ending_time',
    ];


    // protected $attributes = [
    //     'sub_subject_id' => 0,
    // ];
    public function className(){
        return $this->belongsTo(StudentClass::class, 'student_class_id');
    }
    public function subjectName(){
        return $this->belongsTo(Subject::class, 'subject_id');
    }
    public function subjectPaper(){
        return $this->belongsTo(SubSubject::class, 'sub_subject_id');
    }

    public function day(){
        return $this->belongsTo(Day::class, 'day_id');
    }
}
