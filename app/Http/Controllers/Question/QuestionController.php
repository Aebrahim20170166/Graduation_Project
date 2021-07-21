<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Choice\ChoiceController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\requestTrait;
use App\Models\Choice;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public static function saveQuestion($quizID,$questionID,$correctAnswer,$grade){
        $questionID = Question::insertGetId([
            'quiz_id' => $quizID,
            'content' => $questionID,
            'answer' => $correctAnswer,
            'grade' => $grade
        ]);
        return $questionID;

    }

    public static function saveQuestions(Request $request){
        $quizID = $request->quizID;
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
                    ChoiceController::saveChoice($questionID, $questionOptionContent);
                }
            }
        }
    }

    public function update(Request $request)
    {
//        return $request;

        $question= Question::findOrFail($request->id);
        $question-> content =$request['content'];
        $question-> answer =$request['correctAnswer'];
        $question->grade = $request['grade'];
        $question->save();

        Choice::where('question_id','=',"{$request->id}")
            ->delete();

        $newChoices = $request->choices;

        for($i=0; $i<sizeof($newChoices); $i++){
            self::saveChoice($request->id, $newChoices[$i]);
        }
        return $question-> answer;
    }

    public static function saveChoice($questionID,$choice){
        choice::create([
            'question_id' =>$questionID,
            'content' => $choice
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
