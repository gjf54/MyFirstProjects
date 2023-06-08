@extends('layouts.layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('/styles/auth/login.css') }}">
@endsection

@section('title')
Login
@endsection

@section('content')
<form class="form d-flex justify-content-center col-sm-8 col-md-4 mx-auto" action="{{ route('login_post') }}" method="POST">
    @csrf

    @if(session()->has('user_login'))
    {{ __('Session is here!') }}
    @endif

    <div class="auth_form">
        <div class="form_element d-flex justify-content-center">
            <label for="login">Login</label>
            <input type="text" id="login" name="login">
        </div>
        <div class="form_element">
            <label for="password">Passsword</label>
            <input type="password" id="password" name="password">
        </div>
        @error('login')
        <div class="form_element">
            <span id="form_element_error">{{ $message }}</span>
        </div>
        @enderror
        <div class="form_element" id="send_button">
            <input type="submit" class="btn btn-success">
        </div>
        <div class="form_element">
            <a href="/registration">Dont have account?</a>
        </div>
    </div>
</form>
@endsection