@extends('layout')

@section('title')
Registration
@endsection()

@section('content')
<div class="registration">
    <img src="{{ asset('images/regImages/back1.jpg') }}" />
    <div class="login-box">
        <h2>Registration</h2>
        <form>
            <div class="user-box">
                <input type="text" name="name" required="">
                <label>Name</label>
            </div>
            <div class="user-box">
                <input type="text" name="login" required="">
                <label>Login</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required="">
                <label>Password</label>
            </div>
            <div class="user-box">
                <input type="password" name="passwordRepeat" required="">
                <label>Repeat Password</label>
            </div>
            <a href="#">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Submit
            </a>
            <a class="escapeLoginReg" href="/login">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Log In
            </a>
        </form>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@endsection()