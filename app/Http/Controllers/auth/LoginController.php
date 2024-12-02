<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'nullable', // Field ini opsional jika Anda hanya ingin login dengan email
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Percobaan login menggunakan email dan password
        $credentials = $request->only('email', 'password');

        // Jika login sukses, redirect ke dashboard
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard');
        }

        // Jika login gagal, kembalikan dengan error
        return back()->withErrors([
            'login' => 'Email atau password salah.',
        ])->withInput($request->except('password')); // Kecuali password
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
