<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentCourses extends Model
{
    protected $table = "studentcourses";
    protected $fillable = ['id','student_id','token','course_id','performance','attendance','pass/fail','getmail'];

    public $timestamps=false;
}
