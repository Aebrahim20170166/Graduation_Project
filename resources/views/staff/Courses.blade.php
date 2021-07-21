<?php
session_start();
if(session()->has('id'))
    {
        $instructorID=session()->get('id');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link  href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700,700i" rel="stylesheet">
    <style type="text/css">
        #HomePage
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
            margin-left: 400px;
        }
        div.d1 li {

            position: relative;
            white-space: nowrap;
            padding: 10px 0 10px 24px;

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


        #HomePage div.d2 button.btn
        {
            width: 350px;
            height: 50px;
            margin: 20px;
            background-color: #ffffff;
            border:2px solid  #FFB03B;
            color: #FFB03B;
            font-size: 20px;
            transition:  0.5s;

        }
        #HomePage div.d2 button.btn:hover
        {

            border-color: #535565;
            color: #535565;
        }
        #HomePage	div.d2
        {

            margin: 150px;
        }
        #HomePage div.d2 .title h1
        {
            font-family: "Playfair Display", serif;
            font-weight: 700;
            color: #535565;
            font-style: italic;
            font-size: 50px;
        }
        #HomePage div.d2 .title span
        {
            color:#FFB03B;
        }
        #HomePage 	span.gl
        {
            margin: 10px;
            font-size: 30px;
            color: #535565;
            transition: 0.5s;
        }
        #HomePage 	span.gl:hover
        {
            color: red;

        }


    </style>
</head>
<body id="HomePage">
<!-- Navbar-->
<div class="d1 navbar-fixed-top">
    <nav class="navbar navbar-expand-lg bg-secondary navbar-fixed-top" id="mainNav">
        <div class="container-fluid">
            <div class="navbar-header">

                <h2 class="logo mr-auto "><a href="#">Eduance</a></h2>

            </div>

            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a class="active" href="#section1">Home</a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href="{{route('join_course')}}">Join Course</a></li>
                    <li><a href="{{route('create_course')}}">Create Course</a></li>
                    <li><a href="#">Log Out</a></li>
                </ul>

            </div>
        </div>
    </nav>
</div>

@if(isset($success))
    <div class="alert alert-success row text-center" role="alert" >
        {{$success}}
    </div>
@endif

<div class="container">



    <div class="d2  text-center">
        <div class="title">
            <h1>Your <span> Courses </span> </h1>
        </div>

        @if(!is_null($courses))
            @foreach($courses as $course)
                <div class="row">
                    <div >
                        <a href="/courseView/{{$course->course_id}}">
                            <button type="button" class="btn btn-defult btn-lg" > {{$course->name}}  </button>
                        </a>
                    </div>

        {{-- <a href="#"><span class="gl glyphicon glyphicon-minus-sign"></span> </a>--}}
                    <div>
                        <form action="{{route('delete_instructor_course')}}" method="post">
                            {{@csrf_field()}}
                            <input type="hidden" name="courseID" value="{{$course->course_id}}">
                            <input type="hidden" name="instructorID" value="{{$instructorID}}">
                            <button type="submit"><span class="gl glyphicon glyphicon-minus-sign"></span></button>
                        </form>
                    </div>
                </div>

            @endforeach
        @endif
    </div>
{{--
        @if(!is_null($courses))
            @foreach($courses as $course)
                <div class="row">
                    <div class="col-sm-6 text-center">
                        <a class="btn btn-defult btn-lg" href="/courseView/{{$course->course_id}}">
                            {{$course->name}}  </a>
                    </div>
                    <div col sm-6>
                        <form action="{{route('delete_instructor_course')}}" method="post">
                            {{@csrf_field()}}
                            <input type="hidden" name="courseID" value="{{$course->course_id}}">
                            <input type="hidden" name="instructorID" value="{{$instructorID}}">
                            <button type="submit"><span class="gl glyphicon glyphicon-minus-sign"></span></button>
                        </form>
                    </div>

                </div>
            @endforeach
            <div class="row">
                <a href="{{route('create_course')}}"> <span class="gl1 glyphicon glyphicon-plus-sign"></span> </a>

            </div>
        @endif
        --}}

</div>
</body>
</html>

