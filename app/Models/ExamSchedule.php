<?php

namespace App\Models;

use App\Models\Subject;
use App\Models\StudentClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamSchedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'subject_id',
        'sub_subject_id',
        'student_class_id',
        'name',
        'exam_date',
        'start_time',
        'end_time'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function studentClass()
    {
        return $this->belongsTo(StudentClass::class);
    }
    
}
