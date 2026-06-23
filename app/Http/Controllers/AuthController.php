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

        // Email verification check dipindah ke profil agar user bisa login dan request resend email
        // status active cukup untuk masuk ke aplikasi.

        // cek status akun
        if ($user->status !== 'active') {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Akun belum aktif'
            ]);
        }

        // cek apakah sudah diverifikasi
        if (is_null($user->email_verified_at)) {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Anda harus memverifikasi email Anda sebelum dapat masuk. Silakan cek kotak masuk Anda.'
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

        // Buat akun dengan status ACTIVE agar bisa login, namun belum diverifikasi (email_verified_at = null)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'buyer',
            'status' => 'active', 
            'password' => Hash::make($request->password),
        ]);

        // Kirim email verifikasi
        $user->sendEmailVerificationNotification();

        // JANGAN otomatis login untuk mencegah bot
        // Auth::login($user);

        // Redirect ke halaman verifikasi email
        return redirect()->route('verification.notice')->with('email', $request->email);
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
            $user = new User();
            $user->name = $googleUser->getName() ?? 'Pengguna Google';
            $user->email = $googleUser->getEmail();
            $user->password = \Illuminate\Support\Facades\Hash::make(\Illuminate\Support\Str::random(16));
            $user->role = 'buyer';
            $user->status = 'active';
            $user->email_verified_at = now();
            $user->save();
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
        \Illuminate\Support\Facades\Log::error('Google OAuth Error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
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