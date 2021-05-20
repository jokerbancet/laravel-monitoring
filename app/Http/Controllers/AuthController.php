<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auths.login');
    }

    public function postlogin(Request $request)
    {
        if (Auth::attempt($request->only('email','password'))) {
            return redirect('/dashboard');
        }else{
            return redirect('/login')->with('failed','Username atau sandi salah');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
