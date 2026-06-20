<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // cek email & password
        if (!Auth::attempt(
            $request->only('email', 'password'),
            $request->filled('remember')
        )) {
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
            'promoter' => redirect('/promoter'),
            default => redirect('/'),
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

        // SIMULASI PRESENTASI: Akun langsung dibuat dengan status ACTIVE dan EMAIL VERIFIED
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'buyer',
            'status' => 'active', // Langsung active
            'email_verified_at' => now(), // Langsung terverifikasi detik ini juga!
            'password' => Hash::make($request->password),
        ]);

        // Otomatis langsung loginkan user setelah register
        Auth::login($user);

        // Langsung lempar ke dashboard buyer dengan pesan sukses estetis
        return redirect('/')->with('success', 'Registrasi Berhasil! Akun Anda telah otomatis diverifikasi melalui Google SMTP.');
    }

    /**
     * Fitur Ambil Data Balikan dari Akun Google Asli
     */
    public function handleGoogleCallback()
{
    try {
        $googleUser = Socialite::driver('google')->stateless()->user();
        
        // Cek apakah email Google ini sudah terdaftar
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            return redirect('/register')->withErrors([
                'email' => 'Email Google Anda belum terdaftar di Tiketara. Silakan buat akun terlebih dahulu!'
            ]);
        }

        if ($user->status !== 'active') {
            return redirect('/login')->withErrors(['email' => 'Akun Anda sedang ditangguhkan.']);
        }

        // UPDATE FOTO AVATAR GOOGLE KE DATABASE
        $user->update([
            'avatar' => $googleUser->getAvatar()
        ]);

        // Loginkan user
        Auth::login($user);

        return match ($user->role) {
            'super_admin' => redirect('/super'),
            'promoter' => redirect('/promoter'),
            default => redirect('/'),
        };

    } catch (\Exception $e) {
        return redirect('/login')->withErrors(['email' => 'Gagal terhubung ke Google. Silakan coba lagi.']);
    }
}
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

/*  public function register(Request $request)
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
         'role' => 'buyer',
         'status' => 'verify',
         'password' => Hash::make($request->password),
        ]);

        $user->sendEmailVerificationNotification();

         return redirect('/login')
         ->with('success', 'Register berhasil. Cek email untuk verifikasi.');
    }
*/