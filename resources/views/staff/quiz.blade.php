<html>
<head>
    <title> Create Quiz</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style type="text/css">
        @extends('layouts.sidebar')
        @section('content')
<<<<<<< HEAD
/*---------- DIV 2 ----------*/
=======
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


        }
        /*---------- DIV 2 ----------*/
>>>>>>> 539e3b51df376a2f248079bdb2d5c234176a05e7
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

<fieldset >
    <div class="d2 container">
        <div class="row ">
            <form   action="{{route('savequiz')}}" method="post">

                {{@csrf_field()}}
                <div id="sections">

                <input class="topic" type="text" placeholder="quiz topic" name="quizTopic" required>

                <input type="hidden" value="{{$courseID}}" name="courseID">
                <input type="hidden" value="0" id="questionsCount" name="questionsCount">
                <br>

                <div>
                    <p class="p">Write your question here</p> <span class="gl1 glyphicon glyphicon-hand-down"></span>

                </div>
                </div>
                <input class="save" type="submit" value="save quiz">
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
        grade.innerHTML = 'Question Grade ';
        grade.id = 'grade';
        section.appendChild(grade);



        var questionGrade = document.createElement('input');
        questionGrade.type = 'number';
        questionGrade.min = '1';
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
        newOption(question.id,correctAnswer,optionCount)
        newOption(question.id,correctAnswer,optionCount)

    };

    var newOption = function(questionID, correctAnswerList,optionCountID) {
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

    document.getElementById('add-new-section').onclick = newQuestion;

    newQuestion();

</script>

</body>
</html>


