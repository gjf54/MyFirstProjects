@extends('layouts.layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('/styles/pages/profile.css') }}">
@endsection

@section('scripts')
<script src="{{ asset('/js/profile_js/script.js') }}"></script>
@endsection

@section('title')
{{ __('Profile') }}
@endsection

@section('content')
<div class="profile_content">

    <div class="profile_menu">
        <div class="row">
            <div class="profile_menu_element col-md-2 col-sm-4" onclick="switch_selected('info')" id="info" selected><span>My Profile</span></div>
            <div class="profile_menu_element col-md-2 col-sm-4" onclick="switch_selected('todo')" id="todo"><span>My ToDo Lists</span></div>
            <div class="profile_menu_element col-md-2 col-sm-4" onclick="switch_selected('contribution')" id="contribution"><span>Contribution</span></div>
        </div>
    </div>

    <iframe src="{{ route('info') }}" id="iframe"></iframe>
</div>
@endsection