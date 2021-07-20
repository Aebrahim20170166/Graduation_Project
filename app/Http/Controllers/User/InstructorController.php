<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Session\SessionController;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InstructorController extends UserController
{
    //check if this account is exist or not
    public static function search(Request $request){
        return Instructor::query()
            ->where('email', '=', $request->email)
            ->orWhere('password', '=', $request->password)
            ->get();
    }

    public static function validate_data(Request $request){
        return Instructor::where([['email','=',$request->email]])->first();
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
            return $result->id;
        }
    }
}
