@extends('layouts.layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('/styles/pages/welcome.css') }}">
@endsection

@section('title')
My ToDo
@endsection

@section('content')
<div class="content">
    <div class="header row d-flex justify-content-center align-items-center">
        <div class="header_title col-sm-12 col-md-6">
            <span id="header_title">Create <span>your own</span> to do list for free!</span>
        </div>
        <div class="header_text col-sm-12 col-md-6">
            <span id="header_text">Hello! On this site you can create your own to do list. You can manage it with other users. And it's for free!</span>
        </div>
    </div>
    <div class="blocks row d-flex justify-content-around">
        <div class="block col-md-5 col-sm-12">
            <div class="block_text">Create and edit your to do list!</div>
            <div class="block_img"></div>
        </div>
        <div class="block col-md-5 col-sm-12">
            <div class="block_text">Add contributors to your list and manage their permission!</div>
            <div class="block_img"></div>
        </div>
    </div>
</div>
@endsection