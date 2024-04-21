<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // public function login(Request $request)
    // {
    //     $cred = $request->validate([
    //         'username' => ['required', 'exists:users'],
    //         'password' => ['required']
    //     ]);
    //     $remember = $request->has('remember');

    //     if (Auth::attempt($cred, $remember)) {
    //         return redirect('/');
    //     }
    //     return back()->withErrors([
    //         'username' => 'Username atau Password yang diberikan salah.',
    //     ])->onlyInput('username');
    // }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => ['required']
        ]);

        if (filter_var($request->login, FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        } else {
            $field = 'username';
        }

        $cred = array_merge([$field => $request->login], $request->only('password'));

        if (Auth::attempt($cred, $request->filled('remember'))) {
            return redirect('/');
        }

        return back()->withErrors([
            'login' => 'Email atau Username atau Password yang diberikan salah.',
        ])->onlyInput('login');
    }
    public function register(Request $request)
    {
        $request->validate([
            'nama' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'username' => ['required', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => 'petugas',
        ]);

        return redirect('/login')->with('store', 'success');
    }
    public function showRegistrationForm()
    {
        return view('auth.register');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
