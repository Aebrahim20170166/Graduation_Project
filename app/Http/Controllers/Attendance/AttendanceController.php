<?php

/*
 * Author :Alaa Ibrahim
 * */
namespace App\Http\Controllers\Attendance;

use App\Models\Attendance;
use App\Models\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /*
     * Here after the student scan the qr code
     * i take the content of tha qr code and the id of this student and save it in the attendance table
     * if the attendance created i return success message*/
    public static function addAttendence($QrContent,$studentID){

        if(Attendance::create(['course_id'=>$QrContent->courseID, 'student_id'=>$studentID, 'session_id'=>$QrContent->sessionID]))
        {
            return json_encode('success');
        }
        else{
            return json_encode('error');
        }
    }
    /*If the instructor want to know who attend the session
     * Here i get the attendance of specific session
     * take the session id and return the id and name for each student */
    public function getAttendanceOfSession(Request $request){
        $attendances=Attendance::query()->join('students','students.student_id'
            ,'=','attendence.student_id')
            ->select('students.Fname','students.Lname','students.student_id')
            ->where('attendence.session_id','=',$request->sessionID)
            ->where('attendence.course_id','=',$request->courseID)
            ->get();
        if($request->wantsJson())
            return json_encode($attendances);
        else{
            return view('staff/attendanceOfSession',['attendances'=>$attendances]);
        }
    }
    /*Here to get tha number of times of absence of student in course
    i get number of sessions in this course then number of attendance of the student
    and subtract number of sessions from number of attendance to get the absence of the student
    */
    public function getNumOfAbsenceAndLecturesNamesِInCourse(Request $request){
        //get number of times the student not attend it in this course
        /** @var TYPE_NAME $lecturesNames */
        $lecturesNames=Attendance::query()->join('sessions','sessions.session_id','=',
        'attendence.session_id')
            ->where('attendence.course_id','=',$request->courseID)
            ->where('attendence.student_id','=',$request->studentID)
            ->where('attendence.attended','=',0)
            ->select('sessions.session_name','sessions.date')->get();

        //$results= [$numOfAttendance,
            //$lecturesNames];
        return json_encode($lecturesNames);

    }
    public static function getAbsenceOfStudentInCourse($courseID,$studentID)
    {
        $numOfAttendance=Attendance::query()->where('course_id','=',$courseID)
            ->where('student_id','=',$studentID)
            ->where('attended','=',0)
            ->get()->count();
        return $numOfAttendance;
    }

}
