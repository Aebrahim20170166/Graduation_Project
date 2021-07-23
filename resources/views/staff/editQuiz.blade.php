<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

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
            margin-left:  20%;
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
        a span.gl1
        {
            color:  #FFB03B;
            font-size: 25px;
            margin-left: 50%;
        }
        input.finish
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
            width: 85%;
            text-align: center;
            color: black;
            margin-top: 20px;

        }
        a:hover
        {
            text-decoration: none;

        }
        div.d3
        {
            margin-top: 2%;
        }
        div.d3 a#add-new-section
        {
            font-size: 30px;
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
        .questionGrade
        {
            width: 100px;
            border-radius: 50px;
        }
        input#grade
        {
            font-size: 18px;
            color: #535565;
            font-family: "Playfair Display", serif;
            font-weight: 400;
            margin-left: 1%;
            display: inline-block;
            width: 40px;
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

    var list = ['a','b','c','d','e','f'];


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
                correctAnswerIndicator:form["correct_answer"].value,
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

    var newOption2 = function(questionID, correctAnswerList,optionCountID) {
        console.log(questionID + " " + " " + correctAnswerList + " " + optionCountID)
        console.log("hellooo")
        var optionDiv = document.createElement('div');

        // create option input
        var optionCountValue = parseInt(optionCountID.value);
        if(optionCountValue == 6)
            return alert("each question must have at more six answers")
        var indicator = optionCountValue;
        optionCountValue +=1;
        optionCountID.value = optionCountValue;

        console.log(" option count " + optionCountValue + " indicator " + indicator);
        console.log(correctAnswerList);

        var newOptionID = questionID + 'option' + optionCountValue;
        var questionOption = document.createElement('input');
        questionOption.type = 'text';
        questionOption.required = 'required'
        questionOption.name = newOptionID;
        questionOption.placeholder = 'option content';
        questionOption.id = newOptionID;
        questionOption.classList.add("Answers");

        // questionOption.size = '40';

        // questionOption.onchange = function(){
        //     console.log( document.getElementById(questionOption.id))
        //     document.getElementById('C'+newOptionID).innerHTML = questionOption.value;
        //     document.getElementById('C'+newOptionID).value = questionOption.value;
        // }


        // create the option and insert it to correct answer list
        var list=['a','b','c','d','e','f'];
        var option = document.createElement('option');
        option.value = list[indicator];
        // option.id = 'C'+newOptionID;
        // option.name = 'C'+newOptionID;

        option.innerHTML = list[indicator];

        correctAnswerList.appendChild(option);
        console.log(correctAnswerList);



        // close button
        var close = document.createElement('input');
        close.type = 'button';
        close.value = 'x';
        close.style.width = '26px';
        close.id = 'Close';
        console.log("hi" + indicator);
        var choiceIndicator = list[indicator];

        close.onclick = function(indicator) {
            var optionCountValue = parseInt(optionCountID.value);
            if(optionCountValue == 2)
                return alert("each question must have at least two answers")
            console.log("indicator " + indicator)

            var correctAnswerIndicator = correctAnswerList.value;
            // var i = optionCountValue;
            // var choiceIndicator = list[--i];
            console.log("cor ans " + correctAnswerIndicator + " choi indi " + choiceIndicator + " indicator " + indicator);

            if(correctAnswerIndicator == choiceIndicator)
                return alert("you can not remove the correct answer")

            if(correctAnswerIndicator > choiceIndicator){
                var index = list.indexOf(correctAnswerIndicator);
                index-=1
                correctAnswerList.selectedIndex = index;

                console.log( correctAnswerIndicator + " with index " + list.indexOf(correctAnswerIndicator));
                console.log("new selection is " + list[index] + " with index " + index)
            }

            optionCountValue -= 1;
            optionCountID.value  = optionCountValue;
            listLength = correctAnswerList.length;
            var greatestValue = list[--listLength];
            for(var i=0; i<correctAnswerList.length;i++){
                console.log(i + " " + correctAnswerList[i].value + " " + greatestValue)
                if(correctAnswerList[i].value == greatestValue) {
                    correctAnswerList[i].remove();
                }
            }
            var parent = this.parentNode;
            parent.parentNode.removeChild(parent);
        };

        var li = document.createElement('li');
        optionDiv.appendChild(li);
        optionDiv.appendChild(close);
        optionDiv.appendChild(questionOption)
        var location = document.getElementById(questionID+"ol");
        location.appendChild(optionDiv);

        var br2 = document.createElement('br');
        // where.appendChild(br2);


    };

    var newQuestion = function() {

        questionsCount = document.getElementById('questionsCount')
        var section = document.createElement('div');

        // 1- add close button
        var close = document.createElement('input');
        close.type = 'button';
        close.value = 'x';
        close.style.width = '26px';
        close.id = 'Close';
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
        question.required = 'required';
        // generate name & id
        question.name = 'question'+questionID;
        question.id = 'question'+questionID;
        question.placeholder = 'question body';
        section.appendChild(question);
        var br = document.createElement('br');
        section.appendChild(br);


        var options = document.createElement('ol');
        options.type = 'a';
        options.id = "question"+questionID+"ol";

        section.appendChild(optionCount);

        var correctAnswer = document.createElement('select');
        correctAnswer.name = 'correctAnswer'+questionID;
        section.appendChild(correctAnswer);

        var grade = document.createElement('p');
        grade.innerHTML = 'Question Grade';
        grade.id = 'grade';
        section.appendChild(grade);



        var questionGrade = document.createElement('input');
        questionGrade.type = 'number';
        questionGrade.required = 'required';
        questionGrade.name = 'questionGrade'+ questionID;
        questionGrade.id = 'questionGrade' ;
        questionGrade.style.width = '60px';

        section.appendChild(questionGrade);
        var br1 = document.createElement('br');
        section.appendChild(br1);


        var correct_Answer = document.createElement('p');
        correct_Answer.innerHTML = 'Select Correct Answer';
        correct_Answer.id = 'correct_Answer';
        section.appendChild(correct_Answer);
        section.appendChild(options);



        var addNewOption = document.createElement('a');
        addNewOption.innerHTML = 'Add Answer';
        addNewOption.href = '#';
        addNewOption.id = 'add-new-option';
        addNewOption.onclick = function(){
            newOption(question.id,correctAnswer,optionCount)
            // console.log(question.id);

        }
        section.appendChild(addNewOption);


        var br4 = document.createElement('br');
        section.appendChild(br4);

        document.getElementById('sections').appendChild(section);
        newOption2(question.id,correctAnswer,optionCount)
        newOption2(question.id,correctAnswer,optionCount)

    };

    var displayOption = function (question){

        var optionDiv = document.createElement('div');
        var questionID = question['questionID'].value;
        var questionOption = document.createElement('input');
        questionOption.type = 'text';
        var newOptionID =   parseInt(question['optionCount'].value);
        document.getElementById(questionID+'options').value = ++newOptionID;

        questionOption.name = 'choices';
        questionOption.value = '';
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
        var answersCount = question['choices'].length;
        var list=['a','b','c','d','e','f'];
        option.value = list[answersCount];
        option.id = 'C'+newOptionID;
        option.name = 'C'+newOptionID;
        option.innerHTML = list[answersCount];
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
        var li = document.createElement('li');
        optionDiv.appendChild(li);
        optionDiv.appendChild(close);
        optionDiv.appendChild(questionOption)
        var optionsLocation = document.getElementById(questionID+"ol");
        optionsLocation.appendChild(optionDiv);
        console.log(optionsLocation);
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
                quizID:{{$quizID}},
                answersCount:question["choices"].length

            },
            success:function(optionID){
                console.log(optionID);
                displayOption(question,optionID);
            },
        });
    };

    var removeChoice = function (choiceNode,choiceID,questionID,choicIndicator){
        var list = ['a','b','c','d','e','f'];
        var question = document.getElementById(questionID);
        var correctAnswerIndicator = question["correct_answer"].value
        var isCorrectAnswerChange = "false";
        if(correctAnswerIndicator > choicIndicator)
            isCorrectAnswerChange = "true"

        $.ajax({
            url: "{{ route('removeChoice') }}",
            type: 'POST',
            data:{
                choiceID: choiceID,
                questionID:questionID,
                isCorrectAnswerChange: isCorrectAnswerChange
            },
            success:function(newCorrectAnswerIndicator){
                console.log(newCorrectAnswerIndicator);
                choiceNode.remove();
                var answersCount = question["correct_answer"].length;
                var greatestValue = list[--answersCount];
                console.log(greatestValue);

                if(isCorrectAnswerChange == "true") {
                    for (let i = 0; i < answersCount; i++) {
                        if (question["correct_answer"][i].value == newCorrectAnswerIndicator)
                            question["correct_answer"].selectedIndex = i;
                    }
                }

                for(let i = 0; i<=answersCount;i++){
                    console.log(question["correct_answer"][i].value + " " + greatestValue);
                    if(question["correct_answer"][i].value == greatestValue) {

                        question["correct_answer"][i].remove();
                    }
                }

                // if(isCorrectAnswerChange == "true"){
                //     question["correct_answer"].selectedIndex = newCorrectAnswerIndicator;
                // }
                // console.log("hi")
                // for(let i =0; i<answersCount;i++){
                //
                //     console.log(question["correct_answer"][i].value)
                //     if(question["correct_answer"][i].value == greatestValue) {
                //         console.log("innnnn")
                //         question["correct_answer"][i].remove();
                //     }
                // }
                // if(isCorrectAnswerChange == "true")
                //     question["correct_answer"].selectedIndex = newCorrectAnswerIndicator;

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
{{--<div class="d1 sidebar">--}}

{{--    <header> Eduance </header>--}}

{{--
    <ul>
        <li class="CourseName"><a href="CourseContent.html">Course <span> 1 </span></a></li>
        <li><a href="Quizs.html"> <span class="glyphicon glyphicon-check"></span> Quizzs</a></li>
        <li><a class="active" href="CreateQuiz.html"> Create Quiz</a></li>
        <li><a href="QuizReport.html"> Reports </a></li>
        <li><a href="#">Profile</a></li>
        <li><a href="#">Log Out</a></li>
    </ul>
--}}

{{--</div>--}}

<div class="d2 container">
    <div class="row ">
        @foreach($questions as $question)
            <form id="{{$question['questionid']}}" onchange="saveQuestion(this)">

                <div  name="options">
                    <input type="button" id="close" value="x" style="width: 26" onclick="removeQuestion(this.parentElement,'{{$question['questionid']}}')">
                    <input type="hidden" value="{{$question['questionid']}}"  name="questionID">
                    <input type="hidden" value="{{$question['optionsCount']}}" id="{{$question['questionid']}}options" name="optionCount">
                    <input type="text" value="{{$question['question']}}" name="content">
                    <br>
                    <select name="correct_answer">

                        <option  value="{{$question['correctAnswerID']}}" id="{{$question['correctAnswerID']}}"> {{$question['correctAnswerID']}} </option>
                        @for($j=1; $j<=$question['optionsCount']; $j++)
                            @if($question['optionindicator'.$j] != $question['correctAnswerID'])

                                <option value="{{$question['option'.$j]}}" id="{{$question['optionid'.$j]}}">
                                    <script>
                                        document.getElementById("{{$question['optionid'.$j]}}").innerHTML='{{$question['optionindicator'.$j]}}'
                                        document.getElementById("{{$question['optionid'.$j]}}").value='{{$question['optionindicator'.$j]}}'
                                        console.log({{$j}})
                                    </script>
                                </option>

                            @endif
                        @endfor


                    </select>
                    <input type="number" class="questionGrade" value="{{$question['questionGrade']}}" name="grade" id="grade">
                    <br>
                    <ol type="a" id="{{$question['questionid']}}ol" >
                    @for($j=1; $j<=$question['optionsCount']; $j++)
                        <div>
                            <li></li>
                            <input type="button" value="x" id="close" style="width: 22"
                                   onclick="removeChoice(this.parentElement,'{{$question['optionid'.$j]}}'
                                       ,{{$question['questionid']}},'{{$question['optionindicator'.$j]}}')">
                            <input class="Answers" type="text" value="{{$question['option'.$j]}}" name="choices" id="{{$question['optionid'.$j]}}" onchange="updateChoice({{$question['optionid'.$j]}},this.value)">
                        </div>
                    @endfor
                    </ol>
                </div>
                {{--        <a href="#" onclick="test(this.parentElement)"> test</a>--}}
                <a href="#" id="add-new-option" onclick="newOption(this.parentElement)">add answer</a>
            </form>
    </div>
</div>

@endforeach
<form  action="{{route('saveNewQuestions')}}" method="post">
    {{@csrf_field()}}
    <div id="sections">
    <div id="newQuestions">
        <input type="hidden" value="{{$quizID}}" name="quizID">
        <input type="hidden" value="0" id="questionsCount" name="questionsCount">
    </div>
    <input class="finish" type="submit" value="finish">
    </div>
</form>
<div class="text-center d3">

    <a id="add-new-section" class="Add" href="#" onclick="newQuestion()"><span class="gl glyphicon glyphicon-plus"> </span> </a>
</div>
</body>
</html>

