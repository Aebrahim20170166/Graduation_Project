<!doctype html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>chart</title>
    <link rel="stylesheet" href="{{url( '/css/app.css' )}}">
    <link rel="stylesheet" href="{{url( '/css/blog.css' )}}">

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
            div.d2 .btn1
            {
                margin: 1.5% 25%;
                font-size: 10px;

            }
        }
        /*---------- DIV 2 ----------*/

        div.d2 span.p
        {
            font-size: 20px;
            color: #535565;
            display: inline-block;
            margin-left: 20%;
            margin-top: 3%;
            font-family: "Playfair Display", serif;
            font-weight: 400;
            font-style: italic;
        }
        div.d2 p
        {
            margin-left: 2%;
            display: inline-block;
            font-size: 15px;
        }
        div.d2  .num
        {
            color: #FFB03B;
            font-size: 20px;
        }
        div.d2 span.sp
        {
            color: #535565;
            font-size: 20px;
        }
    </style>
</head>
<body>
<div class="d1 sidebar">

    <header> Eduance </header>


    <ul>
        <li class="CourseName"><a href="CourseContent.html">Course <span> 1 </span></a></li>
        <li><a href="Attendance.html"></span> Attendance</a></li>
        <li><a class="active" href="AttendanceChart.html"> Attendance Chart </a></li>
        <li><a href="QuizReport.html"> Reports </a></li>
        <li><a href="#">Profile</a></li>
        <li><a href="#">Log Out</a></li>
    </ul>


</div>


<br>
<div class="container">

    <!-- Area Chart Example-->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-area-chart"></i> Attendance Chart </div>
        <div class="card-body">
            <canvas id="myAreaChart" width="100%" height="30"></canvas>
        </div>
        <div class="card-footer small text-muted"></div>
    </div>

    <div class="d2  ">
        <div class="row">
            <span class="p">Minimum number of student attend </span><p> .................................................................................  </p>
            <span class="num" data-toggle="counter-up" id="min">40</span><span>Student</span>
        </div>
        <div class="row">
            <span class="p">Maximum number of student attend </span><p> .................................................................................  </p>
            <span class="num" data-toggle="counter-up" id="max">55</span> <span>Student</span>
        </div>
        <div class="row">
            <span class="p">Average number of student attend </span><p> .................................................................................  </p>
            <span class="num" data-toggle="counter-up" id="avg">49</span><span>Student</span>
        </div>
    </div>
</div>

<script src="{{url( 'vendor/jquery.min.js' )}}"></script>

<script src="{{url( 'vendor/Chart.min.js' )}}"></script>

<script>
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    document.onload= getDataForChart();

    function getDataForChart() {
        $.ajax({
            url: "{{route('getDataForAttChart')}}",
            type: 'GET',
            data:{
                courseID:'{{$courseID}}'
            },

            success:function(response){
                // console.log(response.sessionsTopics[0].session_topic)
                console.log(response[1]);

                let i = 0;
                var sessionsTopics = [];
                var attendanceCounts=[];
                for(;i<response.length;i++){
                    console.log("in");
                    sessionsTopics.push(response[i]);

                    attendanceCounts.push(response[++i]);

                }
                console.log(sessionsTopics);
                console.log(attendanceCounts);
                document.getElementById('min').innerHTML = Math.min.apply(null, attendanceCounts);
                document.getElementById('max').innerHTML = Math.max.apply(null, attendanceCounts);
                var avg = attendanceCounts.reduce((acc,v) => acc + v) / attendanceCounts.length;
                document.getElementById('avg').innerHTML = Math.round(avg);
                showChart(sessionsTopics,attendanceCounts);

            },
        });
    }
    function showChart(sessionsTopics,attendanceCount){
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: sessionsTopics, // ['jan','feb','apr'] The response got from the ajax request containing all month names in the database
                datasets: [{
                    label: "Sessions",
                    lineTension: 0.3,
                    backgroundColor: "rgba(2,117,216,0.2)",
                    borderColor: "rgba(2,117,216,1)",
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(2,117,216,1)",
                    pointBorderColor: "rgba(255,255,255,0.8)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(2,117,216,1)",
                    pointHitRadius: 20,
                    pointBorderWidth: 2,
                    data: attendanceCount, // The response got from the ajax request containing data for the completed jobs in the corresponding months
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        time: {
                            unit: ''
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 100, // The response got from the ajax request containing max limit for y axis
                            maxTicksLimit: 10
                        },
                        gridLines: {
                            color: "rgba(0, 0, 0, .125)",
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        });

    }
    document.onload = getDataForChart();
</script>
<script src="{{ url( '/js/app.js' ) }}"></script>
</body>
</html>
