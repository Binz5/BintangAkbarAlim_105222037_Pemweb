<?php

namespace App\Jawaban;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NomorSatu
{

    public function auth(Request $request)
    {

        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';


        if (Auth::attempt([$loginField => $request->login, 'password' => $request->password])) {

            return redirect()->route('event.home');
        }

        return back()->withErrors(['login' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('event.home');
    }
}
