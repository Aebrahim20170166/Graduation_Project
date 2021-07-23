@extends('layouts.sidebar')
@section('content')
<style>
        @media (max-width: 768px) {


            div.d2 .btn1
            {
                margin: 1.5% 25%;
                font-size: 10px;

            }
        }
        /*---------- DIV 2 ----------*/

         div.d2 .title h1
        {
            font-family: "Playfair Display", serif;
            font-weight: 700;
            color: #535565;
            font-style: italic;
            font-size: 50px;
            padding: 6% 10%;
        }
        div.d2 span
        {
            color:#FFB03B;
        }

        div.d2 table
        {
            margin-left: 25%;
            width:60%
        }
         div.d2	th
        {
            font-size: 25px;
            text-align: center;
        }
        div.d2	td
        {
            font-size: 20px;
            padding: 20px;
            text-align: center;

        }

    </style>

<div class="container d2 text-center">
    <div class=" title ">
        <h1>{{$sessionName}}</h1>
    </div>
    <div class="row text-center">
        <table >
            <tr >
                <th>Student <span> ID</span> </th>
                <th>Student <span> Name</span> </th>

            </tr>
            @foreach($attendances as $attendance)
                <tr>
                    <td>{{$attendance->student_id}}</td>
                    <td>{{$attendance->Fname." ".$attendance->Lname}}</td>
                </tr>
            @endforeach
        </table>

    </div>
</div>

