<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{

    public function index()
    {
        return view('user_interface.profile');
    }

    public function info()
    {
        $login = session()->get('user_login');
        $user = DB::select('SELECT * FROM user WHERE login = ?', [$login]);

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

    public function info_edit()
    {
        $login = session()->get('user_login');
        $user = DB::select('SELECT * FROM user WHERE login = ?', [$login]);

        return view('user_interface.profile_frames.info_edit', ['users' => $user]);
    }

    public function info_update(Request $request)
    {
        $login = session()->get('user_login');
        $user = $request->user();

        if ($request->has('new_password')) {
            if (Auth::attempt(['login' => $login, 'password' => $request->password])) {
                $request->validate([
                    'new_password_repeat' => ['same:new_password'],
                ]);

                $user = $request->user();
                $user->password = Hash::make($request->new_password);
                $user->save();

                return redirect('/profile/info');
            } else {
                return redirect('/profile/info/edit')->withErrors([
                    'password_password' => 'Incorrect password',
                ]);
            }
        } else {
            if (Auth::attempt(['login' => $login, 'password' => $request->password])) {

                if ($request->login == $login) {
                    $request->validate([
                        'name' => ['required', 'string', 'max:255'],
                        'login' => ['required', 'string', 'max:32'],
                        'email' => ['required', 'string', 'email', 'max:255'],
                    ]);
                } else {
                    $request->validate([
                        'name' => ['required', 'string', 'max:255'],
                        'login' => ['required', 'string', 'max:32', 'unique:user'],
                        'email' => ['required', 'string', 'email', 'max:255'],
                    ]);
                }

                if ($request->hasFile('avatar')) {
                    if ($user->avatar !== 'default.gif') {
                        $old_avatar_path = 'imgs/User_imgs/Avatars/' . $user->avatar;
                        File::delete($old_avatar_path);
                    }

                    $avatar = time() . '.' . $request->avatar->getClientOriginalExtension();
                    $request->avatar->move(public_path('imgs/User_imgs/Avatars'), $avatar);

                    $user->avatar = $avatar;
                }

                $user->login = $request->login;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->save();

                session()->put('user_login', $request->login);

                return redirect('/profile/info');
            } else {
                return redirect('/profile/info/edit')->withErrors([
                    'password_info' => 'Incorrect password',
                ]);
            }
        }
    }

    public function log_out()
    {
        session()->remove('user_login');
        return redirect('/');
    }
}
