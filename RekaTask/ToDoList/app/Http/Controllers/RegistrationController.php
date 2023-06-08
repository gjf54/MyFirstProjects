<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;



class RegistrationController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        if (session()->has('user_login')) {
            redirect('/profile');
        } else {
            return;
        }
    }

    public function reg_user(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'login' => ['required', 'string', 'max:32', 'unique:user'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:user'],
            'password' => ['required', 'string', 'min:8'],
            'password_repeat' => ['same:password'],
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'login' => $request['login'],
            'password' => Hash::make($request['password']),
        ]);

        session()->put('user_login', $request['login']);

        return redirect('/profile');
    }
}
