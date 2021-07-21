@extends('layouts.header')
@section('content')
<head><title>Sign Up</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link  href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700,700i" rel="stylesheet">
    <style type="text/css">
        body
        {
            background: linear-gradient(rgba(0,0,0,0.3) , rgba(0,0,0,0.3) , rgba(0,0,0,0.3)), url("images/top.jpg");
            filter: brightness(95%);
            background-size: cover;
            position: relative;
            font-family: "Playfair Display", serif;
            font-weight: 400;
            font-style: italic;
        }
        h1
        {
            margin: 50px 100px;
            color: #F4F4F6;
            font-weight: 700;
        }

        input
        {
            width: 300px;
            height: 30px;
            margin: 15px;
            border:none ;
            font-size: 18px;
            border-bottom: 1px solid black;
            background: transparent;
            color: #F4F4F6;
        }
        .btn
        {
            background-color: #F4F4F6;
            font-size: 20px;
            height: 40px;
            color: black;
        }
        ::placeholder
        {
            color: #F4F4F6;
        }
        .sign-up-cta
        {
            color: #F4F4F6;
            margin: 20px 50px;
        }
    </style>
</head>

    <script>
        function validate(){
            var email = document.getElementById('email').value;
            var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (re.test(email)){
                return true;
            } else {
                document.getElementById("result").innerHTML = "invalid email";
                return false;
            }
        }
    </script>

    <div class="container">
        <div class="content">
            <h1 class="heading">Sign Up</h1>

            @if($errors->any())
                <div class="error">{{ $errors->first() }}</div>

            @endif
            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
            @endif
            <form action={{route("createAccount")}} method="post" onsubmit="return validate()">
                @csrf
                <div class="input-box">
                    <input type="text" class="input-control" placeholder="First name" name="first_name" autocomplete="off">
                    @error('first_name')
                    <span class="form-text text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="input-box">
                    <input type="text" class="input-control"  placeholder="Last name" name="last_name" autocomplete="off">
                    @error('last_name')
                    <span class="form-text text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="input-box">
                    <input type="text" id="email" class="input-control" required placeholder="Email address" name="email" autocomplete="off" >
                    @error('email')
                    <span class="form-text text-danger">{{$message}}</span>

                    @enderror
                    <span id="result" class="text-danger"></span>
                </div>
                <div class="input-box">
                    <input type="text" class="input-control" placeholder="Username please" required name="username" pattern="[a-z0-9]{6,}" title="enter valid id" autocomplete="off">
                    @error('username')
                    <span class="form-text text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="input-box">
                    <input type="password" class="input-control" required placeholder="Enter password" name="password" autocomplete="off">
                    @error('password')
                    <span class="form-text text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="input-box">
                    <input type="hidden" name="role" value="instructor">

                </div>

                <div class="input-box">
                    <input type="submit" class="input-submit btn">
                </div>
                <div class="sign-up-cta"><span>Already have an account?</span> <a href={{route('Login')}}>Login here</a></div>
            </form>
        </div>
    </div>

@endsection

