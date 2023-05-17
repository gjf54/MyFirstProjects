<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\TruePassword;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

class RegistrationController extends Controller
{
    public function start()
    {
        return view('registration');
    }

    public function store(Request $request): RedirectResponse
    {

        $token = $request->session()->token();

        $token = csrf_token();

        $validated = $request->validate([
            'login' =>  ['required', 'unique:user,login', 'max:18'],
            'name' => ['max:30', 'string', 'required'],
            'password' => ['required', new TruePassword],
            'passwordRepeat' => ['required', 'same:password']
        ]);

        $request->session()->put('user-login', 'Login');

        $user = new User;
        $user->name = $request['Name'];
        $user->login = $request['Login'];
        $user->password = $request['password'];
        $user->save();

        return redirect('/');
    }
}
