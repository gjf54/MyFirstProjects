@extends('layout')

@section('title')
Log In
@endsection

@section('content')
<div class="registration">
    <img src="{{ asset('images/regImages/back1.jpg') }}" />
    <div class="login-box">
        <h2>Login</h2>
        <form>
            <div class="user-box">
                <input type="text" name="" required="">
                <label>Username</label>
            </div>
            <div class="user-box">
                <input type="password" name="" required="">
                <label>Password</label>
            </div>
            <a href="#">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Submit
            </a>
            <a class="escapeLoginReg" href="/registration">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Registration
            </a>
        </form>
    </div>
</div>
<!--useless, make:auth-->
@endsection