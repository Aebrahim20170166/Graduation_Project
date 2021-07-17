<?php
namespace App\Http\Controllers\Reports;
session()->start();

use App\Http\Controllers\K_Means\KmeansController;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\Grade;
use App\Models\Quiz;
use App\Models\Student;
use App\Models\Announcement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\requestTrait;

class report extends Controller
{

    public function attendancereport(Request $request)
    {
        $studentIDs=Student::query()->select('student_id','Fname','Lname')
            ->get();
        $attendanceData=Attendance::query()->select('student_id','attended')->where('course_id','=',"$request->courseID")
            ->get();
        $studentsattend=[];
        $studentid=[];
        $studentnames=[];

        foreach ($studentIDs as $id)
        {

            $SID="";
            $attendance=0;
            $sessions=[];
            foreach ($attendanceData as $Data)
            {

                if($id->student_id==$Data->student_id)
                {
                    $sessions[]=(int)$Data->attended;
                    $attendance=$attendance+(int)$Data->attended;
                    $SID=$Data->student_id;


                }
            }
            if($SID!=""&&$attendance==sizeof($sessions))
            {
                $studentid[]=$SID;
            $Sname=Student::query()->select('Fname','Lname')
                ->where('student_id','=',$SID)
                ->get();
            foreach ($Sname as $name)
            $studentnames[]=$name->Fname ." " .$name->Lname;}
        }
        $studentsattend['id']= $studentid;
        $studentsattend['name']= $studentnames;


        return view('staff/attendancereport',['regularstudents'=>$studentsattend ,'courseID'=>$request->courseID]) ;
    }
    public function quizreport (Request $request)
    {

        $studentIDs=Student::query()->select('student_id')
            ->get();
        $gradesData=Grade::query()->select('student_id','grade','quiz_id')
            ->where('course_id','=',"$request->courseID")
            ->get();
        $quizsData=Quiz::query()->select('id','total_grade')
            ->where('courseID','=',"$request->courseID")
            ->get();
        $studentid=[];
        $studentnames=[];
        $studentsWithGrades=[];
        foreach ($studentIDs as $id)
        {

            $j=0;

            $gradesStudent=array();
            //$gradesStudent['id']=$id->student_id;
            //echo $id->student_id."----";
            //$i=1;
            foreach ($gradesData as $grade)
            {
                if($grade->student_id==$id->student_id)
                {

                    $gradesStudent[]=(float)$grade->grade;
                    foreach ($quizsData as $quiz)
                    {  if($grade->quiz_id==$quiz->id && $grade->grade==$quiz->total_grade ) {
                            $j++;
                        }
                }}
            }

            if ($j==count($quizsData))
        {  $studentid[]=$id->student_id;
        $Sname=Student::query()->select('Fname','Lname')
        ->where('student_id','=',$id->student_id)
        ->get();
        foreach ($Sname as $name)
        $studentnames[]=$name->Fname ." " .$name->Lname;
        }
        }
        $studentsWithGrades['id']= $studentid;
        $studentsWithGrades['name']= $studentnames;


        return view('staff/quizsreport',['excellentstudents'=>$studentsWithGrades,'courseID'=>$request->courseID]) ;
        }

}
