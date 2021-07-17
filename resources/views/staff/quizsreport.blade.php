
    <!DOCTYPE html>
<html>
<head>
</head>

<body>


        <div>
            <p>
                students who get full marks on quizzes frequently            </p>

            @for($i=0;$i<sizeof($excellentstudents['name']);$i++)
                <div class="row">

                    {{$excellentstudents['name'][$i]}}
                    {{$excellentstudents['id'][$i]}}
                    @endfor

                </div>
                <div class="row">

                    <a href="/courseView/{{$courseID}}"><button type="button" class="btn btn-defult btn-lg" >  got it  </button></a>
                </div>

        </div>
</body>

</html>
