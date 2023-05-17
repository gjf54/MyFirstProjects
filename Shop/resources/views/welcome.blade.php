@extends('layout')

@section('title')
Shop
@endsection()

@section('content')
<div class="welcome-slide-header">

</div>
<div class="welcome-slide-cards">
    <div class="welcome-slide-cards-card">
        <img src="{{ asset('images/welcome/back1.gif') }}" alt="home1">
        <div class="welcome-slide-cards-card-content"><span>Hello! this is SchoolShop.</span></div>
    </div>
    <div class="welcome-slide-cards-card">
        <img src="{{ asset('images/welcome/home2.jpg') }}" alt="home2">
        <div class="welcome-slide-cards-card-content"><span>Card</span></div>
    </div>
    <div class="welcome-slide-cards-card">
        <img src="{{ asset('images/welcome/home3.jpg') }}" alt="home3">
        <div class="welcome-slide-cards-card-content"><span>Card</span></div>
    </div>
    <div class="welcome-slide-cards-card">
        <img src="{{ asset('images/welcome/home4.jpg') }}" alt="home4">
        <div class="welcome-slide-cards-card-content"><span>Card</span></div>
    </div>
</div>
<div class="welcome-slide-footer">

</div>
@endsection()