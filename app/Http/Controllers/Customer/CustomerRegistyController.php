<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerRegistryController extends Controller
{
    // Show Login/Register Page (Assuming you have one view for both or separate)
    public function showAuthForm() {
        return view('auth.customer-auth'); // Adjust to your view path
    }

    // Process Registration
    public function register(Request $request) {
        $request->validate([
            'user_name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'nama_lengkap' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required'
        ]);

        $user = User::create([
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nama_lengkap' => $request->nama_lengkap,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'role' => 'pelanggan',
        ]);

        Auth::login($user);
        return redirect()->route('main.dashboard');
    }

    // Process Login
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // This is the "Intended" logic: if they were trying to checkout, 
            // send them back there. Otherwise, send to dashboard.
            return redirect()->intended(route('main.dashboard'));
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    // Process Logout
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('main.dashboard');
    }
}
