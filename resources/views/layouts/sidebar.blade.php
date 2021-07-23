<?php
$courseID;
if(session()->has('courseID'))
{
    $courseID=session()->get('courseID');
}
?>
<html>
<head>
    <title> {{$courseID}} Content</title>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link  href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700,700i" rel="stylesheet">

    <style type="text/css">
        #CourseContent
        {
            background-color: #F4F4F6;
        }
        /*---------- NavBar ----------*/
        .sidebar
        {
            position: fixed;
            left: 0px;
            width: 250px;
            height: 100%;
            background-color: #222222;
            top:0px;
        }
        .sidebar header
        {
            color: #FFB03B;
            font-family: "Playfair Display", serif;
            font-weight: 700;
            font-style: italic;
            text-align: center;
            font-size: 45px;
            line-height: 80px;

        }
        .sidebar ul
        {
            list-style: none;
        }
        .sidebar li a
        {
            text-align: center;
            padding: 14px 15px;
            text-decoration: none;
            line-height: 50px;
            position: relative;
            color: #ADADAD;
            transition:  transform 1s;
            font-size: 15px;
            font-family: "Poppins", sans-serif;
            font-weight: 400;

        }

        .sidebar ul.dropdown-menu li
        {
            background-color:  #222222;

        }
        .sidebar li a:hover:not(.active)
        {
            color: #FFB03B;
            border-radius: 50px;
            background:  rgba(26, 24, 22, 0.2);
            border: 1.5px solid #FFB03B;

        }

        .sidebar .active
        {
            color: #FFB03B;
            font-weight: 900;

        }
        .sidebar .active:hover
        {
            border-radius: 50px;
            border: 1.5px solid #FFB03B;
        }
        .sidebar li.CourseName a
        {
            font-size: 30px;
            color: #ffffff;
        }
        .sidebar li.CourseName a span
        {

            color:  #FFB03B;
        }
        @media (max-width: 768px) {

            div.d1
            {

                width: 30vh;
            }
            div.d1 li a
            {
                font-size: 12px;
                line-height: 50px;
                padding-left: 15px;

            }
            .sidebar li.CourseName a
            {
                font-size: 20px;

            }
            .sidebar header
            {
                font-size: 35px;
            }

        }
        /*---------- DIV 2 ----------*/


        /*-------------- DROPDOUN ---------------*/


    </style>
</head>

<body id="CourseContent">
<div class="d1 sidebar">

    <header><a href="{{route('home')}}"> Eduance </a></header>


    <ul >
        <li><a class="active" href="/courseView/{{$courseID}}">Sessions</a></li>
        <li><a href="{{route('showQuizes',['courseID' => $courseID])}}"> <span class="glyphicon glyphicon-check"></span> Quizzes</a></li>
        <li><a href="{{route('getpost',['courseID' => $courseID])}}"> <span class="glyphicon glyphicon-bullhorn"></span> Announcements</a></li>
        <li class="dropdown"><a href="#" class=" dropdown-toggle" data-toggle="dropdown">  Quiz Analysis <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="{{route('quizreport',['courseID' => $courseID])}}"> Report </a></li>
                <li><a href="{{route('quizChart',['courseID' => $courseID])}}"> Chart </a></li>
            </ul>
        </li>
        <div >
            <li class="dropdown"><a href="#" class=" dropdown-toggle" data-toggle="dropdown"> Attendance Analysis <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{route('attendancereport',['courseID' => $courseID])}}"> Report </a></li>
                    <li><a href="{{route('attendanceChart',['courseID' => $courseID])}}"> Chart  </a></li>
                </ul>
            </li>
            <li><a href="{{route('join_course')}}">Join Course</a></li>
            <li><a href="{{route('create_course')}}">Create Course</a></li>
            <li><a href="{{route('logout')}}">Log Out</a></li>


        </div>
    </ul>
</div>
@yield('content')

</body>

</html>
