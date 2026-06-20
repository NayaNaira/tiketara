<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventGallery;
use App\Models\TicketType;
use Illuminate\Http\Request; // Ditambahkan agar Request $request terbaca dengan benar
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Menampilkan daftar semua event untuk Super Admin.
     * Menyaring agar data berkode 'draft' mutlak tidak masuk ke layar Super Admin.
     */
    public function index()
    {
        $events = Event::with(['galleries', 'ticketTypes'])
            ->whereIn('status', ['pending', 'approved', 'rejected'])
            ->latest()
            ->get();

        return view('super.events.index', compact('events')); 
    }

    /**
     * Menampilkan detail informasi event tertentu.
     */
    public function show($id)
    {
        $event = Event::with([
            'promoter',
            'galleries',
            'ticketTypes'
        ])->findOrFail($id);

        return view('super.events.show', compact('event'));
    }

    /**
     * Menyetujui pembuatan event oleh Promoter (Publish).
     */
    public function approve($id)
    {
        $event = Event::findOrFail($id);
        $event->update(['status' => 'approved']);

        // Mengalihkan kembali ke halaman detail dengan membawa pesan sukses ("Flash Message")
        return redirect()->back()->with('success', 'Selamat 🎉! Event "' . $event->title . '" telah berhasil disetujui.');
    }

    /**
     * Menolak pembuatan event oleh Promoter disertai alasan.
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string'
        ]);

        $event = Event::findOrFail($id);
        $event->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason
        ]);

        // Mengalihkan kembali ke halaman detail dengan membawa pesan sukses penolakan
        return redirect()->back()->with('success', 'Event telah berhasil ditolak dengan alasan yang dilampirkan.');
    }

    /**
     * Menghapus event beserta seluruh file gambar dan data turunannya.
     */
    public function destroy($id)
    {
        // Load event sekaligus relasi galeri agar tidak terjadi query N+1 saat looping file
        $event = Event::with('galleries')->findOrFail($id);

        try {
            DB::transaction(function () use ($event) {
                // 1. Hapus file poster utama di storage jika ada
                if ($event->poster_path && Storage::disk('public')->exists($event->poster_path)) {
                    Storage::disk('public')->delete($event->poster_path);
                }

                // 2. Hapus semua file gambar yang ada di galeri event dari storage
                foreach ($event->galleries as $gallery) {
                    if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
                        Storage::disk('public')->delete($gallery->image_path);
                    }
                }

                // 3. Eksekusi penghapusan data utama di database
                // Karena migrasi Anda sudah dikonfigurasi dengan ->cascadeOnDelete(),
                // data teks di tabel `ticket_types` dan `event_galleries` otomatis ikut terhapus oleh database.
                $event->delete();
            });

            return response()->json([
                'success' => true, 
                'message' => 'Event dan seluruh data terkait berhasil dihapus dari platform.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Gagal menghapus event: ' . $e->getMessage()
            ], 500);
        }
    }
}