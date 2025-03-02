<?php

namespace App\Models;

use App\Models\ExamSchedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubSubject extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'subject_id','student_class_id','sub_subject_name', 'sub_subject_code', 'full_marks'];


    public function subject(){
        return $this->belongsTo(Subject::class);
    }


    public function examSchedules()
{
    return $this->hasMany(ExamSchedule::class, 'sub_subject_id');
}
}
