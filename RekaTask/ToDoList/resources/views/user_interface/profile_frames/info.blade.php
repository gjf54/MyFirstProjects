@extends('layouts.profile.iframe_layout')

@section('content')
@foreach($users as $user)
<div class="info">
    <div class="row">
        <div class="info_image col-sm-6 mx-auto">
            <img src="{{ asset($user->avatar) }}" alt="User avatar">
        </div>
        <div class="info_credentials col-sm-6">
            <div class="info_credentials_field">
                <span class="field_title">Name</span>
                <span class="field_value">{{ $user->name }}</span>
            </div>
            <div class="info_credentials_field">
                <span class="field_title">Login</span>
                <span class="field_value">{{ $user->login }}</span>
            </div>
            <div class="info_credentials_field">
                <span class="field_title">E-mail</span>
                <span class="field_value">{{ $user->email }}</span>
            </div>
            <div class="info_credentials_field">
                <a href="#">Edit..</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection()