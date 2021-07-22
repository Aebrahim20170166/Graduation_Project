<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

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
        div.d2 .row
        {
            margin-left:  15%;
        }
        p.p
        {
            font-size: 20px;
            color: #535565;
            font-family: "Playfair Display", serif;
            font-weight: 400;
            margin-left: 3%;
            display: inline-block;
        }
        span.gl1
        {
            color:  #FFB03B;
            font-size: 25px;
            margin-left: 2%;
        }
        input.save
        {

            margin-left:  40%;
            width: 20%;
            border-radius: 15px;
            margin-top: 10px;
            background-color:#535565;
            color: #FFB03B;
        }
        input
        {
            font-size: 20px;
            height: 50px;
            width: 95%;
            text-align: center;
            color: black;
            margin-top: 20px;

        }
        a:hover
        {
            text-decoration: none;

        }
        a#add-new-section
        {
            font-size: 30px;
            color: #FFB03B;


        }
        .save:hover
        {
            background-color:#535565;
            color: #FFB03B;
        }
        #add-new-option
        {
            font-size: 30px;
            color:#535565;
            margin: 200px;
            text-decoration: none;
        }

        fieldset
        {

            padding: 40px;

        }
        .Answers
        {

            width: 50%;
            margin: 10px;
        }
        .topic
        {
            margin: 4% 5%;
            width: 40%;
            border-radius: 15px;
        }
        #Close
        {
            background-color: #535565 ;
            color: white;
            font-size: 15px;
            border-radius: 80px;
            height: 30px;
            transition: 0.5s;
        }
        #Close:hover
        {
            background-color: red;
        }
        #questionGrade
        {
            width: 100px;
            border-radius: 50px;
        }
        #grade
        {
            font-size: 18px;
            color: #535565;
            font-family: "Playfair Display", serif;
            font-weight: 400;
            margin-left: 1%;
            display: inline-block;
        }
        #correct_Answer
        {
            font-size: 18px;
            color: #535565;
            font-family: "Playfair Display", serif;
            font-weight: 400;
            margin-left: 1%;
            display: inline-block;
        }

    </style>

</head>
<body>
<script>
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function updateChoice(choiceID,newValue){
        document.getElementById(choiceID).innerHTML = newValue;
        document.getElementById(choiceID).value = newValue;
    }

    function removeQuestion(node,questionID) {
        $.ajax({
            url: "{{ route('removeQuestion') }}",
            type: 'POST',
            data:{
                id: questionID
            },
            success:function(data){
                console.log(data);
                node.remove();
            },
            error:function(xhr,status,error){
                $.each(xhr.responseJSON.errors,function (key,item)
                    {
                        alert(item)
                    }
                );
                // alert(data.code);
            }
        });
    }

    var saveQuestion = function (form){
        var count=form["choices"].length
        var choices=[]
        for(let i=0;i<count;i++){
            choices[i] =form["choices"][i].value;
        }
        $.ajax({
            url: "{{ route('updateQuestion') }}",
            type: 'POST',
            datatype:"json",
            data:{
                id: form["questionID"].value,
                content:form["content"].value,
                correctAnswer:form["correct_answer"].value,
                grade:form["grade"].value,
                choices:choices,
                quizID:{{$quizID}}
            },
            success:function(data){
                // alert(data);
                console.log(data);
            },
            // error:function(xhr,status,error){
            //     $.each(xhr.responseJSON.errors,function (key,item)
            //         {
            //             alert(item)
            //         }
            //     );
            // }
        });
    }

    var newOption2 = function(questionID,where, correctAnswerList,optionCountID) {
        console.log(optionCountID.value);
        var questionOption = document.createElement('input');
        questionOption.type = 'text';
        // generate name & id
        var optionCountValue = parseInt(optionCountID.value);
        optionCountValue +=1;
        console.log(optionCountValue);
        var newOptionID = questionID + 'option' + optionCountValue;
        console.log('optionCountValue ' + optionCountValue)
        optionCountID.value = optionCountValue ;
        questionOption.name = newOptionID;
        questionOption.placeholder = 'option content';
        questionOption.id = newOptionID;
        questionOption.size = '40';
        questionOption.onchange = function(){
            console.log( document.getElementById(questionOption.id))
            document.getElementById('C'+newOptionID).innerHTML = questionOption.value;
            document.getElementById('C'+newOptionID).value = questionOption.value;
        }
        where.appendChild(questionOption);
        var option = document.createElement('option');
        option.value = questionOption.value;
        option.id = 'C'+newOptionID;
        option.name = 'C'+newOptionID;
        option.innerHTML = questionOption.value;
        correctAnswerList.appendChild(option);
        var br2 = document.createElement('br');
        where.appendChild(br2);
    };

    var newQuestion = function() {
        questionsCount = document.getElementById('questionsCount')
        var section = document.createElement('div');
        // 1- add close button
        var close = document.createElement('input');
        close.type = 'button';
        close.value = 'x';
        close.style.width = '26px';
        close.onclick = function() {
            var parent = this.parentNode;
            parent.parentNode.removeChild(parent);
        };
        section.appendChild(close);
        // create question id and increment value of questions count
        var questionID = parseInt(questionsCount.value);
        questionID +=1;
        questionsCount.value = questionID;
        var optionCount = document.createElement('input');
        optionCount.type = 'hidden';
        optionCount.id = 'optionCount' + questionID;
        optionCount.name = 'optionCount' + questionID;
        optionCount.value = 0;
        var question = document.createElement('input');
        question.type = 'text';
        // generate name & id
        question.name = 'question'+questionID;
        question.id = 'question'+questionID;
        question.placeholder = 'question body';
        section.appendChild(question);
        var br = document.createElement('br');
        section.appendChild(br);
        var options = document.createElement('div');
        section.appendChild(options);
        options.appendChild(optionCount);
        var correctAnswer = document.createElement('select');
        correctAnswer.name = 'correctAnswer'+questionID;
        options.appendChild(correctAnswer);
        var addNewOption = document.createElement('a');
        addNewOption.innerHTML = 'add new option';
        addNewOption.href = '#';
        addNewOption.id = 'add-new-option';
        addNewOption.onclick = function(){
            newOption2(question.id,options,correctAnswer,optionCount)
            console.log(question.id);
        }
        options.appendChild(addNewOption);
        var br4 = document.createElement('br');
        section.appendChild(br4);
        document.getElementById('newQuestions').appendChild(section);
        newOption2(question.id,options,correctAnswer,optionCount);
        newOption2(question.id,options,correctAnswer,optionCount)
    };

    var displayOption = function (question){
        var optionDiv = document.createElement('div');
        var questionID = question['questionID'].value;
        var questionOption = document.createElement('input');
        questionOption.type = 'text';
        var newOptionID =   parseInt(question['optionCount'].value);
        document.getElementById(questionID+'options').value = ++newOptionID;
        questionOption.name = 'choices';
        questionOption.placeholder = 'option content';
        questionOption.id = newOptionID;
        questionOption.onchange = function(){
            console.log( document.getElementById(questionOption.id))
            document.getElementById('C'+newOptionID).innerHTML = questionOption.value;
            document.getElementById('C'+newOptionID).value = questionOption.value;
        }
        var location = document.getElementById(question['questionID'].value)
        // alert("location " + location)
        var option = document.createElement('option');
        option.value = questionOption.value;
        option.id = 'C'+newOptionID;
        option.name = 'C'+newOptionID;
        option.innerHTML = questionOption.value;
        question['correct_answer'].appendChild(option);
        var close = document.createElement('input');
        close.type = 'button';
        close.value = 'x';
        close.id='close';
        close.style.width = '26px';
        close.onclick = function() {
            var parent = this.parentNode;
            parent.parentNode.removeChild(parent);
            document.getElementById(option.id).remove();
        };
        optionDiv.appendChild(close);
        optionDiv.appendChild(questionOption)
        location.appendChild(optionDiv);
        var br2 = document.createElement('br');
        location.appendChild(br2);
    }

    var newOption = function(question) {
        $.ajax({
            url: "{{ route('addOption') }}",
            type: 'POST',
            datatype:"json",
            data:{
                id: question["questionID"].value,
                quizID:{{$quizID}}
            },
            success:function(optionID){
                console.log(optionID);
                displayOption(question,optionID);
            },
        });
    };

    var removeChoice = function (node,choiceID){
        $.ajax({
            url: "{{ route('removeChoice') }}",
            type: 'POST',
            data:{
                id: choiceID
            },
            success:function(data){
                node.remove();
            },
            error:function(xhr,status,error){
                $.each(xhr.responseJSON.errors,function (key,item)
                    {
                        alert(item)
                    }
                );
                // alert(data.code);
            }
        });
    }

</script>
<div class="d1 sidebar">

    <header> Eduance </header>


    <ul>
        <li class="CourseName"><a href="CourseContent.html">Course <span> 1 </span></a></li>
        <li><a href="Quizs.html"> <span class="glyphicon glyphicon-check"></span> Quizzs</a></li>
        <li><a class="active" href="CreateQuiz.html"> Create Quiz</a></li>
        <li><a href="QuizReports.html"> Reports </a></li>
        <li><a href="#">Profile</a></li>
        <li><a href="#">Log Out</a></li>
    </ul>


</div>
<div class="d2 container">
    <div class="row ">
@foreach($questions as $question)
    <form id="sections" onchange="saveQuestion(this)">

        <div id="{{$question['questionid']}}" name="options">
            <input type="button" id="close" value="x" style="width: 26" onclick="removeQuestion(this.parentElement,'{{$question['questionid']}}')">
            <input type="hidden" value="{{$question['questionid']}}"  name="questionID">
            <input type="hidden" value="{{$question['optionsCount']}}" id="{{$question['questionid']}}options" name="optionCount">
            <input type="text" value="{{$question['question']}}" name="content">
            <br>
            <select name="correct_answer">
                <option value="{{$question['correctAnswer']}}" > {{$question['correctAnswer']}} </option>
                @for($j=1; $j<=$question['optionsCount']; $j++)
                    @if($question['option'.$j] != $question['correctAnswer'])
                        <option value="{{$question['option'.$j]}}" id="{{$question['optionid'.$j]}}"> {{$question['option'.$j]}} </option>
                    @endif
                @endfor

            </select>
            <input type="number" style="width: 40px" value="{{$question['questionGrade']}}" name="grade" id="grade">
            <br>
            @for($j=1; $j<=$question['optionsCount']; $j++)
                <div>
                    <input type="button" value="x" id="close" style="width: 22" onclick="removeChoice(this.parentElement,'{{$question['optionid'.$j]}}')">
                    <input type="text" value="{{$question['option'.$j]}}" name="choices" id="{{$question['optionid'.$j]}}" onchange="updateChoice({{$question['optionid'.$j]}},this.value)">
                </div>
            @endfor
        </div>
        {{--        <a href="#" onclick="test(this.parentElement)"> test</a>--}}
        <a href="#" id="add-new-option" onclick="newOption(this.parentElement)">add answer</a>
    </form>
    </div>
</div>

@endforeach
<form  action="{{route('saveNewQuestions')}}" method="post">
    {{@csrf_field()}}
    <div id="newQuestions">
        <input type="hidden" value="{{$quizID}}" name="quizID">
        <input type="hidden" value="0" id="questionsCount" name="questionsCount">
    </div>
    <input type="submit" value="finish">

</form>
<a id="add-new-section" href="#" onclick="newQuestion()">add question </a><br />

</body>
</html>
