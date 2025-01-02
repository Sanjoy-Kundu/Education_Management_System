<?php

namespace App\Models;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentClass extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','name','section','capacity'];

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'student_class_id');
    }
}
