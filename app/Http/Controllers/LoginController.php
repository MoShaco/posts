<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show() {
        return view('login');
    }

    public function autehticate(Request $request) {

        $peronalInfo = $request->validate ([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($peronalInfo)) {
            $request->session()->regenerate();
            return redirect()->intended('/profile');
        }
        
        return back()->withErrors([
            'email' => 'The provided info do not match our records.',
        ]);
    }
}
