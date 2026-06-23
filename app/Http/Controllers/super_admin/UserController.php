<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // Kelola Promoter
    public function indexPromoters()
    {
        $promoters = User::where('role', 'promoter')
            ->withCount('events')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('super.users.promoters', compact('promoters'));
    }

    // Kelola Buyer
    public function indexBuyers()
    {
        $buyers = User::where('role', 'buyer')
            ->withCount('orders')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('super.users.buyers', compact('buyers'));
    }

    // Toggle Suspend (Suspend / Unsuspend)
    public function toggleSuspend($id)
    {
        $user = User::findOrFail($id);

        if ($user->status === 'suspended') {
            $user->status = 'active';
            $message = "Status akun {$user->name} berhasil diubah menjadi Aktif.";
        } else {
            $user->status = 'suspended';
            $message = "Akun {$user->name} berhasil ditangguhkan (Suspended).";
        }

        $user->save();

        return redirect()->back()->with('success', $message);
    }

    // Toggle Ban (Ban / Unban)
    public function toggleBan($id)
    {
        $user = User::findOrFail($id);

        if ($user->status === 'banned') {
            $user->status = 'active';
            $message = "Status akun {$user->name} berhasil diubah menjadi Aktif.";
        } else {
            $user->status = 'banned';
            $message = "Akun {$user->name} berhasil diblokir (Banned).";
        }

        $user->save();

        return redirect()->back()->with('success', $message);
    }

    // Hapus Akun
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        DB::transaction(function () use ($user) {
            // Hapus pesanan milik user ini agar tidak melanggar foreign key constraint
            Order::where('user_id', $user->id)->delete();
            
            // Hapus user
            $user->delete();
        });

        return redirect()->back()->with('success', "Akun {$user->name} berhasil dihapus permanen.");
    }
}
