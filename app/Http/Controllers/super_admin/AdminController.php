<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // 1. Tampilkan semua user yang status pengajuannya 'pending'
    public function promoterRequests()
    {
        $requests = User::where('promoter_status', 'pending')->get();
        return view('super.promoter-requests', compact('requests'));
    }

    // 2. Proses keputusan admin (Approve / Reject)
    public function handlePromoterRequest(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $action = $request->input('action'); // mengambil input 'approve' atau 'reject'

        if ($action === 'approve') {
            $user->update([
                'role' => 'promoter',          // Resmi naik pangkat jadi promoter
                'promoter_status' => 'approved' // Status pengajuan disetujui
            ]);
            return redirect()->back()->with('success', "Akun {$user->name} berhasil disetujui sebagai Promoter!");
        } 
        
        if ($action === 'reject') {
            $user->update([
                'promoter_status' => 'rejected' // Status ditolak, role tetap buyer biasa
            ]);
            return redirect()->back()->with('error', "Pengajuan {$user->name} telah ditolak.");
        }

        return redirect()->back();
    }
}