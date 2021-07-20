<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingData extends Model
{
    protected $table = "trainingdata";
    protected $fillable = ['id','quizzesAvg','absence','final_grade'];

    public $timestamps = false;
}
