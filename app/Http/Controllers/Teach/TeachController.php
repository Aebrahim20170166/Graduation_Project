<?php

namespace App\Http\Controllers\Teach;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\InstructorController;
use App\Models\InstructorCourses;
use Illuminate\Http\Request;
class TeachController extends Controller
{
    //
    public function getTeachedCourses(){
        $id = session('id');
        $courses = TeachController::getInstructorCourses($id);
        //echo ($courses);
        return view("staff/Courses",['courses' => $courses]);
    }
    /*get all courses that instructor teach it*/
    public static function getInstructorCourses($instructorID){
        $result=InstructorCourses::query()->join('courses','instructorcourses.course_id','=',
            'courses.course_id')
            ->select('courses.name','courses.course_id')
            ->where('instructorcourses.instructor_id',
                '=',$instructorID)
            ->get();
        if(!$result->isEmpty())
            return $result;
    }
    public static function getInstructorCoursesApi(Request $request){
        return json_encode(InstructorCourses::query()->join('courses','courses.course_id','=',
            'instructorcourses.course_id')
            ->select('courses.name','courses.course_id')->where('instructorcourses.instructor_id',
                '=',$request->instructorID)->get());
    }
    public function deleteInstructorCourse(Request $request)
    {
        if(InstructorCourses::query()->where('course_id','=',$request->courseID)
            ->where('instructor_id','=',$request->instructorID)
            ->delete())
        {
            //$message="Course Deleted Successfully";
            $courses=self::getInstructorCourses($request->instructorID);
            return view('staff/Courses',['courses' => $courses]);
        }
    }
}
