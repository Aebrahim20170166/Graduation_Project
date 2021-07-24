<?php


namespace App\Http\Controllers\Naeve;

use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\MailController\MailController;
use App\Models\Course;
use App\Models\question;
use App\Models\StudentCourses;
use App\Models\TrainingSet;
use phpDocumentor\Reflection\Type;
use Phpml\Classification\KNearestNeighbors;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Phpml\Clustering\KMeans;
use DB;
use Phpml\Classification\NaiveBayes;

class NaeveController extends Controller
{
    public static function naeve($courseID)
    {
        $flags=Course::query()->select('kmean_attend','kmean_quiz')
            ->where('course_id','=',$courseID)
            ->get();
            $TrainingSet = self::getTrainingSet();

            $samples = $TrainingSet[0];
            $labels = $TrainingSet[1];
            $classifier = new NaiveBayes();
            $classifier->train($samples, $labels);
            $prediction = self::getStudentsPerformance($courseID);

            foreach ($prediction as $key => $value) {
                $result = $classifier->predict($prediction[$key]);
                self::Saveprediction($key, $result, $courseID);
            }

        MailController::mail($courseID);
    }



    public static function getStudentsPerformance($courseID){

        $studentIDs=Student::query()->select('student_id')
            ->get();
        $PerformanceData=StudentCourses::query()->select('student_id','performance','attendance')
            ->where('course_id','=',$courseID)
            ->get();
        $students=[];

        foreach ($studentIDs as $id)
        {

            $SID="";
            $performance=array();

            foreach ($PerformanceData as $Data)
            {
                if($id->student_id==$Data->student_id)
                {
                    $performance[]=$Data->performance;
                    $performance[]=$Data->attendance;
                    $SID=$Data->student_id;

                }
            }
            if($SID!="")
                $students[$SID]=$performance;
        }
        return $students;
    }
    public static function getTrainingSet(){
        $samples  = TrainingSet::query()->select('performance', 'attendance')
            ->get();
        $labels = TrainingSet::query()->select('fail/pass')
            ->get();
        $samples = $samples->toArray();
        $labels = $labels->toArray();
        $samplesarray=array();
        foreach ($samples as $sample){
            $samplearr=array();
            foreach ($sample as $key => $value ){
                $samplearr[]=$value;
            }
            $samplesarray[]=$samplearr;
        }
        $labelsarray=array();

        foreach ($labels as $label){
            foreach ($label as $key => $value ){
                $labelarr=$value;
            }
            $labelsarray[]=$labelarr;
        }


        return array($samplesarray, $labelsarray);
    }


    public static function Saveprediction($student_id,$prediction,$courseID)
    {
        studentcourses::where([['student_id','=', $student_id],['course_id','=',$courseID]])
            ->update([
                'pass/fail' => $prediction
            ]);
    }

}

