<?php

/*
 * Author : Alaa Ibrahim
 * */
namespace App\Http\Controllers\Quiz;
session_start();

use App\Http\Controllers\Choice\ChoiceController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Question\QuestionController;
use App\Http\Controllers\Traits\requestTrait;
use App\Models\Choice;
use App\Models\Grade;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /*Create new quiz*/
    public function createQuiz(Request $request){
        $courseID = $request->courseID;
        $topic = $request->quizTopic;
        $quizID = $this->saveQuiz($courseID,$topic);
        $request->merge(['quizID'=> $quizID]);
        QuestionController::saveQuestions($request);
    }

    public function saveQuiz($courseID,$topic){
        $date=date('Y-m-d H:i:s');
        $quizID= Quiz::insertGetId([
            'courseID' => $courseID,
            'topic' => $topic,
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
            $grade+=self::checkAnswer($request->quizID,$answers[$i],$questionIDS[$i]);
        }
        if(Grade::create(['student_id'=>$request->studentID,'quiz_id'=>$request->quizID,'course_id'=>$request->courseID,
            'grade'=>$grade]))
        {
            return json_encode('Done');
        }
        else{
            json_encode('Error');
        }
//      $str = '[{"question_id":"q1.question1","answer_id":"q1.question1.o3"},{"question_id":"q1.question2","answer_id":"q1.question2.o1"}]';
        /*$str = $request->str;
        $questions = json_decode($str,false);
        $grade = 0;
        foreach ($questions as $question){
            $grade += $this->checkAnswer($question);
        }
        grade::create([
            'course_id' => $request->course_id,
            'quiz_id' => $request->quiz_id,
            'student_id' => $request->student_id,
            'grade' => $grade
        ]);

        return json_encode($grade);*/
    }

    public static function checkAnswer($quizID,$answer,$questionID){
        return Question::query()
            ->where('id', '=', $questionID)
            ->where('quiz_id','=',$quizID)
            ->where('answer','=',$answer)
            ->count();



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
            $j = 1;
            foreach ($options as $option){
                $questionWithAnswer['option'.$j] = $option->content;
                $questionWithAnswer['optionid'.$j++] = $option->id;
            }
            $questionWithAnswer['optionsCount'] = $j-1;
            $allQuestions[$i++] = $questionWithAnswer;
        }
//        return $allQuestions;
        return view("staff/editQuiz",['questions'=>$allQuestions, 'quizID'=>$quizID]);
    }
}
