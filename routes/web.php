<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\Session\SessionController;
use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\Quiz\QuizController;
use App\Http\Controllers\Question\QuestionController;
use App\Http\Controllers\Choice\ChoiceController;
use App\Http\Controllers\Predection\PredectionController;
use App\Http\Controllers\Announcement\AnnouncementController;
use App\Http\Controllers\Reports\TopFive;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------quizChart
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('quizChart','charts.quizChart');
Route::get('getDataForAttChart','Charts\AttendanceChart@prepareData')->name('getDataForAttChart');
Route::get('attendanceChart','Charts\AttendanceChart@returnview')->name('attendanceChart');

Route::get('getDataForQuizChart','Charts\QuizChart@prepareData')->name('getDataForQuizChart');
Route::get('QuizChart','Charts\QuizChart@returnview')->name('quizChart');

Route::view('chart','testChart');
Route::get('/', function () {
    return view('welcome');
});
Route::get('home', function () {
    return view('staff/Home');
});

Auth::routes(['verify'=>true]);

//Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');


Route::group(['prefix'=>'Registration'],function(){


    Route::get('login','User\UserController@login')->name('login');
    //Route::get('signup','User\UserController@signup')->name('signup');

});

Route::group(['middleware' => 'loggedin'],function (){
    Route::view('course','staff/course');
    //Route::get('/courseView/{courseID}','Course\CourseController@showCourse');
    Route::get('home','Teach\TeachController@getTeachedCourses')->name('home');
    Route::get('getEnrolledCourses','Teach\TeachController@getTeachedCourses')->name('getEnrolledCourses');
});

Route::post('createAccount','User\userRegisteration@signUp')->name("createAccount");
Route::post('validate','User\userRegisteration@login')->name('validate');

Route::view('signup','Registration.SignUp')->name('signup');
Route::view('login','Registration.Login')->name('login');
//validate quiz part


//quiz part
//!!
Route::post('saveQuestion',[QuizController::class,'createQuiz'])->name('saveQuestion');
Route::post('saveQuestion',[QuestionController::class,'saveQuestion'])->name('saveQuestion');
Route::post('saveQuiz',[QuizController::class,'createQuiz'])->name('saveQuiz');
Route::view('createQuiz','Quiz.createQuiz')->name('createQuiz');
Route::view('addQuestion','Quiz.addQuestion')->name('addQuestion');
Route::view('addAnswer','Quiz.addAnswer')->name('addAnswer');
Route::get('/showQuizes/{courseID}','Quiz\QuizController@showQuizes')->name('showQuizes');
Route::get('/showQuiz/{quizID}','Quiz\QuizController@showQuiz')->name('showQuiz');
Route::view('createquiz','staff/quiz')->name('createquiz');
Route::view('/createquiz/{courseID}','staff/quiz');
Route::get('createQuiz/{courseID}',function ($courseID){
    return view('staff/quiz')->with('courseID',$courseID);
})->name('createQuiz');
Route::post('savequiz',[QuizController::class,'createQuiz'])->name('savequiz');
Route::get('removeQuestion',[QuestionController::class,'destroy'])->name('removeQuestion');
Route::get('deleteQuiz/{CourseID}',[QuizController::class,'deleteQuiz']);
Route::post('saveNewQuestions',[QuestionController::class,'saveQuestions'])->name('saveNewQuestions');
Route::post('removeChoice',[ChoiceController::class,'removeChoice'])->name('removeChoice');
Route::post('addOption',[ChoiceController::class,'addChoice'])->name('addOption');
Route::post('updatequestion', [QuestionController::class,'update'])->name('updateQuestion');
//Route::post('savequiz',[QuizController::class,'createQuiz'])->name('savequiz');

//Session part
Route::view('sessions','staff.sessions')->name('sessions');
Route::view('newSession','staff.createNewSession')->name('newSession');
Route::get('getSessions/{courseID}',[SessionController::class,'getSessionsOfCourse']);
Route::view('createSession','staff.createSession')->name('createSession');
Route::post('createSession','Session\SessionController@createSession')->name('create_session');
Route::post('get_session','Session\SessionController@getSessionsOfCourse')->name('get_sessions');


Route::view('QrCode','staff/QrCode')->name('QrCode');

//Course part
Route::get('/courseView/{courseID}',[CourseController::class,'showCourse']);
Route::view('courses','staff.Courses')->name('courses');
Route::view('create_course','staff.createCourse')->name('create_course');
Route::post('addCourse',[CourseController::class,'createCourse'])->name('addCourse');
Route::view('join_course','staff/joinCourse')->name('join_course');
Route::view('course','staff/course');
Route::get('getCourses/{studentID}',[CourseController::class,'getEnrolledCourses']);
Route::post('joinCourse',[CourseController::class,'joinCourse'])->name('joinCourse');
Route::post('delete_course',[CourseController::class,'deleteCourse'])->name('delete_course');
Route::post('delete_instructor_course',[TeachController::class,'deleteInstructorCourse'])->name('delete_instructor_course');
//Course\CourseController@showCourse
//test

Route::get('getAttendance',[AttendanceController::class,'getAttendanceOfSession'])->name('getAttendance');
Route::get('getNumOfAbsents',[AttendanceController::class,'getNumOfAbsenceAndLecturesNamesِInCourse']);

//AttendanceController
//logout
Route::get('/flush', function () {
    Session::flush();
    return redirect()->route('login');
})->name('logout');


Route::view('/createquiz/{courseID}','staff/quiz');
Route::get('createQuiz/{courseID}',function ($courseID){
    return view('staff/quiz')->with('courseID',$courseID);
})->name('createQuiz');
Route::get('removeQuestion','Quiz\QuestionController@destroy')->name('removeQuestion');

//generate data for predection
Route::get('generateFinal',[PredectionController::class,'generateStudentResults']);
Route::get('predict',[PredectionController::class,'predictFinalGrade']);
//predictFinalGrade

//last
Route::post('saveNewQuestions','Quiz\QuestionController@saveQuestions')->name('saveNewQuestions');

Route::post('removeQuestion','Quiz\QuestionController@destroy')->name('removeQuestion');
Route::post('removeChoice','Quiz\QuestionController@removeChoice')->name('removeChoice');
Route::post('addOption','Quiz\QuestionController@addOption')->name('addOption');

Route::post('updatequestion', 'Quiz\QuestionController@update')->name('updateQuestion');


Route::get('getData','K_Means\KmeansController@kMeansquiz');
Route::get('getData','K_Means\KmeansController@readData');
Route::get('update','Grade\GradeController@update');
Route::get('generate','Grade\GradeController@generateAttendanceData');
//Naive algorithm
Route::get('Data','Naeve\NaeveController@naeve');

//Announcement
Route::get('getreport','Reports\TopFive@getTopFive')->name('getreports');
Route::view('Announcements','staff.makeAnnouncement')->name('announcements');
Route::post('makepost','Announcement\AnnouncementController@makepost')->name('makepost');
Route::get('updatepost','Announcement\AnnouncementController@updatepost')->name('updatepost');
Route::get('saveupdate','Announcement\AnnouncementController@saveupdate')->name('saveupdate');
Route::get('deletepost','Announcement\AnnouncementController@deletepost')->name('deletepost');
