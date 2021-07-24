<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Session\SessionController;
use App\Http\Controllers\Traits\requestTrait;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InstructorController extends Controller
{

    //sign up function
    public static function sign_up(Request $request)
    {
        $result = self::search($request);
        //return $result;
        if ($result->isEmpty()){
            $result= self::store($request);
            if(!is_null($result))
            {
                $request->session()->put('id',$result->id);
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
    //login function
    public static function login(Request $request)
    {
        $result =self::validate_data($request);
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
    //check if this account is exist or not
    public static function search(Request $request){
        return Instructor::query()
            ->where('email', '=', $request->email)
            ->get();
    }

    public static function validate_data(Request $request){
        /*return Instructor::where([['email','=',$request->email]])->first();*/
        return Instructor::query()->where('email','=',$request->email)
            ->first();
    }

    public static function store(Request $request){
        if($result=Instructor::create([
            'Fname'=>$request->first_name,
            'Lname'=>$request->last_name,
            'email'=>$request->email,
            'username'=>$request->username,
            'password'=>Hash::make($request->password)
        ]))
        {
            return $result;
        }
    }
}
