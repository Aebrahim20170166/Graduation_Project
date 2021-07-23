<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Choice\ChoiceController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\requestTrait;
use App\Models\Choice;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public static function saveQuestion($quizID,$questionID,$correctAnswer,$grade){
        $questionID = Question::insertGetId([
            'quiz_id' => $quizID,
            'content' => $questionID,
            'answer_id' => $correctAnswer,
            'grade' => $grade
        ]);
        return $questionID;

    }

    public static function saveQuestions(Request $request){
        $list = ['a','b','c','d','e','f'];
//        return $request;
        $quizID = $request->quizID;
         $courseID = $request->courseID;
        $questionsCount = $request->questionsCount; // number of questions in this request
        for($i=1; $i<=$questionsCount; $i++) {
            $correctAnswer = 'correctAnswer'.$i;

            $count = 'optionCount'.$i;
            $content = 'question'.$i;
            $questionOptions = $request->$count;
            $grade = 'questionGrade'.$i;

            if ($request->$content) {
                // save question and its correct answer
                $questionID = self::saveQuestion($quizID,$request->$content,$request->$correctAnswer,$request->$grade);
                // sava question and its options
                for ($j = 1; $j <= $questionOptions; $j++) {
                    $questionOption = 'question' . $i . 'option' . $j;
                    $questionOptionContent = $request->$questionOption;
                    $t = $j - 1;
                    ChoiceController::saveChoice($questionID, $questionOptionContent,$list[$t]);
                }
            }
        }
        self::updateQuizGrade($quizID);
        return redirect()->route('showQuizes',['courseID'=> $courseID]);
    }

    public function update(Request $request)
    {

//        return $request;
        $question= Question::findOrFail($request->id);
        $question-> content =$request['content'];
        $question-> answer_id = $request['correctAnswerIndicator'];
        $question->grade = $request['grade'];
        $question->save();


        Choice::where('question_id','=',"{$request->id}")
            ->delete();

        $newChoices = $request->choices;
        $list = ['a','b','c','d','e','f'];
//        return $request;
        for($i=0; $i<sizeof($newChoices); $i++){
            self::saveChoice($request->id, $newChoices[$i],$list[$i]);
        }
//        return $question-> answer;
    }

    public static function updateQuizGrade($quizID){
        $totalGrade = Question::query()
            ->where('quiz_id','=',$quizID)
            ->sum('grade');

        Quiz::where('id',$quizID)
            ->update(['total_grade' => $totalGrade]);

    }

    public static function saveChoice($questionID,$choice,$indicator){
        if ($choice == null)
            $choice = "";
        choice::create([
            'question_id' =>$questionID,
            'content' => $choice,
            'indicator' => $indicator
        ]);
    }

    public function destroy(Request $request){
//        return $request;
        Question::destroy($request->id);
        Choice::where('question_id','=',"{$request->id}")
            ->delete();
    }

   /*this function take the quiz id and return all question in this quiz*/
   public static function getQuestions($quizID){
       return Question::query()->select('content','quiz_id','id')
           ->where('quiz_id','=',$quizID)
           ->get();
   }
}
