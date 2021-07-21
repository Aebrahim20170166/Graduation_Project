<?php
session_start();
if(session()->has('id'))
{
    $instr_id=session()->get('id');
}
?>
    <!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
    <title>
        Create New Course
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link  href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700,700i" rel="stylesheet">
    <style type="text/css">
        #CreateCourse
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
            margin-left:  43%;
            width: 15%;
            color: #FFB03B;
            border-radius: 50px;
            border-color: #535565;
            font-size: 23px;
            background-color: #535565;
        }
        #CreateCourse div.d2 input.btn1:hover
        {
            background-color:#FFB03B;
            border-color: #FFB03B;
            color: #535565;
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
</head>
<body id="CreateCourse">
<div class="d1 sidebar">

    <header> Eduance </header>


    <ul>
        <li class="CourseName"><a href="CourseContent.html">Course <span> 1 </span></a></li>
        <li><a href="CourseContent.html">Sessions</a></li>
        <li><a href="Quizes.html"> <span class="glyphicon glyphicon-check"></span> Quizs</a></li>
        <li><a href="Announcements.html"> <span class="glyphicon glyphicon-bullhorn"></span> Announcements</a></li>
        <li><a href="Join Course.html">Join Course</a></li>
        <li><a class="active" href="create new course.html">Create Course</a></li>
        <li><a href="#">Profile</a></li>
        <li><a href="#">Log Out</a></li>
    </ul>


</div>
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


</body>
</html>
