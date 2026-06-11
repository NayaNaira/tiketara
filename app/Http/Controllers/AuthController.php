<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\MustVerifyEmail;

class AuthController extends Controller
{



    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // cek email & password
    if (!Auth::attempt($request->only('email', 'password'))) {
        return back()->withErrors([
            'email' => 'Email atau password salah'
        ])->withInput();
    }

    $request->session()->regenerate();

    /** @var \App\Models\User $user */
    $user = Auth::user();

    // cek email sudah diverifikasi
    if (is_null($user->email_verified_at)) {

        Auth::logout();

        return back()->withErrors([
            'email' => 'Silakan verifikasi email terlebih dahulu'
        ]);
    }

    // cek status akun
    if ($user->status !== 'active') {

        Auth::logout();

        return back()->withErrors([
            'email' => 'Akun belum aktif'
        ]);
    }

    // redirect berdasarkan role
    return match ($user->role) {
        'super_admin' => redirect('/super'),
        'promotor' => redirect('/promotor'),
        default => redirect('/dashboard'),
    };
}




    public function register(Request $request)
    {
         $request->validate([
          'name' => 'required|max:255',
          'email' => 'required|email|unique:users,email',
          'password' => 'required|min:6|confirmed',
        ], [
           'name.required' => 'Nama wajib diisi',
           'name.max' => 'Nama maksimal 255 karakter',

           'email.required' => 'Email wajib diisi',
           'email.email' => 'Format email tidak valid',
           'email.unique' => 'Email sudah terdaftar',

           'password.required' => 'Password wajib diisi',
           'password.min' => 'Password minimal 6 karakter',
           'password.confirmed' => 'Konfirmasi password tidak cocok',
]);

        $user = User::create([
         'name' => $request->name,
         'email' => $request->email,
         'role' => 'pembeli',
         'status' => 'verify',
         'password' => Hash::make($request->password),
        ]);

        $user->sendEmailVerificationNotification();

         return redirect('/login')
         ->with('success', 'Register berhasil. Cek email untuk verifikasi.');
    }




    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}