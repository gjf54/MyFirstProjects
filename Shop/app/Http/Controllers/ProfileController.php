<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProfileController extends Controller
{
    public function start()
    {
        $user = DB::select('SELECT * FROM user WHERE login = ?', [session()->get('login')]);

        return view('profile', ['users' => $user]);
    }
}
