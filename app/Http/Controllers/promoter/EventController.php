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

        return view('promoter.events.index', compact('events')); 
    }

    public function create()
    {
        return view('promoter.events.create');
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
            // Validasi array untuk tiket
            'ticket_name' => 'required|array',
            'ticket_name.*' => 'required|string',
            'ticket_type_price.*' => 'required|numeric|min:0',
        ]);

        try {
            DB::transaction(function () use ($request, $validated) {
                // 1. Simpan Poster & Event
                $posterPath = $request->file('poster')->store('events/posters', 'public');
                $validated['poster_path'] = $posterPath;
                $validated['promoter_id'] = Auth::id();
                $validated['status'] = 'draft';

                $event = Event::create($validated);

                // 2. Simpan Tiket (Looping berdasarkan array)
                if ($request->has('ticket_name')) {
                    foreach ($request->ticket_name as $index => $name) {
                        TicketType::create([
                            'event_id' => $event->id,
                            'name' => $name,
                            'price' => $request->ticket_type_price[$index],
                            'quota' => $request->ticket_type_quota[$index],
                            'start_sale' => $request->start_sale[$index],
                            'end_sale' => $request->end_sale[$index],
                        ]);
                    }
                }

                // 3. Simpan Gallery (Jika ada multiple upload)
                if ($request->hasFile('gallery')) {
                    foreach ($request->file('gallery') as $image) {
                        $path = $image->store('events/galleries', 'public');
                        EventGallery::create([
                            'event_id' => $event->id,
                            'image_path' => $path,
                        ]);
                    }
                }
            });

            // Ganti JSON ke Redirect agar form HTML kembali ke tampilan web
            return redirect()->route('promoter.event.index')->with('success', 'Draft event beserta tiket berhasil dibuat.');
        } catch (\Exception $e) {
            // Kalau gagal, kembalikan ke form beserta errornya
            return back()->withInput()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $editEvent = Event::where('promoter_id', Auth::id())->findOrFail($id);

        // KUNCI AKSES
        if ($editEvent->status !== 'draft') {
            abort(403, 'Event yang sudah berstatus pending/approved/rejected tidak dapat diubah.');
        }

        return view('promoter.events.edit', compact('editEvent'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::where('promoter_id', Auth::id())->findOrFail($id);

        // KUNCI AKSES (BACKEND SECURITY)
        if ($event->status !== 'draft') {
            return back()->withErrors(['error' => 'Event ini sudah dikunci dan tidak bisa diedit.']);
        }

        // ==========================================
        // FITUR "AJUKAN" (Ubah status dari draft -> pending)
        // ==========================================
        if ($request->has('status') && $request->get('status') === 'pending' && !$request->has('title')) {
            $event->update(['status' => 'pending']);
            return back()->with('success', 'Event berhasil diajukan ke Admin untuk di-review.');
        }

        // ==========================================
        // FITUR "UPDATE FORM EDIT"
        // ==========================================
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
            'poster' => 'nullable|image|max:2048',
            // Validasi array untuk tiket
            'ticket_name' => 'required|array',
            'ticket_name.*' => 'required|string',
            'ticket_type_price.*' => 'required|numeric|min:0',
        ]);

        try {
            DB::transaction(function () use ($request, $event, $validated) {
                $updateData = $request->except(['_token', '_method', 'poster', 'ticket_name', 'ticket_type_price', 'ticket_type_quota', 'start_sale', 'end_sale', 'gallery', 'artist_dummy', 'genre_dummy']);
                
                // 1. Update Poster jika ada file baru
                if ($request->hasFile('poster')) {
                    if ($event->poster_path) Storage::disk('public')->delete($event->poster_path);
                    $updateData['poster_path'] = $request->file('poster')->store('events/posters', 'public');
                }

                $event->update($updateData);

                // 2. Update TicketTypes (Hapus yang lama, simpan yang baru dari form)
                if ($request->has('ticket_name')) {
                    $event->ticketTypes()->delete();
                    foreach ($request->ticket_name as $index => $name) {
                        TicketType::create([
                            'event_id' => $event->id,
                            'name' => $name,
                            'price' => $request->ticket_type_price[$index],
                            'quota' => $request->ticket_type_quota[$index],
                            'start_sale' => $request->start_sale[$index],
                            'end_sale' => $request->end_sale[$index],
                        ]);
                    }
                }

                // 3. Tambah foto ke Gallery lama jika ada
                if ($request->hasFile('gallery')) {
                    foreach ($request->file('gallery') as $image) {
                        $path = $image->store('events/galleries', 'public');
                        EventGallery::create([
                            'event_id' => $event->id,
                            'image_path' => $path,
                        ]);
                    }
                }
            });

            return redirect()->route('promoter.event.index')->with('success', 'Draft Event berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Gagal mengupdate data: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $event = Event::where('promoter_id', Auth::id())->findOrFail($id);

        if ($event->status !== 'draft') {
            return back()->withErrors(['error' => 'Hanya event dengan status draft yang dapat dihapus.']);
        }

        try {
            DB::transaction(function () use ($event) {
                // Hapus ticket types
                $event->ticketTypes()->delete();

                // Hapus gallery files & records
                foreach ($event->galleries as $gallery) {
                    Storage::disk('public')->delete($gallery->image_path);
                    $gallery->delete();
                }

                // Hapus poster file
                if ($event->poster_path) {
                    Storage::disk('public')->delete($event->poster_path);
                }

                // Hapus event
                $event->delete();
            });

            return redirect()->route('promoter.event.index')->with('success', 'Draft event berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus event: ' . $e->getMessage()]);
        }
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
