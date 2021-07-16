<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $table = "answers";
    protected $fillable = ['id','content','question_id'];

    public $timestamps=false;
}
