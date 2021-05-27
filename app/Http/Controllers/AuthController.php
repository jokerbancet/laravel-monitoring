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
        //jika isi request email dan password
        if (Auth::attempt($request->only('email','password'))) {
            //jika bernilai true, alihkan kan ke route dashboard
            return redirect('/dashboard');
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
