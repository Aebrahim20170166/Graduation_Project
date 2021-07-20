<?php

namespace App\Http\Controllers\User;
session_start();

use App\Http\Controllers\Traits\requestTrait;
use App\Models\Teach;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Teach\TeachController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
class userRegisteration extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function signUp(Request $request){

        if($request->role === "instructor"){

            $result = InstructorController::search($request);
            if ($result->isEmpty()){
                $id= InstructorController::store($request);
                if($id>0)
                {
                    $request->session()->put('id',$request->$id);
                    $message='success';
                    return requestTrait::handleRegistrationSuccess($request,$message);
                }
                $message='Connection error';
                return requestTrait::handleRegistrationFailure($request,$message);

            }
            else {
                $error = 'user already exist';
                return requestTrait::handleRegistrationFailure($request,$error);
            }
        }
        else{
            $result = studentController::search($request);
            if ($result->isEmpty()){
                if(studentController::store($request))
                {
                    $message='success';
                    return requestTrait::handleRegistrationSuccess($request,$message);
                }
                $message='Connection error';
                return requestTrait::handleRegistrationFailure($request,$message);
            }
            else {
                $error = 'user allready exist';
                return requestTrait::handleRegistrationFailure($request,$error);
            }
        }
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function login(Request $request){
        //return $request;
        if($request->role == "instructor") {
            $result = InstructorController::validate_data($request);
            //return $result;
            if(is_null($result)){

                $error = 'id or password are wrong';
                return requestTrait::handleRegistrationFailure($request,$error);
            }
            else {

                if(Hash::check($request->password,$result->password))
                {

                    $request->session()->put('id',$result->id);
                    $message='success';
                    //return $result->password;
                    return requestTrait::handleRegistrationSuccess($request,$message);
                }
                $error = 'id or password are wrong';
                return requestTrait::handleRegistrationFailure($request,$error);

            }
        }
        else{
            $result = studentController::validate($request);
            if ($result->isEmpty()){
                $error = 'id or password are wrong';
                return requestTrait::handleRegistrationFailure($request,$error);
            }
            else {
                if(Hash::check($request->password, $result->password))
                {
                    $message='success';
                    return requestTrait::handleRegistrationSuccess($request,$message);
                }
                $error = 'id or password are wrong';
                return requestTrait::handleRegistrationFailure($request,$error);
            }
        }
    }
}
