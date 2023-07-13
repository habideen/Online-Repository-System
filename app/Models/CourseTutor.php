<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseTutor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_info_id'
    ];
}
