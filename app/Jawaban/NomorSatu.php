<?php

namespace App\Jawaban;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NomorSatu
{
    // Fungsi untuk login
    public function auth(Request $request)
    {
        // Validasi input login
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        // Tentukan apakah input adalah email atau username
        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Autentikasi pengguna
        if (Auth::attempt([$loginField => $request->login, 'password' => $request->password])) {
            // Jika login berhasil, redirect ke halaman event.home
            return redirect()->route('event.home');
        }

        // Jika login gagal, kembali dengan pesan error
        return back()->withErrors(['login' => 'Invalid credentials.']);
    }

    // Fungsi untuk logout
    public function logout(Request $request)
    {
        // Proses logout pengguna
        Auth::logout();

        // Redirect ke halaman event.home setelah logout
        return redirect()->route('event.home');
    }
}
