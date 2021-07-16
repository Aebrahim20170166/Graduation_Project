<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = "quiz";
    protected $fillable = ['id','courseID','topic','total_grade','date'];

    public $timestamps=false;
    public $incrementing = false;
}
