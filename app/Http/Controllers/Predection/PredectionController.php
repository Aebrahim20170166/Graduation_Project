<?php

namespace App\Http\Controllers\Predection;

use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Session\SessionController;
use App\Models\Grade;
use App\Models\Quiz;
use App\Models\Session;
use App\Models\StudentResult;
use App\Models\TrainingData;
use Illuminate\Http\Request;
use Phpml\Regression;
use Phpml\Helper\Predictable;
use Phpml\Math\Matrix;
use function PHPUnit\Framework\lessThanOrEqual;
use function Sodium\randombytes_uniform;

class PredectionController extends Controller
{
    /*public static function generateStudentResults()
    {
        $id=20170001;
        $course_id="IS215";
        for($id;$id<=20170500;$id++)
        {
            $numOfAttendance=rand(0,20);
            $finalResult=rand(20,60);

            $yearWork=Grade::query()->where('student_id','=',$id)
                ->where('course_id','=',$course_id)
                ->sum('grade');
            StudentResult::create(['student_id'=>$id,'course_id'=>$course_id,'number_of_attendance'=>$numOfAttendance,
                'year_works'=>$yearWork,'finalresult'=>$finalResult]);
        }
    }*/
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
    //this function will take request from flutter
    public static function predictFinalGrades(Request $request)
    {
        $courseID=$request->courseID;
        //$courseID='IS215';
        if(!SessionController::checkNoSessions($courseID))
        {
            $response="Now you cannot predict your indicator for final grade because there is no enough data";
            return json_encode($response);
        }
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
        $regression=self::buildRegressionModel();
        $predicted_grade=$regression->predict($record);
        $grade='';
        if($predicted_grade<30)
            $grade="F";
        else if($predicted_grade>30 && $predicted_grade<37)
            $grade="D";
        else if($predicted_grade>37 && $predicted_grade<45)
            $grade="C";
        else if($predicted_grade>45 && $predicted_grade<52)
            $grade="B";
        else
            $grade="A";

        return json_encode($grade);
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

        $regression = new Regression\LeastSquares();
        $regression->train($samples, $targets);
        foreach($samples as $sample)
        {
            $predicted[]=round($regression->predict($sample));
        }
        $count2=0;
        for($i=0;$i<count($predicted);$i++)
        {
            if($predicted[$i]!= $targets[$i])
                $count2++;
        }
        return $count2;
        return $predicted;
    }

}
