<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSchedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'subject_id',
        'student_class_id',
        'name',
        'exam_date',
        'start_time',
        'end_time'
    ];
}
