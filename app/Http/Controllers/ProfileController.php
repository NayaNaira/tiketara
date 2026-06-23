<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Tampilkan halaman profile
    public function index()
    {
        $user = Auth::user();

        $orders = [];
        $promoterEvents = [];
        $pendingEvents = [];
        $pendingPromoters = [];

        if ($user->role === 'buyer') {
            $orders = \App\Models\Order::with(['event', 'ticketType'])
                ->where('user_id', $user->id)
                ->latest()
                ->get();
        } elseif ($user->role === 'promoter') {
            $promoterEvents = \App\Models\Event::where('promoter_id', $user->id)
                ->latest()
                ->get();
        } elseif ($user->role === 'super_admin') {
            $pendingEvents = \App\Models\Event::with('promoter')
                ->where('status', 'pending')
                ->latest()
                ->get();

            $pendingPromoters = \App\Models\User::where('promoter_status', 'pending')
                ->latest()
                ->get();
        }

        return view('profile.profile', compact('user', 'orders', 'promoterEvents', 'pendingEvents', 'pendingPromoters'));
    }

    // Tampilkan halaman edit profile
    public function edit()
    {
        $user = Auth::user();
        
        return view('profile.edit-profile', compact('user'));
    }

    // Update profile biasa
    public function update(Request $request)
    {
       /** @var \App\Models\User $user */
       $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'nik' => 'nullable|string|max:16',
            'address' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Upload avatar & hapus yang lama agar storage bersih
        if ($request->hasFile('avatar')) {
            if ($user->avatar && !str_starts_with($user->avatar, 'http')) {
                Storage::disk('public')->delete($user->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $path;
        }

        $user->update($validated);

        return redirect()
            ->route('profile.index')
            ->with('success', 'Profile berhasil diperbarui');
    }

    // ==========================================================
    // 💥 BERIKUT FUNGSI TAMBAHAN UNTUK PENGAJUAN PROMOTER 💥
    // ==========================================================

    /**
     * Tampilkan halaman form apply promoter
     */
    public function applyPromoter()
    {
        $user = Auth::user();

        // Proteksi: Harus terverifikasi emailnya
        if (is_null($user->email_verified_at)) {
            return redirect()->route('profile.index')->with('error', 'Silakan verifikasi email Anda terlebih dahulu sebelum mengajukan sebagai promoter.');
        }

        // Proteksi: Jika sudah pending atau approved, jangan kasih masuk lagi
        if (!in_array($user->promoter_status, ['none', 'rejected'])) {
            return redirect()->route('profile.index')->with('info', 'Anda sudah mengajukan atau telah menjadi promoter.');
        }

        return view('profile.apply-promoter', compact('user'));
    }

    /**
     * Proses simpan data apply promoter
     */
    public function storePromoterApplication(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Validasi input form pengajuan
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Upload logo instansi promoter & bersihkan file lama
        if ($request->hasFile('avatar')) {
            if ($user->avatar && !str_starts_with($user->avatar, 'http')) {
                Storage::disk('public')->delete($user->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        // Ubah status pengajuan menjadi pending
        $validated['promoter_status'] = 'pending';

        $user->update($validated);

        return redirect()
            ->route('profile.index')
            ->with('success', 'Pengajuan promoter berhasil dikirim! Menunggu konfirmasi admin.');
    }
}