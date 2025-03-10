<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "phone",
        "gender",
        "dob",
        "address",
        "qualification",
        "institution",
        "duration",
        "year_of_graduation",
        "subject",
        "joining_date",
        "salary",
        "status",
        "profile_picture",
        "cv",
        "id_card",
        "passport",
        "bank_account",
        "tin",
        "nid",
        "driving_license",
        "description"
    ];
}
