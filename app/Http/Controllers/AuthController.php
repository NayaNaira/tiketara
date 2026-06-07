<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak ditemukan'
            ])->withInput();
        }

        if (!$user->hasVerifiedEmail()) {
            return back()->withErrors([
                'email' => 'Silakan verifikasi email terlebih dahulu'
            ])->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Email atau password salah'
            ])->withInput();
        }

        $request->session()->regenerate();

        // Redirect berdasarkan role
        if ($user->role === 'super_admin') {
            return redirect('/super');
        }

        if ($user->role === 'promotor') {
            return redirect('/admin');
        }

        return redirect('/dashboard');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            #'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'pembeli',
            'password' => Hash::make($request->password),
        ]);

        $user->sendEmailVerificationNotification();

        return redirect('/login')->with(
            'success',
            'Register berhasil. Silakan cek email untuk verifikasi akun.'
        );
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}