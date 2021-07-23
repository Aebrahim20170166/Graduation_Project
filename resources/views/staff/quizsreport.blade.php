@extends('layouts.sidebar')
@section('content')
    <style>

        /*---------- DIV 2 ----------*/

        div.d2 .title h2
        {
            font-family: "Playfair Display", serif;
            font-weight: 700;
            color: #535565;
            font-style: italic;
            font-size: 40px;
            margin: 5% 14%;
            text-align: center;
            margin-left: 25%;

        }
        div.d2 .title span
        {
            color:#FFB03B;
        }

        div.d2 table
        {
            margin:40px 200px;
            width:70%;
            margin-left: 20%;

        }
        div.d2    th
        {
            font-size: 25px;
            text-align: center;
        }
        div.d2    td
        {
            font-size: 20px;
            padding: 20px;
            text-align: center;

        }
        div.d2 .btn1
        {
            margin:2% 15%;
            font-size: 18px;
            background-color: #535565;
            transition: 0.5s;
        }
        div.d2 .btn1:hover
        {

            font-size: 25px;

        }
        button
        {
            background-color: #FFB03B;
            color: #ffffff;
        }
    </style>

<div class="d2 container">
    <div class=" title ">
        <h2> Students who get <span> full </span> marks on quizzes <span>frequently</span> </h2>
    </div>
    <div class=" text-center">
        <table>
            <tr>
                <th>Student <span> Name</span> </th>
                <th>Student <span> ID</span> </th>
            </tr>
        @for($i=0;$i<sizeof($excellentstudents['name']);$i++)

                <tr>
                    <td>{{$excellentstudents['name'][$i]}} </td>
                    <td>{{$excellentstudents['id'][$i]}}</td>

                </tr>


            @endfor

            </table>
    </div>





</div>
