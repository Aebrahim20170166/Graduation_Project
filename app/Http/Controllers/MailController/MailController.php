<?php
namespace App\Http\Controllers\MailController;
use App\Http\Controllers\Course\CourseController;use App\Models\Course;use App\Models\StudentCourses;
use App\Models\Student;

use Illuminate\Support\Facades\Mail;
use App\Mail\MySendMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MailController extends Controller
{
    public function mail( Request $request)
    {
        $students=StudentCourses::query()->select('student_id','getmail')
            ->where([['pass/fail','=','fail'],['course_id','=',$request->courseID]])
            ->get();
        foreach ($students as $student){
            if($student->getmail!=1) {
                $email = Student::query()->select('email')
                    ->where('student_id', '=', $student->student_id)
                    ->get();
                $student_detail = [
                    'address' => 'Based on your performance for this semester,it seems you are not doing great.',
                    'body'=>'You can try the following: Attend lectures & take notes ,
                    Ask help from subjects instructor ,
                    Find a study partener'

                ];
                StudentCourses::where('course_id', '=', "$request->courseID")
                    ->where('student_id', '=', $student->student_id)
                    ->update([
                        'getmail' => 1
                    ]);
                Mail::to($email)->send(new MySendMail($student_detail));
            }
            }
        Course::where('course_id', '=', "$request->courseID")
            ->update([
                'sentmail' => 1
            ]);

        return (CourseController::showCourse($request->courseID));


        }


}
?>
