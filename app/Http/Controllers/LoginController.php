<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        if ($username === 'admin' && $password === '12345') {

            session(['logged_in' => true]);

            return redirect()->route('events.index');
        }

        return back()->with('error', 'Invalid username or password.');
    }

    public function logout()
    {
        session()->forget('logged_in');

        return redirect()->route('login');
    }
}