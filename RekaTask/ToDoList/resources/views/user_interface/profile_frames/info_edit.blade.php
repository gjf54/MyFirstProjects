@extends('layouts.profile.iframe_layout')

@section('content')
@foreach($users as $user)
<div class="info_edit d-flex">
    <div class="row  align-items-baseline">
        <div class="info_edit_block d-flex justify-content-center col-sm-6">
            <form action="{{ route('info_update') }}" method="POST" class="d-flex justify-content-center flex-column" enctype="multipart/form-data">
                @csrf

                <div class="info_edit_field">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ $user->name }}">
                </div>
                <div class="info_edit_field">
                    @error('name')
                    <span id="info_edit_field_error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="info_edit_field">
                    <label for="login">Login</label>
                    <input type="text" name="login" id="login" value="{{ $user->login }}">
                </div>
                <div class="info_edit_field">
                    @error('login')
                    <span id="info_edit_field_error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="info_edit_field"><label for="email">Email</label><input type="text" name="email" id="email" value="{{ $user->email }}"></div>
                <div class="info_edit_field">
                    @error('email')
                    <span id="info_edit_field_error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="info_edit_field"><label for="avatar">Avatar</label><input type="file" name="avatar" id="avatar"></div>
                <div class="info_edit_field">
                    @error('avatar')
                    <span id="info_edit_field_error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="info_edit_field"><label for="password">Password</label><input type="password" name="password" id="password"></div>
                <div class="info_edit_field">
                    @error('password_info')
                    <span id="info_edit_field_error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="info_edit_field"><input type="submit" class="btn btn-success" value="Change data"></div>
            </form>
        </div>
        @endforeach
        <div class="info_edit_block d-flex justify-content-center col-sm-6">
            <form action="{{ route('info_update') }}" method="POST" class="d-flex justify-content-center flex-column">
                @csrf

                <div class="info_edit_field">
                    <label for="current_password">Current password</label>
                    <input type="password" name="password" id="current_password">
                </div>
                <div class="info_edit_field">
                    @error('password_password')
                    <span id="info_edit_field_error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="info_edit_field"><label for="new_password">New password</label><input type="password" name="new_password" id="new_password"></div>
                <div class="info_edit_field">
                    @error('new_password')
                    <span id="info_edit_field_error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="info_edit_field"><label for="new_password_repeat">Repeat new password</label><input type="password" name="new_password_repeat" id="new_password_repeat"></div>
                <div class="info_edit_field">
                    @error('new_password_repeat')
                    <span id="info_edit_field_error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="info_edit_field">
                    <input type="submit" class="btn btn-success" value="Change password">
                </div>
            </form>
            <div class="info_edit_field_back d-flex justify-content-center flex-wrap align-items-center">
                <a href="/profile/info"><span>Back</span></a>
            </div>
        </div>
    </div>
</div>
@endsection