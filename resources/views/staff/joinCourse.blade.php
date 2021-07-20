<?php
if(session()->has('id'))
    {
        /** @var TYPE_NAME $instructorID */
        $instructorID=session()->get('id');
    }
?>
    <!DOCTYPE html>
<html>
<head>
    <title> Join Course</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link  href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700,700i" rel="stylesheet">
    <style type="text/css">
        #JoinCourse
        {
            background-color: #F4F4F6;
        }
        /*---------- NavBar ----------*/
        div.d1
        {
            width: 100%;
            background: rgba(26, 24, 22, 0.6);

            height: 70px;
        }
        div.d1 ul
        {
            margin-left: 100px;
        }
        div.d1 li {

            position: relative;
            white-space: nowrap;
            padding: 10px 0 10px 24px;

        }
        div.d1 li.LogOut
        {
            margin-left: 250px;
        }
        div.d1 li a {


            text-align: center;
            padding: 14px 16px;
            text-decoration: none;

            position: relative;
            color: #ffffff;
            transition:  transform 1s;
            font-size: 15px;
            font-family: "Poppins", sans-serif;
            font-weight: 400;
        }

        div.d1 li a:hover:not(.active) {
            color: #FFB03B;
            border-radius: 50px;
            background:  rgba(26, 24, 22, 0.2);
            border: 1.5px solid #FFB03B;

        }

        div.d1 .active {
            color: #FFB03B;
            font-weight: 900;

        }
        div.d1 .active:hover
        {
            background:  rgba(26, 24, 22, 0.2);
            border-radius: 50px;
            border: 1.5px solid #FFB03B;
        }

        div.d1 h2 a
        {
            color: #FFB03B;
            font-family: "Playfair Display", serif;
            font-weight: 700;
            font-style: italic;
            margin-left: 80px;
            font-size: 45px;

        }
        div.d1 h2 a:hover
        {
            text-decoration: none;
            color: #FFB03B;
        }

        @media (min-width: 1024px) {
            #HomePage {
                background-attachment: fixed;
            }
        }

        @media (max-width: 768px) {
            #HomePage {
                height: 80vh;
            }
            #HomePage h1 {
                font-size: 25px;
                line-height: 36px;
            }
            div.d1
            {

                height: 50px;
            }
            div.d1 h2 a
            {
                font-size: 25px;

            }
        }
        /*---------- DIV 2 ----------*/
        #JoinCourse div.d2
        {
            margin-top: 8%;
        }
        #JoinCourse div.d2 p
        {
            color: #535565;
            font-size: 40px;
            margin-left: 15%;
            font-family: "Playfair Display", serif;
            font-weight: 700;
            font-style: italic;
            transition: 0.5s;
        }
        #JoinCourse div.d2 p:hover
        {

            font-size: 50px;
            margin-left: 15%;
        }
        #JoinCourse div.d2 span
        {
            color:#FFB03B;
        }
        #JoinCourse div.d2 input
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

        #JoinCourse div.d2 input.btn1
        {
            margin-left:  43%;
            width: 15%;
            color: #FFB03B;
            border-radius: 50px;
            border-color: #535565;
            font-size: 23px;
            background-color: #535565;
        }
        #JoinCourse div.d2 input.btn1:hover
        {
            background-color:#FFB03B;
            border-color: #FFB03B;
            color: #535565;
        }
        @media (max-width: 768px) {

            div.d1
            {

                height: 50px;
            }
            div.d1 h2 a
            {
                font-size: 25px;

            }
            #JoinCourse div.d2 input.btn1
            {

                width: 25%;
                height: 40px;
                font-size: 18px;

            }
            #JoinCourse div.d2 input
            {
                padding: 2px;
                width: 60%;
                height: 50px;
                border-color: black;
                border-radius: 15px;
                text-align: center;
                font-size: 30px;
                margin-left:  25%;
            }
        }

    </style>
</head>

<body id="JoinCourse">
<div class="d1">
    <nav class="navbar navbar-expand-lg bg-secondary navbar-fixed-top" id="mainNav">
        <div class="container-fluid">
            <div class="navbar-header">

                <h2 class="logo mr-auto "><a href="#">Eduance</a></h2>

            </div>

            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a class="active" href="{{route('joinCourse')}}">Join Course</a></li>
                    <li><a href="{{route('create_course')}}">Create Course</a></li>
                    <li class="LogOut"><a href="{{route('logout')}}">Log out</a></li>
                </ul>

            </div>
        </div>
    </nav>
</div>

<div class="d2 container">
    <div class="row ">
        <form action="{{route('joinCourse')}}" method="post">
            {{@csrf_field()}}
            @if(isset($success))
                <div class="alert alert-success row text-center" role="alert" >
                    {{$success}}
                </div>
            @endif
            <p> Course<span> Code </span> </p>
            <input type="text" name="courseID" id="CourseCode">
            <br><br><br>
            <input type="hidden" name="ID" value="{{$instructorID}}">
            <input type="hidden" name="role" value="instructor">
            <input  class="btn1" type="submit" value="Join">
        </form>


    </div>

</div>

</body>
</html>
