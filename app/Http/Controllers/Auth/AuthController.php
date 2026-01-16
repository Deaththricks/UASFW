<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ===== LOGIN =====
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'user_name' => 'required',
            'password'  => 'required',
        ]);

        if (Auth::attempt($request->only('user_name', 'password'))) {
            $request->session()->regenerate();

            if (auth()->user()->role === 'manager') {
                return redirect('/manager/dashboard');
            }

            if (auth()->user()->role === 'staff') {
                return redirect('/staff/dashboard');
            }

            return redirect('/');
        }

        return back()->withErrors([
            'user_name' => 'Username atau password salah',
        ]);
    }

    // ===== REGISTER =====
    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'user_name'    => 'required|string|max:50|unique:users',
            'email'        => 'required|email|unique:users',
            'no_hp'        => 'required|string|max:20',
            'alamat'       => 'required|string',
            'password'     => 'required|min:6|confirmed',
        ]);

        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'user_name'    => $request->user_name,
            'email'        => $request->email,
            'no_hp'        => $request->no_hp,
            'alamat'       => $request->alamat,
            'password'     => Hash::make($request->password),
            'role'         => 'pelanggan',
            'status'       => 1,
        ]);

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil, silakan login');
    }

    // ===== LOGOUT =====
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
