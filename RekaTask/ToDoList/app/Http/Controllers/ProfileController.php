<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;

class ProfileController extends Controller
{

    public function index()
    {
        return view('user_interface.profile');
    }

    public function info()
    {
        $login = session()->get('user_login');

        $user = DB::select('SELECT * FROM user WHERE login = ?', [session()->get('user_login')]);

        return view('user_interface.profile_frames.info', ['users' => $user]);
    }

    public function todo()
    {
        return view('user_interface.profile_frames.todo');
    }

    public function contribution()
    {
        return view('user_interface.profile_frames.contribution');
    }

    public function update()
    {
    }

    public function log_out()
    {
        session()->remove('user_login');
        return redirect('/');
    }
}
