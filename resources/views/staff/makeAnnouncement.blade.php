<?php
$courseID;
if(session()->has('courseID'))
{
    $courseID=session()->get('courseID');
}
?>
@extends('layouts.sidebar')
@section('content')
    <style>
    @media (max-width: 768px) {


        div.d2 h1.h1
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
        }}
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
    div.d2 button.post
    {
        margin-top: 3%;
        background-color: #F4F4F6;
        transition: 0.5s;
        color:  #FFB03B;
        font-size: 25px;
        border:1px solid #535565;

    }
    div.d2 button.post:hover
    {
        background-color: #F4F4F6;
        color: #535565;
        border:1px solid #FFB03B;

        font-size: 25px;
    }
div.ann
{
    color: #535565;
    border:1px solid #FFB03B;
    border-radius: 10px;

    text-align: center;
    font-size: 25px;

}
    .butt
    {

        padding-left:  20%;


    }

    div.d2 button.btn1
    {

        color: #535565;
        font-size: 15px;
    }
    div.d2 button.btn1:hover
    {


        color: #FFB03B;
        font-size: 15px;
    }
    div.d2 button.btn2
    {
        color: #535565;
        font-size: 15px;
    }
    div.d2 button.btn2:hover
    {


        color: #FFB03B;
        font-size: 15px;
    }
    </style>

    <div class="d2 container ">
    <div class="row text-center">
        <h1 class="h1">{{$courseID}}</h1>
    </div>



    <div class="row text-center">
        @if(isset($error))
            <div  style="margin-left:30" class="alert alert-danger" role="alert">
                {{$error}}
            </div>
        @endif
        <form action="{{route('makepost')}}" method="post">
            @csrf

            <input type="hidden" name='courseID' value={{$courseID}}> <br>

            <span class="Announcement">Your Announcement</span>
            <br>
            <input class="s_name" type="text" name='announcement' > <br>
            <button type="submit" class="btn btn-defult btn-lg post" >post </button>
        </form>
    </div>
    </div>
    <div class="butt">
        @if(isset($Announcements))
            @foreach($Announcements as $announce)
                <div class="row">

                    <a href={{route('updatepost',['courseID' => $courseID,'postid'=>$announce->id,'body'=>$announce->body])}} >

                        <button type="button" class="btn button btn1" >  <span class=" glyphicon glyphicon-edit"></span></button></a>

                    <a href={{route('deletepost',['courseID' => $courseID,'postid'=>$announce->id,'body'=>$announce->body])}} >
                        <button type="button" class="btn button btn2" >   <span class=" glyphicon glyphicon-trash"></span></button></a>

                </div>
                <div class="ann"> {{$announce->body}}</div>

            @endforeach
        @endif

    </div>




