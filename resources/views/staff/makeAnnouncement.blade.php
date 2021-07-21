<?php
if(session()->has('courseID'))
{
    $courseID=session()->get('courseID');
}
?>
    <!DOCTYPE html>
<html>
<head>
    <title>Make Announcement </title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link  href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700,700i" rel="stylesheet">
    <style type="text/css">
        body
        {
            background-color: #F4F4F6;
        }
        /---------- NavBar ----------/
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
            padding: 14px 20px;
            text-decoration: none;
            line-height: 70px;
            position: relative;
            color: #ADADAD;
            transition:  transform 1s;
            font-size: 15px;
            font-family: "Poppins", sans-serif;
            font-weight: 400;


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

                width: 32vh;
            }
            div.d1 li a
            {
                font-size: 11px;
                line-height: 50px;
                padding-left: 0px;

            }
            .sidebar li.CourseName a
            {
                font-size: 20px;

            }
            .sidebar header
            {
                font-size: 35px;
            }
            div.d2 h1.h1
            {

                font-size: 40px;

            }
            div.d2 form span.Announcement
            {
                font-size: 20px;
            }
            div.d2 .text-center
            {
                margin-left: 25%;
            }
            div.d2 .butt button.button
            {
                margin:0.5% 33%;
                background-color: #FFB03B;
            }
        }
        /---------- DIV 2 ----------/
        div.d2 h1
        {
            margin-top: 5%;
            font-size: 60px;
            color: #FFB03B;
            font-family: "Playfair Display", serif;
            font-weight: 700;
            font-style: italic;
        }
        div.d2 span.Announcement
        {
            font-size: 30px;
            color: #535565;
            font-family: "Playfair Display", serif;
            font-weight: 400;
        }
        div.d2 input.s_name
        {
            width: 60%;
            height: 100px;
            background-color: #F4F4F6;
            border: 2px solid #535565;
            font-size: 20px;
        }
        div.d2 button.post
        {
            margin-top: 3%;
            background-color: #535565;
            transition: 0.5s;
            color:  #FFB03B;

        }
        div.d2 button.post:hover
        {
            background-color: #F4F4F6;
            color: #535565;
            border:1px solid #535565;
            width: 100px;
            height: 60px;
            font-size: 25px;

        }

        .butt{

            padding-left:  15%;

        }

        div.d2 button.btn1
        {

            color: #FFB03B;
            font-size: 20px;
        }
        div.d2 button.btn2
        {
            font-size: 20px;
            color: #FFB03B;
        }
    </style>
</head>
<body>

<div class="d1 sidebar">

    <header> Eduance </header>


    <ul>
        <li class="CourseName"><a href="CourseContent.html"> {{$courseID}} </a></li>
        <li><a class="active" href="Announcements.html"> <span class="glyphicon glyphicon-bullhorn"></span> Announcements</a></li>
        <li><a href="#">Profile</a></li>
        <li><a href="#">Log Out</a></li>
    </ul>


</div>

<div class="d2 container ">
    <div class="row text-center">
        <h1 class="h1">{{$courseID}}</h1>
    </div>



    <div class="row text-center">

        <form action="{{route('makepost')}}" method="post">
            @csrf

            <input type="hidden" name='courseID' value={{$courseID}}> <br>

            <span class="Announcement">Your Announcement</span>
            <br>
            <input class="s_name" type="text" name='announcement' > <br>
            <button type="submit" class="btn btn-defult btn-lg post" >post </button>
        </form>
    </div>

    <div class="butt">
        @foreach($Announcements as $announce)
            <div class="row">

                {{$announce->body}}
                <a href={{route('updatepost',['courseID' => $courseID,'postid'=>$announce->id,'body'=>$announce->body])}} >

                    <button type="button" class="btn button btn1" >  <span class=" glyphicon glyphicon-edit"></span></button></a>

                <a href={{route('deletepost',['courseID' => $courseID,'postid'=>$announce->id,'body'=>$announce->body])}} >
                    <button type="button" class="btn button btn2" >   <span class=" glyphicon glyphicon-trash"></span></button></a>

            </div>

        @endforeach

    </div>
</div>

</body>
</html>
