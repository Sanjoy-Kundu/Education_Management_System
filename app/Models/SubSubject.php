<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubject extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'subject_id', 'sub_subject_name', 'sub_subject_code', 'full_marks'];
}
