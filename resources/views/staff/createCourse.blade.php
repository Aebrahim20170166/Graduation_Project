<?php
session_start();
if(session()->has('id'))
{
    $instr_id=session()->get('id');
}
?>
@extends('layouts.sidebar')
@section('content')
<style>

        /*---------- DIV 2 ----------*/
        form
        {
            margin: 10% 10%;

        }
        #CreateCourse div.d2 p
        {
            color: #535565;
            font-size: 40px;
            margin-left: 15%;
            font-family: "Playfair Display", serif;
            font-weight: 700;
            font-style: italic;
            transition: 0.5s;
        }
        #CreateCourse div.d2 p:hover
        {

            font-size: 50px;
            margin-left: 15%;
        }
        #CreateCourse div.d2 span
        {
            color:#FFB03B;
        }
        #CreateCourse div.d2 input
        {
            padding: 10px;
            width: 30%;
            height: 50px;
            border-color: black;
            border-radius: 15px;
            text-align: center;
            font-size: 30px;
            margin-left:  35%;
        }

        #CreateCourse div.d2 input.btn1
        {
            margin-top: 3%;
            background-color: #F4F4F6;
            transition: 0.5s;
            color: #535565;
            border:1px solid #FFB03B;

            font-size: 25px;
        }
        #CreateCourse div.d2 input.btn1:hover
        {
            background-color: #F4F4F6;

            color:  #FFB03B;
            font-size: 25px;
            border:1px solid #535565;
        }
        @media (max-width: 768px) {
            #CreateCourse div.d2 p
            {
                font-size: 30px;
            }
            #CreateCourse div.d2 p:hover
            {
                font-size: 40px;
            }
            #CreateCourse div.d2 input.btn1
            {

                width: 25%;
                height: 40px;
                font-size: 18px;

            }
            #CreateCourse div.d2 input
            {
                padding: 2px;
                width: 50%;
                height: 40px;
                border-color: black;
                border-radius: 15px;
                text-align: center;
                font-size: 30px;
                margin-left:  30%;
            }
            form
            {
                margin: 15% 18%;

            }
        }

    </style>

<body id="CreateCourse">
<
<div class="d2 container">
    <div class="row ">
        <form action="{{route('addCourse')}}" method="post">
            {{@csrf_field()}}
            @if(isset($success))
                <div class="alert alert-success row text-center" role="alert" >
                    {{$success}}
                </div>
            @endif

            <p> Course <span> Name </span> </p>
            <input type="hidden" name="ID" value='{{$instr_id}}'>

            <input type="text" name="name"  id="CourseName">

            <br><br>
            <p> Course <span> Code </span> </p>
            <input type="text" name="courseID"  id="CourseCode">

            <br><br><br>

            <input  class="btn1" type="submit" value="Create">
        </form>


    </div>

</div>


