<?php

namespace App\Models;

use App\Models\StudentClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'student_class_id',
        'name',
        'code',
        'full_marks'
    ];

    //first do it then suject classmodel
    public function studentClass()
    {
        return $this->belongsTo(StudentClass::class, 'student_class_id');
    }

    public function examSchedules()
    {
        return $this->hasMany(ExamSchedule::class);
    }
}
