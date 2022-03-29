<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function login()
    {
        return view('auths.login');
    }

    public function forgot()
    {
        return view('auths.forgot-password');
    }

    public function forgot_submit(Request $request)
    {
        $credentials = $request->validate(['email' => 'required|email']);

        // Password::sendResetLink($credentials);
        $status = Password::sendResetLink(
            $request->only('email')
        );
     
        return $status === Password::RESET_LINK_SENT
                    ? redirect('/login')->with(['success' => __($status)])
                    : back()->withErrors(['email' => __($status)]);

        // return redirect('/login')->with('success', 'Email reset sandi berhasil dikirimkan');
    }

    public function reset()
    {
        $credentials = request()->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);

        $reset_password_status = Password::reset($credentials, function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();
        });

        if ($reset_password_status == Password::INVALID_TOKEN) {
            return back()->with("failed", "Invalid token provided");
        }

        return redirect('/login')->with('success', 'Berhasil reset password');
    }

    public function postlogin(Request $request)
    {
        //jika isi request email dan password
        if (Auth::attempt($request->only('email','password'))) {
            //jika bernilai true, alihkan kan ke route dashboard
            return  redirect()->intended('dashboard');
        }else{
            //jika bernilai false, alihkan kembali ke login
            return redirect('/login')->with('failed','Username atau sandi salah');
        }
    }
    public function logout()
    {
        //menghapus session, redirect ke login
        Auth::logout();
        return redirect('/login');
    }
}
