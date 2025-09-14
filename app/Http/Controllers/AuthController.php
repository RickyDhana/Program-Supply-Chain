<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // validasi input
        $credentials = $request->validate([
            'name'     => ['required', 'string', 'max:255'],   // sesuai kolom DB
            'password' => ['required', 'string', 'max:25'],    // password maksimal 25 karakter
        ]);

        // coba login pakai Auth::attempt()
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin'); // masuk ke halaman admin
        }

        return back()->withErrors([
            'msg' => 'Login gagal, cek kembali name & password.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
