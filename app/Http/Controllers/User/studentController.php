<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Traits\requestTrait;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class studentController extends Controller
{
    //sign up finction
    public static function sign_up(Request $request)
    {
        if(self::validate_data_of_signup($request))
        {
            $result = self::search($request);
            if ($result->isEmpty()){
                if(self::store($request))
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
        else{
            $error = 'There is messing data or invalid data';
            return requestTrait::handleRegistrationFailure($request,$error);
        }

    }
    //login function
    public static function login(Request $request)
    {
        if(self::validate_data_of_login($request))
        {
            $result = self::validate_data_inDB($request);
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
        $error="There is messing data or invalid data";
        return requestTrait::handleRegistrationFailure($request,$error);

    }
    public static function search(Request $request){
        return Student::query()
            ->where('student_id', '=', $request->id)
            ->orWhere('email', '=', $request->email)
            ->get();
    }

    public static function store(Request $request){
        if(Student::create([
            'student_id'=>$request->id,
            'Fname'=>$request->first_name,
            'Lname'=>$request->last_name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]))
        {
            return true;
        }
        return false;

    }
    public static function validate_data_inDB(Request $request){
        return Student::query()
            ->where('student_id', '=', $request->id)
            ->where('password', '=', $request->password)
            ->get();
    }
    public static function validate_data_of_login(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'id'=>'required|numeric|min:6',
            'password'=>'required|alphaNum|min:8'
        ]);
        if($validator->fails())
            return false;
        return true;
    }
    public static function validate_data_of_signup(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'first_name'=>'regex:/(^[A-Za-z ]+$)+/|required',
            'last_name'=>'regex:/(^[A-Za-z ]+$)+/|required',
            'email'=>'required|email',
            'id'=>'required|min:6|numeric|unique:students,student_id',
            'password'=>'required|alphaNum|min:8'

        ]);
        if($validator->fails())
            return false;
        return true;
    }
}
