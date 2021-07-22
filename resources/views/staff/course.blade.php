<?php
session_start();
session(['courseID' => $courseID]);


?>
@extends('layouts.sidebar')
@section('content')
    <style>
        #CourseContent div.d2 .title h1
        {
            font-family: "Playfair Display", serif;
            font-weight: 700;
            color: #535565;
            font-style: italic;
            font-size: 50px;
            margin-top: 5%;
        }
        #CourseContent div.d2 .title span
        {
            color:#FFB03B;
        }

        #CourseContent div.d2 table
        {
            margin:40px 200px;
            width:70%
        }
        #CourseContent  div.d2	th
        {
            font-size: 25px;
            text-align: center;
        }
        #CourseContent  div.d2	td
        {
            font-size: 20px;
            padding: 20px;
            text-align: center;
        }
        #CourseContent  div.d2 .btn1
        {
            margin:2% 15%;
            font-size: 18px;
            background-color: #535565;
            transition: 0.5s;
        }
        #CourseContent  div.d2 .btn1:hover
        {

            font-size: 25px;

        }
        #CourseContent	button
        {
            background-color: #F4F4F6;
            transition: 0.5s;
            color:  #FFB03B;
            border:1px solid #535565;
        }
        #CourseContent	button:hover
        {
            background-color: #F4F4F6;
            color: #535565;
            border:1px solid #FFB03B;

        }
    </style>
    <div class="container d2 ">
        <div class="CreateSesstion">

            <button class="btn btn1" > <a href={{route('newSession')}}> Create New Session </a> </button>
        </div>
        <div class="text-center">
            <div class=" title ">
                <h1> Your <span> Sessions </span></h1>
            </div>
            <div class="row text-center">
                <table>
                    <tr>
                        <th>Session Name</th>
                        <th>Session Date</th>
                        <th>Session Attendance</th>
                    </tr>
                    @if(!is_null($sessions))
                        @foreach($sessions as $session)
                            <tr>
                                <td>{{$session->session_name}}</td>
                                <td>{{$session->date}}</td>
                                <td class="text-center ">
                                    <form action="{{route('getAttendance')}}">
                                        {{@csrf_field()}}
                                        <input type="hidden" name="sessionID" value="{{$session->session_id}}">
                                        <input type="hidden" name="courseID" value="{{$courseID}}">
                                        <input type="hidden" name="sessionName" value="{{$session->session_name}}">

                                        <button class="btn" type="submit"> Attendance </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </table>

            </div>
        </div>
    </div>
    @if($flag_quiz == 0)

        <form id="jsform" action="{{route('kMeansquiz')}}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="courseID" value={{$courseID}}>
        </form>
    @endif
    @if($flag_attend == 0)

        <form id="jsform" action="{{route('kMeansattendance')}}" method="get">
            <input type="hidden" name="courseID" value={{$courseID}}>
        </form>
    @endif

    @if($flag_naive == 0)

        <form id="jsform" action="{{route('naeve')}}" method="get">
            <input type="hidden" name="courseID" value={{$courseID}}>
        </form>
    @endif
    @if($flag_mail == 0)
        <form id="jsform" action="{{route('sendemail')}}" method="get">
            <input type="hidden" name="courseID" value={{$courseID}}>
        </form>
    @endif


    <script type="text/javascript">
        document.getElementById('jsform').submit();
    </script>



