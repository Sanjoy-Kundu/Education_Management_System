<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
