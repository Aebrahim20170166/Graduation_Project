<!DOCTYPE html>
<html>
<head>
    <title>Attendance Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
        #Attendance
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
            div.d2 .btn1
            {
                margin: 1.5% 25%;
                font-size: 10px;

            }
        }
        /*---------- DIV 2 ----------*/

        #Attendance div.d2 .title h1
        {
            font-family: "Playfair Display", serif;
            font-weight: 700;
            color: #535565;
            font-style: italic;
            font-size: 50px;
            padding: 6% 10%;
        }
        #Attendance div.d2 span
        {
            color:#FFB03B;
        }

        #Attendance div.d2 table
        {
            margin-left: 180px;
            width:60%
        }
        #Attendance div.d2	th
        {
            font-size: 25px;
            text-align: center;
        }
        #Attendance div.d2	td
        {
            font-size: 20px;
            padding: 20px;
        }

    </style>
</head>
<body id="Attendance">
<div class="d1 sidebar">

    <header> Eduance </header>


    <ul>
        <li class="CourseName"><a href="#"></a></li>
        <li><a class="active" href="CourseContent.html">Sessions</a></li>
        <li><a href="Quizes.html"> <span class="glyphicon glyphicon-check"></span> Quizs</a></li>
        <li><a href="Announcements.html"> <span class="glyphicon glyphicon-bullhorn"></span> Announcements</a></li>
        <li><a href="">Attendance Chart</a></li>
        <li><a href="">quiz Chart</a></li>
        <li><a href="Join Course.html">Join Course</a></li>
        <li><a href="{{route('create_course')}}">Create Course</a></li>
        <li><a href="#">Profile</a></li>
        <li><a href="#">Log Out</a></li>
    </ul>


</div>
<div class="container d2 text-center">
    <div class=" title ">
        <h1>{{$sessionName}}</h1>
    </div>
    <div class="row text-center">
        <table >
            <tr >
                <th>Student <span> Name</span> </th>
                <th>Student <span> ID</span> </th>

            </tr>
            @foreach($attendances as $attendance)
                <tr>
                    <td>{{$attendance->student_id}}</td>
                    <td>{{$attendance->Fname." ".$attendance->Lname}}</td>
                </tr>
            @endforeach
        </table>

    </div>
</div>
</body>
</html>
