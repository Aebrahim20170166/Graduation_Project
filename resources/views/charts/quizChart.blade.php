@extends('layouts.sidebar')
@section('content')

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

</head>
<body>

<br>
<div class="container">

    <!-- Area Chart Example-->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-area-chart"></i> quiz Chart </div>
        <div class="card-body">
            <canvas id="myBarChart" width="100%" height="30"></canvas>
        </div>
        <div class="card-footer small text-muted"></div>
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

    function getDataForChart() {
        $.ajax({
            url: "{{route('getDataForQuizChart')}}",
            type: 'GET',
            data:{
                courseID:'{{$courseID}}'
            },

            success:function(response){
                // console.log(response.sessionsTopics[0].session_topic)
                console.log(response);


                var quizzesTopics = [];
                var quizzesAvgGrade=[];
                let i = 0;
                for(;i<response.length;i++){
                    console.log("in");
                    quizzesTopics.push(response[i]);
                    quizzesAvgGrade.push(response[++i]);
                }
                console.log(quizzesTopics);
                console.log(quizzesAvgGrade);
                showChart(quizzesTopics,quizzesAvgGrade);

            },
        });
    }


    function showChart(quizzesTopics,quizzesAvgGrade){
        // Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        // Chart.defaults.global.defaultFontColor = '#292b2c';
        var max = Math.max.apply(null, quizzesAvgGrade);
        var ctx = document.getElementById("myBarChart");
        var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels:  quizzesTopics,//["January", "February", "March", "April", "May", "June","January", "February", "March", "April", "May", "June"],
                datasets: [{
                    label: "Average",
                    backgroundColor: "rgba(2,117,216,1)",
                    borderColor: "rgba(2,117,216,1)",
                    data:  quizzesAvgGrade,//[4215, 5312, 6251, 7841, 9821, 14984,4215, 5312, 6251, 7841, 9821, 14984],
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'quiz'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 6
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: max,
                            maxTicksLimit: 5
                        },
                        gridLines: {
                            display: true
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

