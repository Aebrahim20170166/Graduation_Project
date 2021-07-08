<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentPerformance extends Model
{
    protected $table = "studentsPerformance";
    protected $fillable = ['student_id','performance','attendance','fail/pass'];

    public $timestamps = false;
}
