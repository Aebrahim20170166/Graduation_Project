@extends('layouts.header')
@section('content')
<head>
    <title>Log In</title>
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
        .login-cta
        {
            color: #F4F4F6;
            margin: 20px 30px;
        }
        a.signup
        {
            font-size: 20px;
        }
        a.signup:hover
        {
            font-size: 25px;
            color: #ffffff;
            text-decoration: none;
        }
        label.remember
        {
            color: #ffffff;
        }
        a.forgot-password
        {
            color: #ffffff;
        }
    </style>
</head>

    <div class="container">
        <div class="content">
            <h1 class="heading">Login</h1>

            @if($errors->any())
                <div class="error">{{ $errors->first() }}</div>

            @endif

        <!--<div class='notification'>Logged In Successfull</div>-->
            @if(Session::has('error'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('error')}}
                </div>
            @endif
            <form action="{{route('validate')}}" method="post">
                @csrf
                <div class="input-box">
                    <input type="text" class="input-control" required placeholder="Email please" name="email" >
                    @error('email')
                    <span class="form-text text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="input-box">
                    <input type="password" class="input-control" required placeholder="Password please" name="password">
                    @error('password')
                    <span class="form-text text-danger">{{$message}}</span>
                    @enderror
                </div>
                <br>
                <div class="input-box rm-box">
                    <div>
{{--                        <input type="checkbox" id="remember-me" class="remember-me" name="remember-me">--}}
{{--                        <label for="remember-me" class="remember">Remember me</label>--}}
                    </div>
{{--                    <a href="forgot_password.php" class="forgot-password">Forgot password?</a>--}}
                </div><br>
                <div class="input-box">
                    <input type="hidden" name="role" value="instructor">

                </div>
                <div class="input-box">
                    <input type="submit" class="input-submit btn" value="LOGIN" name="login">
                </div>
                <div class="login-cta"><span>Don't have an account?</span> <a class="signup" href={{route('signup')}}>Sign up here</a></div>
            </form>

        </div>
    </div>
@endsection

