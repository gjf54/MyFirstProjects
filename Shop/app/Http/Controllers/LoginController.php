<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function start()
    {
        return view('login');
    }


    public function check($request)
    {
        $res = DB::select('SELECT name FROM user WHERE login = ? password = ?', [$request['name'], $request['password']]);
        if (isset($res[0])) {
            $request->session()->put('user-login', 'Login');
            return view('welcome');
        } else {
        }
    }
}
