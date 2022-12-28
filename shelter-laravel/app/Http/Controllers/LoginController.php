<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login',

            'home' => 'Welcome',
            'user' => 'Username',
            'pass' => 'Password',

            'wave' => 'wave.png',
            'avatar' => 'avatar.svg',
            'bg' => 'bg.svg',
            'register' => 'Belum Punya Akun? Daftar Disini',

            'css' => 'login.css',
            'js' => 'login.js'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Login Failed!');

    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
