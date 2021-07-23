@extends('layouts.sidebar')
@section('content')
<style>

    div.d2 .title h1
    {
    font-family: "Playfair Display", serif;
    font-weight: 700;
    color: #535565;
    font-style: italic;
    font-size: 50px;
    margin-top: 5%;
    }
    div.d2 .title span
    {
    color:#FFB03B;
    }
    div.d2 table
    {
    margin:40px 200px;
    width:70%
    }
    div.d2	th
    {
    font-size: 25px;
    text-align: center;
    }
    div.d2	td
    {
    font-size: 30px;
    padding: 20px;
    }
    </style>

    <div class="container">

        <div class="container d2">
            <div>
                <div class=" title text-center">
                    <h1> Your <span> Quizzes </span></h1>
                </div>
                <div class="Quizs text-center">

            <table>
                @foreach($quizes as $quiz)
                <tr>
                    <td><a href={{route('showQuiz',['quizID' => $quiz->id])}}>{{$quiz->topic}}</a></td>
                    <td>{{$quiz->date}}</td>

                </tr>

                @endforeach
            </table>
                    <a href={{route('createQuiz',['courseID' => session('courseID')])}}><button type="button" class="btn btn-defult btn-lg" > <span class="glyphicon glyphicon-check"></span> create quiz</button></a>

                </div>
            </div>
        </div>

    </div>
