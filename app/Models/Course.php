<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = "courses";
    protected $fillable = ['id','name','course_id','kmean_attend','kmean_quiz','naive','sentmail'];

    public $timestamps=false;
}
