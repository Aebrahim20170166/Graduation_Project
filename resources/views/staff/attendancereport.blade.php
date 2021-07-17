
    <!DOCTYPE html>
<html>
<head>
</head>

<body>


        <div>
            <p>
                students attend the lectures frequently
            </p>

            @for($i=0;$i<sizeof($regularstudents['name']);$i++)
                <div class="row">

                    {{$regularstudents['name'][$i]}}
                    {{$regularstudents['id'][$i]}}
                    @endfor

                </div>
                <div class="row">

                    <a href="/courseView/{{$courseID}}"><button type="button" class="btn btn-defult btn-lg" >  got it  </button></a>
                </div>
        </div>
</body>

</html>
