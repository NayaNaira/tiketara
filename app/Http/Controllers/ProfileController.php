<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Tampilkan halaman profile
    public function index()
    {
        $user = Auth::user();

        return view('profile.profile', compact('user'));
    }

    // Update profile
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

        // Upload avatar
        if ($request->hasFile('avatar')) {

            $path = $request->file('avatar')
                ->store('avatars', 'public');

            $validated['avatar'] = $path;
        }

        $user->update($validated);

        return redirect()
            ->route('profile.index')
            ->with('success', 'Profile berhasil diperbarui');
    }
}