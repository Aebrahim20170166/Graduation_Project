<?php
session_start();
$instr_id;
$courseID;
if(session()->has('id') and session()->has('courseID'))
{
    $instr_id=session()->get('id');
    $courseID=session()->get('courseID');
}
?>
<style>
    @extends('layouts.sidebar')
@section('content')
        /*---------- DIV 2 ----------*/
        form
        {
            margin: 15% 10%;

        }
        div.d2 p
        {
            color: #535565;
            font-size: 40px;
            margin-left: 15%;
            font-family: "Playfair Display", serif;
            font-weight: 700;
            font-style: italic;
            transition: 0.5s;
            text-align: center;
        }

        div.d2 span
        {
            color:#FFB03B;
        }
        div.d2 input
        {
            width: 30%;
            height: 50px;
            border-color: black;
            border-radius: 15px;
            text-align: center;
            font-size: 30px;
            margin-left:42%;
            text-align: center;

        }

        div.d2 input.btn1
        {
            margin-top: 3%;
            background-color: #F4F4F6;
            transition: 0.5s;
            color: #535565;
            border:1px solid #FFB03B;

            font-size: 25px;

        }
        div.d2 input.btn1:hover
        { background-color: #F4F4F6;

            color:  #FFB03B;
            font-size: 25px;
            border:1px solid #535565;
        }
        @media (max-width: 768px) {

            div.d2 p
            {
                font-size: 30px;
            }
            div.d2 p:hover
            {
                font-size: 40px;
            }
            div.d2 input.btn1
            {

                width: 25%;
                height: 40px;
                font-size: 18px;

            }
            div.d2 input
            {
                padding: 2px;
                width: 50%;
                height: 40px;
                border-color: black;
                border-radius: 15px;
                text-align: center;
                font-size: 20px;
                margin-left:  30%;
            }
            form
            {
                margin: 15% 18%;

            }
        }
    </style>

<div class="d2 container">
    <div class="row ">
        <form action="{{route('create_session')}}" method="post">
            {{@csrf_field()}}
            <input type="hidden" name='courseID' value={{$courseID}}> <br>
            <input type="hidden" name='instructorID' value={{$instr_id}}> <br>
            @if(Session::has('error'))
                <div class="error" role="alert">
                    {{Session::get('error')}}
                </div>
            @endif
            <p> Session <span> Name </span> </p>
            <input type="text" name="SessionName" id="SessionName">
            <br><br><br>

            <input  class="btn1" type="submit" value="Create" >
        </form>


    </div>

</div>
