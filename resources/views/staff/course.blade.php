<?php
session_start();
session(['courseID' => $courseID]);
?>
    <!DOCTYPE html>

<html>
<head>
    <title>Course Content</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
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
            padding: 14px 16px;
            text-decoration: none;
            line-height: 70px;
            position: relative;
            color: #ADADAD;
            transition:  transform 1s;
            font-size: 15px;
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            padding-left: 35px;
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
            font-size: 20px;
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
            div.d2 .btn1
            {
                margin: 1.5% 25%;
                font-size: 10px;

            }
        }
        /*---------- DIV 2 ----------*/

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
            background-color: #FFB03B;
            color: #ffffff;
        }
    </style>
</head>
<body id="CourseContent">
<div class="d1 sidebar">

    <a href="{{route('home')}}"><header> Eduance </header></a>


    <ul>
        <li class="CourseName"><a href="#">{{$courseName}}</a></li>
        <li><a class="active" href="CourseContent.html">Sessions</a></li>
        <li><a href="{{route('showQuizes',['courseID' => $courseID])}}"> <span class="glyphicon glyphicon-check"></span> Quizs</a></li>
        <li><a href="{{route('announcements')}}"> <span class="glyphicon glyphicon-bullhorn"></span> Announcements</a></li>
        <li><a href={{route('attendanceChart',['courseID' => $courseID])}}>Attendance Chart</a></li>
        <li><a href={{route('quizChart',['courseID' => $courseID])}}>quiz Chart</a></li>
        <li><a href="{{route('join_course')}}">Join Course</a></li>
        <li><a href="{{route('create_course')}}">Create Course</a></li>
        <li><a href="#">Profile</a></li>
        <li><a href="#">Log Out</a></li>
    </ul>


</div>
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
                            <input type="hidden" name="courseID" value="{{$session->course_id}}">
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
</body>
</html>

{{--

<html>
<head>

    <title>QR Code Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
        h1
        {
            font-size: 50px;
            font-family: fantasy;
            color: #3DB2EB;
        }
        button:hover
        {
            background-color: #3DB2EB;
        }
        div.container-fluid
        {
            background-color: #dddd;
        }
        li a
        {
            display: block;
            color: black;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        div#myNavbar
        {
            background-color: #ddd;
        }
        button.btn
        {
            width: 350px;
            height: 50px;
            margin: 20px;
            background-color: #ffffff;
            border:2px solid #3DB2EB;
            color: #3DB2EB;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="navbar-header">

        <a class="navbar-brand" href="#">Class-Management</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
            <li><a href="{{route('home')}}">Home</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="{{route('logout')}}">Log out</a></li>
        </ul>

    </div>
</div>

<div class="container text-center">
    <div class="row">
        <h1>{{$courseID}}</h1>
    </div>


    <div class="row">
        {{--<a href={{route('sessions')}}><button type="submit" class="btn btn-defult btn-lg" formtarget="_blank">Sessions</button>
        </a>--}}

{{--
        <form action="{{route('get_sessions')}}" method="post">
            {{@csrf_field()}}
            <input type="hidden" name='courseID' value={{$courseID}}> <br>
            <button type="submit" class="btn btn-defult btn-lg" >Sessions</button>

        </form>

    </div>
    <div class="row">

        <a href={{route('showQuizes',['courseID' => $courseID])}}><button type="submit" class="btn btn-defult btn-lg" >
                <span class="glyphicon glyphicon-check"></span>Quizzes</button></a>
    </div>
    <div class="row">

        <a href={{route('announcements',['courseID' => $courseID])}}><button type="button" class="btn btn-defult btn-lg" > <span class="glyphicon glyphicon-bullhorn"></span>  Make an announcement</button></a>
    </div>
    <div class="row">

        <a href={{route('attendancereport',['courseID' => $courseID])}}><button type="button" class="btn btn-defult btn-lg" >   get attendance report </button></a>
    </div>
    <div class="row">

        <a href={{route('quizreport',['courseID' => $courseID])}}><button type="button" class="btn btn-defult btn-lg" >   get quizs report </button></a>
    </div>
    <div class="row">

        <a href={{route('makechart',['courseID' => $courseID])}}><button type="button" class="btn btn-defult btn-lg" >   make chart </button></a>
    </div>
    <div class="row">

        <a href={{route('attendanceChart',['courseID' => $courseID])}}><button type="submit" class="btn btn-defult btn-lg" >
                <span class="glyphicon glyphicon-check"></span>attendance chart</button></a>
    </div>
    <div class="row">

        <a href={{route('quizChart',['courseID' => $courseID])}}><button type="button" class="btn btn-defult btn-lg" >   quiz chart </button></a>
    </div>
</div>

</body>
</html>


--}}
