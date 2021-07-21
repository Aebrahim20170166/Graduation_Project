<!DOCTYPE html>
<html>
<head>

    <title>FirstPage</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link  href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700,700i" rel="stylesheet">
    <style type="text/css">
        /*----- Navbar -----*/
        div.d1
        {
            width: 100%;
            background: rgba(26, 24, 22, 0.4);

            height: 70px;
        }
        div.d1 ul
        {
            margin-left: 100px;
        }
        div.d1 li {

            position: relative;
            white-space: nowrap;
            padding: 10px 0 10px 24px;

        }

        div.d1 li a {


            text-align: center;
            padding: 14px 16px;
            text-decoration: none;

            position: relative;
            color: #ffffff;
            transition:  transform 1s;
            font-size: 15px;
            font-family: "Poppins", sans-serif;
            font-weight: 400;
        }

        div.d1 li a:hover:not(.active) {
            color: #FFB03B;
            border-radius: 50px;
            background:  rgba(26, 24, 22, 0.2);
            border: 1.5px solid #FFB03B;

        }

        div.d1 .active {
            color: #FFB03B;
            font-weight: 900;

        }
        div.d1 .active:hover
        {
            background:  rgba(26, 24, 22, 0.2);
            border-radius: 50px;
            border: 1.5px solid #FFB03B;
        }

        div.d1 h2 a
        {
            color: #FFB03B;
            font-family: "Playfair Display", serif;
            font-weight: 700;
            font-style: italic;
            margin-left: 80px;
            font-size: 45px;

        }
        div.d1 h2 a:hover
        {
            text-decoration: none;
            color: #FFB03B;
        }
        /*----- top of page -----*/
        #top {
            width: 100%;
            height: 80vh;
            background: url("images/top.jpg") top center;
            filter: grayscale(40%);
            background-size: cover;
            position: relative;
        }


        #top h1 {
            margin: 0;
            font-size: 48px;
            font-weight: 700;
            line-height: 56px;
            color: #fff;
            font-family: "Poppins", sans-serif;
        }


        #top .container {
            padding-top: 150px;
        }

        @media (max-width: 992px) {
            #top .container {
                padding-top: 150px;
            }
        }


        @media (min-width: 1024px) {
            #top {
                background-attachment: fixed;
            }
        }

        @media (max-width: 768px) {
            #top {
                height: 80vh;
            }
            #top h1 {
                font-size: 25px;
                line-height: 36px;
            }
            div.d1
            {

                height: 50px;
            }
            div.d1 h2 a
            {
                font-size: 25px;

            }
        }


        #top .btn-get-started {
            font-family: "Raleway", sans-serif;
            font-weight: 500;
            font-size: 15px;
            letter-spacing: 1px;
            display: inline-block;
            padding: 10px 35px;
            border-radius: 50px;
            transition: 0.5s;
            margin-top: 30px;
            border: 2px solid #fff;
            color: #fff;
        }

        #top .btn-get-started:hover {
            background: #FFB03B;
            border: 2px solid #FFB03B;
            text-decoration: none;
            width: 180px;
            height: 60px;
            font-size: 22px;
        }
        /*----- Section 1 -----*/
        .section1-title h1
        {
            color: #FFB03B;
            margin-left: 30%;
            font-size: 50px;
            margin-top: 4%
        }
        @media (max-width: 768px){
            .section1-title h1
            {
                font-size: 28px;
            }
        }

        .section1-p p {

            font-size: 25px;
            font-weight: 700;
            font-family: "Poppins", sans-serif;
            margin-left: 8%;
            color: #35322D;
        }
        @media (max-width: 768px){
            .section1-p p
            {
                font-size: 15px;
            }
        }

        img
        {
            width: 55%;
            height: 55%;
            margin: 3% 30%;
            position: relative;
            transition: 1s;
        }
        img:hover
        {
            width: 75%;
            height: 75%;
            margin: 3% 20%;
        }
        /*----- Section 2 -----*/
        .section2-title h3
        {
            color: #ffffff;
            font-size: 40px;
            margin-top: 4%;
            text-align: center;
        }
        .section2-title h3 span
        {
            color: #FFB03B;
            font-family: "Playfair Display", serif;
            font-weight: 700;
            font-style: italic;
        }
        #section2 .container1
        {
            background-color: #35322D;
            margin: 4% 10%;
            height: 550px;

        }
        #section2 .section2-p p
        {

            color: #ffffff;
            margin: 10% 5%;
            font-size: 18px;
            line-height: 35px;
        }
        #section2 .container2
        {
            margin-top: 4%;
            height: 550px;
            padding-top: 5%;
        }
        #section2 .glyphicon
        {
            font-size: 50px;
            color: #FFB03B;
            transition: 1s;
        }
        #section2 .container2 p
        {
            color: #1C3041;
            font-size: 18px;
        }
        #section2 .glyphicon:hover
        {
            font-size: 80px;
        }
        @media (max-width: 768px){
            #section2 .container1
            {
                width: 200px;
                height: 500px;
                padding: 5% ;
                margin-left: 30%;
            }
            .section2-title h3
            {

                font-size: 20px;
                margin-top: 4%;
                text-align: center;
            }
            #section2 .glyphicon
            {
                font-size: 25px;
                color: #FFB03B;
                transition: 1s;
            }
            #section2 .glyphicon:hover
            {
                font-size: 40px;
            }
            #section2 .container2 p
            {

                font-size: 12px;
            }
            #section2 .container2 h2
            {
                font-size: 29px;
                font-size: 18px;
            }
            #section2 .section2-p p
            {

                color: #ffffff;
                margin: 10% 5%;
                font-size: 12px;
                line-height: 20px;
            }}

    </style>

</head>
<body>
<div class="d1 navbar-fixed-top">
    <nav class="navbar navbar-expand-lg bg-secondary navbar-fixed-top" id="mainNav">
        <div class="container-fluid">
            <div class="navbar-header">

                <h2 class="logo mr-auto "><a href="#">Eduance</a></h2>

            </div>

            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a class="active" href="#section1">About</a></li>
                    <li><a href="{{route('signup')}}">Sign Up</a></li>
                    <li><a href="{{route('Login')}}">Log In</a></li>
                </ul>

            </div>
        </div>
    </nav>
</div>
<div id="top" class="d-flex justify-content-center align-items-center">
    <div class="container">
        <h1>Learning Today,<br>Leading Tomorrow</h1>
        <a href="{{route('signup')}}" class="btn-get-started">Start Now</a>

    </div>
</div>


<div id="section1">
    <div class="container row">
        <div class="section1-title">
            <h1><strong> Welcome to our Website </strong></h1>
        </div>
        <div class="row">
            <div class="section1-image">
                <img src="/images/section1.jpg" class="img-fluid">
            </div>
            <div class="section1-p content text-center">
                <p class="font-italic">This site will allow you to easily deal with many problems that you may encounter during the process of educating students in an advanced and smart way</p>
            </div>
        </div>
    </div>
</div>
<div id="section2">
    <div class="row">
        <div class="container1 col-lg-4 ">
            <div class="section2-title">
                <h3>Why <span> Eduance? </span> </h3>
            </div>
            <div class="section2-p content">

                <p> -Will let you get attendance in a smart way without any fraud.<br>
                    -You can create quizs for your students easily and without facing any difficulties.<br>
                    -You can follow the level of students and know their weaknesses through the reports you get during the course.<br>
                    -Thus, you have got everything you need to facilitate your work and obtain information that helps you to develop and progress.
                </p>

            </div>
        </div>
        <div class="container2 col-lg-4 ">
            <div class="row1">
                <span class="glyphicon glyphicon-qrcode"></span>
                <h2> <strong> how you can take attendance! </strong></h2>
                <p>The fastest and smartest way to get attendance is to use a QR code</p>

            </div>
            <br>
            <br>
            <div class="row2">
                <span class="glyphicon glyphicon-list-alt"></span>
                <h2><strong>Quizs & Reports</strong></h2>
                <p>Through quizs, we create comprehensible reports for you to keep up with your students</p>
            </div>
        </div>

    </div>

</div>

</body>
</html>
