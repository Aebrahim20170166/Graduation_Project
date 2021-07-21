<?php

namespace App\Http\Controllers\K_Means;
//require_once __DIR__ . '/vendor/autoload.php';

use App\Http\Controllers\Course\CourseController;
use App\Models\Course;
use App\Models\question;
use App\Models\Quiz;
use App\Models\Session;
use App\Models\StudentCourses;
use App\Models\StudentPerformance;
use App\Models\TrainingSet;
use phpDocumentor\Reflection\Type;
use phpDocumentor\Reflection\Types\Void_;
use Phpml\Classification\KNearestNeighbors;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Phpml\Clustering\KMeans;

use DB;


class KmeansController extends Controller
{
    public static function kMeansquiz(Request $request){
        $quizzes=Quiz::query()->select('id')
            ->where('courseID','=',"$request->courseID")
            ->count();
        if($quizzes>=2) {
            $studentsWithGrades = self::getquizgrade($request);
            $clusterer = new KMeans(5);
            $clusters = $clusterer->cluster($studentsWithGrades);
            $performance = array();

            for ($i = 0; $i < 5; $i++) {
                $students = array_keys($clusters[$i]);
                $numberofstudents = count($students);
                $numberofquizzes = $quizzes;
                $final = 0;
                for ($j = 0; $j < $numberofstudents; $j++) {
                    $sumofgrades = array_sum(array_values($clusters[$i])[$j]);
                    $averageofgrades = $sumofgrades / $numberofquizzes;
                    $final += $averageofgrades;
                }
                if ($numberofstudents != 0) {

                    $clusterDegree = ($final / $numberofstudents) * 10;
                    $rate = self::getRate($clusterDegree);

                    self::saveStudentsPerformance($students, $rate, $request);
                    $performance ["cluster " . ($i + 1)] = $rate;
                }
            }
            Course::where('course_id', '=', "$request->courseID")
                ->update([
                    'kmean_quiz' => 1
                ]);
        }
       return (CourseController::showCourse($request->courseID));
    }

    public function kMeansattendance(Request $request){
        $sessions=Session::query()->select('id')
            ->where('course_id','=',"$request->courseID")
        ->count();
        $numberofstudents=StudentCourses::query()->select('student_id')
            ->where('course_id','=',$request->courseID)
            ->count();
        if($sessions>=2)
        {

        $studentsattend = self::getattendancedata($request);
        $clustering = new KMeans(2);
        $clusters = $clustering->cluster($studentsattend);
        $performance = array();

            for ($i = 0; $i < 2; $i++){
                $students = array_keys($clusters[$i]);
                $numberofstudents= count($students);
                $numberofsessions=$sessions;
                $attended=0;
                for ($j = 0; $j < $numberofstudents; $j++) {
                    $sumofattended = array_sum(array_values($clusters[$i])[$j]);

                    $averageofattended=$sumofattended/$numberofsessions;
                    $attended+=$averageofattended;
                }
                if($numberofstudents !=0 ) {

                    $clusterDegree = ($attended / $numberofstudents);
                    $regularity = self::getRegularity($clusterDegree);

                    self::saveStudentsRegularity($students, $regularity, $request);
                    $performance ["cluster " . ($i + 1)] = $regularity;
                }
        }
            Course::where('course_id', '=', "$request->courseID")
                ->update([
                    'kmean_attend' => 1
                ]);}
        return (CourseController::showCourse($request->courseID));

    }

    public static function getquizgrade(Request $request){
        $studentIDs=StudentCourses::query()->select('student_id')
            ->where('course_id','=',$request->courseID)
            ->get();
        $gradesData=Grade::query()->select('student_id','grade')
            ->where('course_id','=',$request->courseID)
            ->get();

        $studentsWithGrades=[];
        $j=0;
        foreach ($studentIDs as $id)
        {
            $gradesStudent=array();
            //$gradesStudent['id']=$id->student_id;
            //echo $id->student_id."----";
            //$i=1;
            foreach ($gradesData as $grade)
            {
                if($grade->student_id==$id->student_id)
                {
                    $gradesStudent[]=(float)$grade->grade;
                }
            }
            $studentsWithGrades[$id->student_id]=$gradesStudent;
        }
        return $studentsWithGrades;
    }

    public static function getattendancedata(Request $request){
        $studentIDs=StudentCourses::query()->select('student_id')
            ->where('course_id','=',$request->courseID)
            ->get();
        $attendanceData=Attendance::query()->select('student_id','attended')
            ->where('course_id','=',$request->courseID)
            ->get();
        $studentsattend=[];

        foreach ($studentIDs as $id)
        {

            $SID="";
            $attendance=array();

            foreach ($attendanceData as $Data)
            {
                if($id->student_id==$Data->student_id)
                {
                    $attendance[]=(int)$Data->attended;
                    $SID=$Data->student_id;

                }
            }
            if($SID!="")
                $studentsattend[$SID]=$attendance;
        }
        return $studentsattend;
    }

    public static function getRate($clusterDegree){
        if ($clusterDegree>=85) $rate="A";
        elseif ($clusterDegree>=75) $rate="B";
        elseif ($clusterDegree>=65) $rate="C";
        elseif ($clusterDegree>=50) $rate="D";
        else $rate="F";

        return $rate;
    }

    public static function getRegularity($cluster){
        if ($cluster>0.5) $Regularity="regular";
        else $Regularity="irregular";
        return $Regularity;
    }

    public static function saveStudentsPerformance($students,$rate,Request $request){
        foreach ($students as $student){

            StudentCourses::where('student_id', $student)
                ->where ('course_id','=',"$request->courseID")
                ->update([
                    'performance' => $rate
                ]);

            /*StudentPerformance::create([
                'student_id' => $student,
                'performance' => $rate
            ]);*/
        }

    }

    public static function saveStudentsRegularity($students,$Regularity,Request $request){

        foreach ($students as $student) {
            StudentCourses::where('student_id', $student)
                ->where ('course_id','=',"$request->courseID")
                ->update([
                    'attendance' => $Regularity
                ]);
            /*       DB::update('update studentsperformance set attendance = ? where student_id = ?',[$Regularity,$student]);*/

        }
    }





}
