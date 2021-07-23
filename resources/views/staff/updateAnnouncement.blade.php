<?php
session_start();
$courseID;
if(session()->has('courseID'))
{
    $courseID=session()->get('courseID');
}
?>
<style>

@media (max-width: 768px) {

            {

                font-size: 40px;

            }
            div.d2 form span.Announcement
            {
                font-size: 20px;
            }
            div.d2 .text-center
            {
                margin-left: 25%;
            }
            div.d2 .butt button.button
            {
                margin:0.5% 33%;
                background-color: #FFB03B;
            }
        }
        /*---------- DIV 2 ----------*/
        div.d2 h1
        {
            margin-top: 5%;
            font-size: 60px;
            color: #FFB03B;
            font-family: "Playfair Display", serif;
            font-weight: 700;
            font-style: italic;
        }
        div.d2 span.Announcement
        {
            font-size: 30px;
            color: #535565;
            font-family: "Playfair Display", serif;
            font-weight: 400;
        }
        div.d2 input.s_name
        {
            width: 60%;
            height: 100px;
            background-color: #F4F4F6;
            border: 2px solid #535565;
            font-size: 20px;
        }
        div.d2 button.update
        {
            margin-top: 3%;
            background-color: #F4F4F6;
            transition: 0.5s;
            color:  #FFB03B;
            font-size: 25px;
            border:1px solid #535565;


        }
        div.d2 button.update:hover
        {

            background-color: #F4F4F6;
            color: #535565;
            border:1px solid #FFB03B;

            font-size: 25px;

        }

    </style>
@extends('layouts.sidebar')
@section('content')
<div class="d2 container">
    <div class="row  text-center">
        <h1>{{$courseID}}</h1>
    </div>


    <div class="row text-center">

        <form action="{{route('saveupdate')}}" method="get">
        @csrf <!-- {{ csrf_field() }} -->

            <input type="hidden" name='courseID' value={{$courseID}}> <br>
            <input type="hidden" name='postid' value={{$postid}}> <br>
            <span  class="Announcement">Announcement</span>
            <br>
            <input class="s_name" type="text" name='body' value="{{$body}}" > <br>
            <button type="submit" class="btn btn-defult btn-lg update"> update </button>
        </form>
    </div>

</div>

