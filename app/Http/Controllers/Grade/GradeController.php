<?php

namespace App\Http\Controllers\Grade;

use App\Http\Controllers\Controller;
use App\Models\TrainingData;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function addData()
    {
        // Open a file
        $file = fopen("E:/progames/xampp\htdocs/gp_progect2/Student-grades-prediction-master/student-por.csv", "r");

        // Fetching data from csv file row by row
        while (!(($data = fgetcsv($file)) === false)) {
            TrainingData::create(['quizzesAvg' => $data[2], 'absence' => $data[3], 'final_grade' => $data[4]]);
        }

        // Closing the file
        fclose($file);
    }
}
