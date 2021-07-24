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
    public static function mail($courseID)
    {
        $students = StudentCourses::query()->select('student_id', 'getmail')
            ->where([['pass/fail', '=', 'fail'], ['course_id', '=', $courseID]])
            ->get();
        foreach ($students as $student) {
            $email = Student::query()->select('email')
                ->where('student_id', '=', $student->student_id)
                ->get();
            $student_detail = [
                'address' => 'Based on your performance for this semester,it seems you are not doing great.',
                'body' => 'You can try the following: Attend lectures & take notes ,
                    Ask help from subjects instructor ,
                    Find a study partener'

            ];

            Mail::to($email)->send(new MySendMail($student_detail));
//            Mail::send('emails.activation',$student_detail, function($message) {
//                $message->from('mohamed.3ashour07@gmail.com', 'eman');
//
//                $message->to('mohamed.3ashour07@gmail.com')->subject('subject');
//            });
        }

    }}
