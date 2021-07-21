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
</head>
<body>

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
    <h3>Min: </h3> <h3 id="min"></h3>
    <h3>Max: </h3> <h3 id="max"></h3>
    <h3>Avg: </h3> <h3 id="avg"></h3>
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
