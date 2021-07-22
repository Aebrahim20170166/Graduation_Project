
<html>
<head>
    <title> Create Quiz</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
<div class="d1 sidebar">

    <header> Eduance </header>


    <ul>
        <li class="CourseName"><a href="/courseView/{{$courseID}}"> {{$courseID}}</a></li>
        <li><a class="active" href="Quizs.html"> <span class="glyphicon glyphicon-check"></span> Quizzes</a></li>
        <li><a href={{route('createQuiz',['courseID' => $courseID])}}> Create Quiz</a></li>
        <li><a href="{{route('quizreport',['courseID' => $courseID])}}"> Quiz Report </a></li>
        <li><a href="{{route('quizChart',['courseID' => $courseID])}}"> Quiz Chart</a></li>
        <li><a href="{{route('logout')}}">Log Out</a></li>
    </ul>


</div>
<fieldset >
    <div class="d2 container">
        <div class="row ">
            <form id="sections" action="{{route('savequiz')}}" method="post">
                {{@csrf_field()}}

                <input class="topic" type="text" placeholder="quiz topic" name="quizTopic">

                <input type="hidden" value="{{$courseID}}" name="courseID">
                <input type="hidden" value="0" id="questionsCount" name="questionsCount">
                <br>
                <input class="save" type="submit" value="save quiz">
                <div>
                    <p class="p">Write your question here</p> <span class="gl1 glyphicon glyphicon-hand-down"></span>
                </div>
            </form>
        </div>
        <div class="row text-center">
            <a id="add-new-section" href="#"><span class="gl glyphicon glyphicon-plus"></span> </a><br />

        </div>
    </div>
</fieldset>

<script>

    /*
    to create new question you need to
    1- create div to contain the question section
    2- add to this div the following elements
           I- input element contain the question body
           II-
    */
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
        // generate name & id
        question.name = 'question'+questionID;
        question.id = 'question'+questionID;
        question.placeholder = 'question body';
        section.appendChild(question);
        var br = document.createElement('br');
        section.appendChild(br);


        var options = document.createElement('div');


        options.appendChild(optionCount);

        var correctAnswer = document.createElement('select');
        correctAnswer.name = 'correctAnswer'+questionID;
        options.appendChild(correctAnswer);

        var grade = document.createElement('p');
        grade.innerHTML = 'Question Grade';
        grade.id = 'grade';
        section.appendChild(grade);



        var questionGrade = document.createElement('input');
        questionGrade.type = 'number';
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
            newOption(question.id,options,correctAnswer,optionCount)
            console.log(question.id);

        }
        section.appendChild(addNewOption);


        var br4 = document.createElement('br');
        section.appendChild(br4);

        document.getElementById('sections').appendChild(section);

    };

    var newOption = function(questionID,where, correctAnswerList,optionCountID) {

        console.log(optionCountID.value);
        var optionDiv = document.createElement('div');
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
        questionOption.classList.add("Answers");
        // questionOption.size = '40';
        questionOption.onchange = function(){
            console.log( document.getElementById(questionOption.id))
            document.getElementById('C'+newOptionID).innerHTML = questionOption.value;
            document.getElementById('C'+newOptionID).value = questionOption.value;

        }
        optionDiv.appendChild(questionOption)
        where.appendChild(optionDiv);

        var option = document.createElement('option');
        option.value = questionOption.value;
        option.id = 'C'+newOptionID;
        option.name = 'C'+newOptionID;
        option.innerHTML = questionOption.value;
        correctAnswerList.appendChild(option);

        var close = document.createElement('input');
        close.type = 'button';
        close.value = 'x';
        close.style.width = '26px';
        close.id = 'Close';
        close.onclick = function() {
            var parent = this.parentNode;
            parent.parentNode.removeChild(parent);

            document.getElementById(option.id).remove();

        };
        optionDiv.appendChild(close);
        optionDiv.appendChild(questionOption)
        where.appendChild(optionDiv);

        var br2 = document.createElement('br');
        where.appendChild(br2);

    };

    document.getElementById('add-new-section').onclick = newQuestion;

    newQuestion();

</script>

</body>
</html>


