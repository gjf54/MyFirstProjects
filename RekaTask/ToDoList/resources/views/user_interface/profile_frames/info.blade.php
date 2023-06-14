@extends('layouts.profile.iframe_layout')

@section('content')
@foreach($users as $user)

@php
$user->avatar = 'imgs/User_imgs/Avatars/' . $user->avatar;
@endphp

<div class="info">
    <div class="row justify-content-left">
        <div class="info_image col-sm-4">
            <img src="{{ asset($user->avatar) }}" alt="User avatar">
        </div>
        <div class="info_credentials col-sm-4">
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
                <a href="{{ route('info_edit') }}">Edit..</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection()