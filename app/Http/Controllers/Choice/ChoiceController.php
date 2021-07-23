<?php

namespace App\Http\Controllers\Choice;

use App\Http\Controllers\Controller;
use App\Models\Choice;
use App\Models\Question;
use Illuminate\Http\Request;

class ChoiceController extends Controller
{
    /*
     * this function take the question id and return the answers of this question*/
    public static function getChoices($questionID)
    {
       return Choice::query()->select('content')
           ->where('question_id','=',$questionID)
           ->get();
    }
    public static function saveChoice($questionID,$choice,$indicator){
        choice::create([
            'question_id' =>$questionID,
            'content' => $choice,
            'indicator' => $indicator
        ]);
    }

    public function removeChoice(Request $request)
    {

//                return $request;
     Choice::query()
         ->select('indicator')
         ->where('id','=',"{$request->choiceID}")
         ->delete();

     self::updateChoicesIndecators($request);

     if ($request->isCorrectAnswerChange=="true") {
         $list = ['a','b','c','d','e','f'];
         $correctAnswerIndicator = Question::query()
             ->where('id', '=', "{$request->questionID}")
             ->get();

         $key = array_search($correctAnswerIndicator[0]->answer_id, $list);

         // update correct answer indicator
         foreach ($correctAnswerIndicator as $i){
             $i->answer_id = $list[--$key];
             $i->update();
         }
         return $list[$key];
     }

    }

    public function updateChoicesIndecators(Request $request){
        $list = ['a','b','c','d','e','f'];
        $choices = Choice::query()
            ->where('question_id','=',$request->questionID)
            ->get();
        $i = 0;
        foreach($choices as $choice){
            $choice -> indicator = $list[$i];
            $choice->update();
            $i++;
        }

    }

    public function addChoice(Request $request){
//        return $request;
        $list = ['a','b','c','d','e','f'];
        $questionID = $request->id;
        $indicator = $list[$request->answersCount];
        self::saveChoice($questionID,"",$indicator);
    }
}
