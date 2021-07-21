<?php
$courseID;
if(session()->has('courseID'))
{
    $courseID=session()->get('courseID');
}
?>
    <!DOCTYPE html>
<html>
<head>
    <title>Quizzes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link  href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700,700i" rel="stylesheet">
    <style type="text/css">
        body
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
        div.d2 .title h1
        {
            font-family: "Playfair Display", serif;
            font-weight: 700;
            color: #535565;
            font-style: italic;
            font-size: 50px;
            margin-top: 5%;
        }
        div.d2 .title span
        {
            color:#FFB03B;
        }
        div.d2 table
        {
            margin:40px 200px;
            width:70%
        }
        div.d2	th
        {
            font-size: 25px;
            text-align: center;
        }
        div.d2	td
        {
            font-size: 30px;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="d1 sidebar">

    <header> Eduance </header>


    <ul>
        <li class="CourseName"><a href="/courseView/{{$courseID}}"> {{$courseID}}</a></li>
        <li><a class="active" href="Quizs.html"> <span class="glyphicon glyphicon-check"></span> Quizzes</a></li>
        <li><a href={{route('createQuiz',['courseID' => $courseID])}}> Create Quiz</a></li>
        <li><a href="{{route('quizreport',['courseID' => $courseID])}}"> Quiz Report </a></li>
        <li><a href="{{route('quizChart',['courseID' => $courseID])}}"> Quiz Chart</a></li>
        <li><a href="{{route('logout')}}">Log Out</a></li>
    </ul>


</div>

<div class="container d2">
    <div>
        <div class=" title text-center">
            <h1> Your <span> Quizzes </span></h1>
        </div>
        <div class="Quizs text-center">
            <table>
                @foreach($quizes as $quiz)
                <tr>
                    <td><a href={{route('showQuiz',['quizID' => $quiz->id])}}>{{$quiz->topic}}</a></td>
                    <td>{{$quiz->date}}</td>

                </tr>

                @endforeach
            </table>
        </div>
    </div>
</div>
</body>
</html>
