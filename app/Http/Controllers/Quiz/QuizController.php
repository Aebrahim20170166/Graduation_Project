<?php

/*
 * Author : Alaa Ibrahim
 * */
namespace App\Http\Controllers\Quiz;
session_start();

use App\Http\Controllers\Choice\ChoiceController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\K_Means\KmeansController;
use App\Http\Controllers\Question\QuestionController;
use App\Http\Controllers\Traits\requestTrait;
use App\Models\Choice;
use App\Models\Grade;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\StudentCourses;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /*Create new quiz*/
    public function createQuiz(Request $request){
//        return $request;
        $courseID = $request->courseID;
        $topic = $request->quizTopic;
        $questionCount = $request -> questionsCount;
        $totalGrade = 0;
        for ($i=1; $i<=$questionCount; $i++){
            $questionGrade = 'questionGrade'.$i;
            $totalGrade += (int)$request->$questionGrade;
        }
//        return $totalGrade;
        $quizID = $this->saveQuiz($courseID,$topic,$totalGrade);
        $request->merge(['quizID'=> $quizID]);
        QuestionController::saveQuestions($request);
       $QuizCount= Quiz::query()->select('id')
            ->where('courseID','=',$courseID)
            ->count();
        $studentIDs=StudentCourses::query()->select('student_id')
            ->where('course_id','=',$courseID)
            ->count();
        $gradesData=Grade::query()->select('student_id','grade')
            ->where('course_id','=',$courseID)
            ->count();
        if($studentIDs > 10 and $gradesData !=0) {
            if ($QuizCount ==6) {
                (KmeansController::kMeansquiz($courseID));
            }
        }


        return redirect()->route('showQuizes',['courseID'=> $courseID]);
    }

    public function saveQuiz($courseID,$topic,$totalGrade){
        $date=date('Y-m-d H:i:s');
        $quizID= Quiz::insertGetId([
            'courseID' => $courseID,
            'topic' => $topic,
            'total_grade' => $totalGrade,
            'date'=>$date
        ]);
        return $quizID;
    }

    public static function quizCorrection(Request $request){

        $questionIDS=$request->questionIDList;
        $answers=$request->answersList;
        //return $request->quizID;
        $grade=0;
        for($i=0;$i<count($questionIDS);$i++)
        {
            $grade += self::checkAnswer($request->quizID,$answers[$i],$questionIDS[$i]);
        }
        if(Grade::create(['student_id'=>$request->studentID,'quiz_id'=>$request->quizID,'course_id'=>$request->courseID,
            'grade'=>$grade]))
        {
            return json_encode('Done');
        }
        else{
            json_encode('Error');
        }
    }

    public static function checkAnswer($quizID,$indicator,$questionID){
        $questionGrade = Question::query()
            ->select('grade')
            ->where('id', '=', $questionID)
            ->where('quiz_id','=',$quizID)
            ->where('indicator','=',$indicator)
            ->get();
        return $questionGrade->grade;
    }

    public static function getQuizzesGrades(Request $request)
    {
        return json_encode(Grade::query()->join('quiz','quiz.id','=','grades.quiz_id')
            ->where('grades.student_id','=',$request->studentID)
            ->where('grades.course_id','=',$request->courseID)
            ->select('grades.grade','quiz.topic')
            ->get());
    }
    /*Delete quiz*/
    /*public function deleteQuiz(Request $request){
        $result=Quiz::query()
            ->where('courseID','=',$request->courseID)
            ->where('id','=',$request->ID)
            ->delete();
        if($result){
            return 'Quiz deleted successfully';
        }
        return 'Error ,quiz not deleted';
    }*/
    public static function getTopicsOfQuizzes(Request $request)
    {
        $result=Quiz::query()
            ->select('id','topic','date')
            ->where('courseID','=',$request->courseID)
            ->get();
        return json_encode($result);
    }

    public static function getQuestionsandAnswersOfQuiz(Request $request)
    {
        //this array have arrays each one has question with its answers
        $allQuestionsWithThieranswers=array();
        //count number of questions in quiz
        $countOFQuestions=1;
        $questions=QuestionController::getQuestions($request->quizID);
        foreach ($questions as $question)
        {
            $countOFAnswers=1;
            $questionWithAnswers=array();
            $questionWithAnswers['content']=$question->content;
            $questionWithAnswers['id']=$question->id;
            $answers=ChoiceController::getChoices($question->id);
            foreach ($answers as $answer) {
                $questionWithAnswers['answer'.$countOFAnswers++]=$answer->content;
            }
            $allQuestionsWithThieranswers['question'.$countOFQuestions++]=$questionWithAnswers;

        }
        if($request->wantsJson())
        {
            return json_encode($allQuestionsWithThieranswers);
        }
        return $allQuestionsWithThieranswers;

    }
    //mohammed part
    public function showQuizes($courseID){

        $quizes = Quiz::query()
            ->where('courseID' , '=' , "{$courseID}")
            ->get();



        return view('staff/quizzes',[ 'quizes' =>$quizes]);
    }

    public function publishQuiz(Request $request){
        Quiz::where('id',$request->quizID)
            ->update(['status' => 1]);

        return redirect()->route('showQuizes',['courseID' => $request->courseID]);
    }

    public function showQuiz($quizID){
        $questions = Question::query()
            ->where('quiz_id', '=', "{$quizID}")
            ->get();
        $allQuestions = [];
        $i = 0;
        foreach ($questions as $question) {
            $questionWithAnswer = [];
            $options = Choice::query()
                ->where('question_id', '=', "{$question->id}")
                ->get();
            $questionWithAnswer['question'] =$question->content;
            $questionWithAnswer['questionid'] =$question->id;
            $questionWithAnswer['correctAnswer'] =$question->answer;
            $questionWithAnswer['correctAnswerID'] =$question->answer_id;
            $questionWithAnswer['questionGrade'] = $question->grade;
            $j = 1;
            foreach ($options as $option){
                $questionWithAnswer['option'.$j] = $option->content;
                $questionWithAnswer['optionindicator'.$j] = $option->indicator;
                $questionWithAnswer['optionid'.$j++] = $option->id;
            }
            $questionWithAnswer['optionsCount'] = $j-1;
            $allQuestions[$i++] = $questionWithAnswer;
        }
//        return $allQuestions;
        return view("staff/editQuiz",['questions'=>$allQuestions, 'quizID'=>$quizID]);
    }

    public static function getQuizzesOfCourse($courseID){
        return Quiz::query()
            ->select('id','topic')
            ->where('courseID','=',$courseID)
            ->get();
    }

    public static function getAvgGradeForQuiz($quizzes){
        $allQuizzesWithAvgGrad = [];
        foreach ($quizzes as $quiz){
            $quizAvgGrade = Grade::query()
                ->where('quiz_id','=',$quiz->id)
                ->average('grade');
            array_push($allQuizzesWithAvgGrad,$quiz->topic,$quizAvgGrade);
        }
        return $allQuizzesWithAvgGrad;
    }


}
