<?php

namespace App\Http\Controllers\Prediction;

use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Session\SessionController;
use App\Models\Grade;
use App\Models\Quiz;
use App\Models\Session;
use App\Models\StudentResult;
use App\Models\TrainingData;
use Illuminate\Http\Request;
use Phpml\CrossValidation\Split;
use Phpml\Regression;
use Phpml\Dataset\ArrayDataset;
use Phpml\CrossValidation\RandomSplit;
use Phpml\Helper\Predictable;
use Phpml\Math\Matrix;
use function PHPUnit\Framework\lessThanOrEqual;
use function Sodium\randombytes_uniform;
use Phpml\Metric\Accuracy;

class PredictionController extends Controller
{
    public static function buildRegressionModel()
    {
        $samples=array();
        $targets=array();
        $trainingDataRecords=TrainingData::all();
        foreach($trainingDataRecords as $record)
        {
            $sample[]=[$record->quizzesAvg,$record->absence];
            $samples=$sample;
            $targets[]=$record->final_grade;
        }

        $regression = new Regression\LeastSquares();
        $regression->train($samples, $targets);
        return $regression;
    }
    public static function checkprediction(Request $request)
    {
        if(!SessionController::checkNoSessions($request->courseID))
        {
            $response="Early";
            return json_encode($response);
        }
        else{
            $response='Done';
            return json_encode($response);
        }
    }
    //get data from database
    public static function getDataFromDB(Request $request)
    {
        $courseID=$request->courseID;
        $studentID=$request->studentID;
        //$studentID=20170001;
        $quizzes=Quiz::query()->where('courseID','=',$courseID)
            ->select('id')->get();

        $count=0;
        $totalGrade=0;
        foreach($quizzes as $quiz)
        {
            //echo $quiz;
            $record=Grade::query()->select('grade')
                ->where('student_id','=',$studentID)
                ->where('course_id','=',$courseID)
                ->where('quiz_id','=',$quiz->id)
                ->first();
            //echo $record['grade'];
            $totalGrade+=$record['grade'];
            $count++;
        }

        $quizzesAvg=$totalGrade/$count;
        $absence=AttendanceController::getAbsenceOfStudentInCourse($courseID,$studentID);
        $record=[$quizzesAvg,$absence];
        return $record;
    }
    //this function will take request from flutter
    public static function predictFinalGrades(Request $request)
    {
        $record=self::getDataFromDB($request);
        $regression=self::buildRegressionModel();
        $predicted_grade=$regression->predict($record);
        if(ceil($predicted_grade)<50)
        {
            return self::getQuizzesGrades($request);
        }
    }

    //get grades of quizzes student examined it.
    public static function getQuizzesGrades(Request $request)
    {
        $results=Grade::query()->join('quiz','quiz.id','=','grades.quiz_id')
            ->where('grades.student_id','=',$request->studentID)
            ->where('grades.course_id','=',$request->courseID)
            ->where('grades.grade','<',7)
            ->select('quiz.topic','quiz.courseID')
            ->get();
        return $results;
    }
    //to make prediction the instructor must create 10 session in session

    public static function getAccuracy()
    {

        $samples=array();
        $targets=array();
        $predicted=array();
        $trainingDataRecords=TrainingData::all();
        foreach($trainingDataRecords as $record)
        {
            $sample[]=[$record->quizzesAvg,$record->absence];
            $samples=$sample;
            $targets[]=$record->final_grade;
        }
        $dataset = new ArrayDataset($samples,$targets);
        $dataset = new RandomSplit($dataset, 0.2);

        $train_samples = $dataset->getTrainSamples();
        $test_samples = $dataset->getTestSamples();

        $regression = new Regression\LeastSquares();
        $regression->train($train_samples, $dataset->getTrainLabels());
        $Y_pred = $regression->predict($test_samples);

        for ($i=0;$i<count($Y_pred);$i++){
            $Y_pred[$i] = (int) ceil($Y_pred[$i]);
        }
        return Accuracy::score($dataset->getTestLabels(),$Y_pred)*100;

    }

}
