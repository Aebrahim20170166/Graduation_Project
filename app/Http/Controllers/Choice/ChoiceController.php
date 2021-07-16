<?php

namespace App\Http\Controllers\Choice;

use App\Http\Controllers\Controller;
use App\Models\Choice;
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
    public static function saveChoice($questionID,$choice){
        Choice::create([
            'content' => $choice,
            'question_id' =>$questionID
        ]);
    }

    public function removeChoice(Request $request)
    {
        //        return $request->id;
     Choice::where('id','=',"{$request->id}")
            ->delete();
    }

    public function addChoice(Request $request){
        $questionID = $request->id;
        self::saveChoice($questionID,"");
    }
}
