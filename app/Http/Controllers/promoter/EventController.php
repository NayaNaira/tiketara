<?php

namespace App\Http\Controllers\promoter;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventGallery;
use App\Models\TicketType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        // Promoter hanya melihat event miliknya sendiri
        $events = Event::with(['galleries', 'ticketTypes'])
            ->where('promoter_id', Auth::id())
            ->latest()
            ->get();

        return view('promoter.event.index', compact('events')); 
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:150',
            'description' => 'required',
            'category' => 'required',
            'venue_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'event_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'max_ticket_per_order' => 'required|integer|min:1',
            'terms_and_conditions' => 'required',
            'poster' => 'required|image|max:2048',
        ]);

        try {
            DB::transaction(function () use ($request, $validated) {
                $posterPath = $request->file('poster')->store('events/posters', 'public');
                $validated['poster_path'] = $posterPath;
                $validated['promoter_id'] = Auth::id();
                $validated['status'] = 'draft'; // Sesuai permintaan: default berstatus draft saat dibuat

                $event = Event::create($validated);
                // Tambahkan perulangan tiket & gallery bawaan Anda di sini jika ada...
            });

            return response()->json(['success' => true, 'message' => 'Draft event berhasil dibuat.'], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        $editEvent = Event::where('promoter_id', Auth::id())->findOrFail($id);

        // KUNCI AKSES: Jika sudah diajukan ke admin, tidak boleh diedit lagi
        if ($editEvent->status !== 'draft') {
            abort(403, 'Event yang sudah berstatus pending/approved/rejected tidak dapat diubah.');
        }

        return view('promoter.event.edit', compact('editEvent'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::where('promoter_id', Auth::id())->findOrFail($id);

        // KUNCI AKSES (BACKEND SECURITY)
        if ($event->status !== 'draft') {
            return response()->json(['success' => false, 'message' => 'Event ini sudah dikunci dan tidak bisa diedit.'], 403);
        }

        // Jalankan logika transaksi update data, ticketTypes, dan gallery bawaan Anda di sini
        // ...
        return response()->json(['success' => true, 'message' => 'Draft Event berhasil diperbarui.']);
    }

    public function deleteGallery($id)
    {
        $gallery = EventGallery::findOrFail($id);
        $event = Event::findOrFail($gallery->event_id);

        if ($event->promoter_id !== Auth::id() || $event->status !== 'draft') {
            return response()->json(['success' => false, 'message' => 'Akses ditolak.'], 403);
        }

        Storage::disk('public')->delete($gallery->image_path);
        $gallery->delete();

        return response()->json(['success' => true, 'message' => 'Foto gallery terhapus.']);
    }
}