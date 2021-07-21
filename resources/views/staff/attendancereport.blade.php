<!DOCTYPE html>
<html>
<head>
    <title>Attendance Report</title>
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
            div.d2 div.title h2
            {
                font-size: 20px;
                margin-left: 180px;
            }

        }
        /*---------- DIV 2 ----------*/

        div.d2 .title h2
        {
            font-family: "Playfair Display", serif;
            font-weight: 700;
            color: #535565;
            font-style: italic;
            font-size: 40px;
            margin: 5% 14%;
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
        div.d2    th
        {
            font-size: 25px;
            text-align: center;
        }
        div.d2    td
        {
            font-size: 20px;
            padding: 20px;
        }
        div.d2 .btn1
        {
            margin:2% 15%;
            font-size: 18px;
            background-color: #535565;
            transition: 0.5s;
        }
        div.d2 .btn1:hover
        {

            font-size: 25px;

        }
        button
        {
            background-color: #FFB03B;
            color: #ffffff;
        }
    </style>
</head>

<body>
<div class="d1 sidebar">

    <header> Eduance </header>


    <ul>
        <li class="CourseName"><a href="CourseContent.html">Course <span> 1 </span></a></li>
        <li><a href="Attendance.html"> Attendance</a></li>
        <li><a class="active" href="QuizReport.html"> Reports </a></li>
        <li><a href="#">Profile</a></li>
        <li><a href="#">Log Out</a></li>
    </ul>


</div>

<div class="d2 container">
    <div class=" title ">
        <h2> students attend the lectures <span> frequently </span></h2>
    </div>
    <div class=" text-center">
        <table>
            <tr>
                <th>Student <span> Name</span> </th>
                <th>Student <span> ID</span> </th>
            </tr>
        @for($i=0;$i<sizeof($regularstudents['name']);$i++)

                <tr>
                    <td>{{$regularstudents['name'][$i]}} </td>
                    <td>{{$regularstudents['id'][$i]}}</td>

                </tr>

            @endfor


            </table>
    </div>

    <div class="row">

        <a href="/courseView/{{$courseID}}"><button type="button" class="btn btn-defult btn-lg" >  got it  </button></a>
    </div>
</div>
</body>

</html>
