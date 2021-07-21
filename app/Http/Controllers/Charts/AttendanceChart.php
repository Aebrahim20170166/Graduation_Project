<?php

namespace App\Http\Controllers\Charts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Session;
use App\Http\Controllers\Attendance\AttendanceController;

class AttendanceChart extends Controller
{
    //
    public function prepareData(Request $request){
//        return $request;
        $courseID = $request->courseID;
        // this variables contains sessions names and their ids
        $sessions = Session\SessionController::getAllSessionsOfCourse($courseID);

        //this variables contains sessions name and the number of attendance for this session
        return $sessionsAttendanceCount = AttendanceController::getSessionsAttendance($sessions);
//        return view('charts/attendanceChart',['data'=>$sessionsAttendanceCount]);

    }

    public function returnview(Request $request){
//        return $request;
        return view('charts/attendanceChart',['courseID' => $request->courseID]);
    }
}
