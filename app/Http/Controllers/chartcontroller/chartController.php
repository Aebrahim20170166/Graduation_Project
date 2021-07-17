<?php
namespace App\Http\Controllers\chartcontroller;

use App\Models\Session;
use App\Models\Attendance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class chartController extends Controller
{
    public static function getSessionsOfCourse(Request $request){
        $stud=[];
        $sessions=Session::query()->select('session_name','session_id')
            ->where('course_id','=',$request->courseID)
            ->get();
        if($request->wantsJson()){
            return json_encode($sessions);
        }
        foreach($sessions as $sessionn)
        {
            $students=Attendance::query()->select('student_id')
                ->where('session_id','=',$sessionn->session_id)
                ->where('attended','=','1')
                ->get();
            $stud[]=count($students);
        }
        return view('staff\linechart', ['students'=>$stud,'sessions'=>$sessions]);
    }
}
