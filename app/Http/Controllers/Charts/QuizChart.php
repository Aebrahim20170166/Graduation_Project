<?php

namespace App\Http\Controllers\Charts;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Quiz\QuizController;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Http\Controllers\quiz;

class QuizChart extends Controller
{
    //
    public function prepareData(Request $request){
        // contains the quizzes ids and their topics
        $quizzes = QuizController::getQuizzesOfCourse($request->courseID);

        $quizzesGradeAvg = QuizController::getAvgGradeForQuiz($quizzes);
        return $quizzesGradeAvg;
    }

    public function returnview(Request $request){
//        return $request;
        return view('charts/quizChart',['courseID' => $request->courseID]);
    }
}
