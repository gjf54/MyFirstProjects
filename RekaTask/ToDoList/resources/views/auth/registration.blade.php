@extends('layouts.layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('/styles/auth/registration.css') }}">
@endsection

@section('title')
{{ __('Registration') }}
@endsection

@section('content')

<form class="d-flex justify-content-center col-sm-8 col-md-8 mx-auto" action="{{ route('registration_post') }}" method="POST">
    @csrf

    <div class="auth_form">
        <div class="form_element" class="d-flex justify-content-center">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form_element">
            @error('name')
            <span id="form_element_error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form_element" class="d-flex justify-content-center">
            <label for="login">{{ __('Login') }}</label>
            <input type="text" id="login" name="login" required>
        </div>
        <div class="form_element">
            @error('login')
            <span id="form_element_error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form_element">
            <label for="email">{{ __('Email') }}</label>
            <input type="text" id="email" name="email" required>
        </div>
        <div class="form_element">
            @error('email')
            <span id="form_element_error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form_element">
            <label for="password">{{ __('Password') }}</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form_element">
            @error('password')
            <span id="form_element_error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form_element">
            <label for="password_repeat">{{ __('Repeat password') }}</label>
            <input type="password" id="password_repeat" name="password_repeat" required>
        </div>
        <div class="form_element">
            @error('password_repeat')
            <span id="form_element_error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form_element" id="send_button">
            <input type="submit" class="btn btn-success">
        </div>
        <div class="form_element">
            <a href="/login">Already have account?</a>
        </div>
    </div>
</form>

@endsection