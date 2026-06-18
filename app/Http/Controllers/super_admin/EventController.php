<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventGallery;
use App\Models\TicketType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        // Menyaring agar data DRAFT mutlak tidak masuk ke layar Super Admin
        $events = Event::with(['galleries', 'ticketTypes'])
            ->whereIn('status', ['pending', 'approved', 'rejected'])
            ->latest()
            ->get();

        return view('super.event.index', compact('events')); 
    }

    public function show($id)
{
    $event = Event::with([
        'promoter',
        'galleries',
        'ticketTypes'
    ])->findOrFail($id);

    return view('super.event.show', compact('event'));
}

    public function approve($id)
    {
        $event = Event::where('status', 'pending')->findOrFail($id);
        $event->update(['status' => 'approved']);

        return response()->json(['success' => true, 'message' => 'Status acara berhasil disetujui (Publish).']);
    }

    public function reject($id)
    {
        $event = Event::where('status', 'pending')->findOrFail($id);
        $event->update(['status' => 'rejected']);

        return response()->json(['success' => true, 'message' => 'Acara ditolak dipublikasikan.']);
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        try {
            DB::transaction(function () use ($event) {
                if ($event->poster_path) {
                    Storage::disk('public')->delete($event->poster_path);
                }
                $galleries = EventGallery::where('event_id', $event->id)->get();
                foreach ($galleries as $gallery) {
                    Storage::disk('public')->delete($gallery->image_path);
                    $gallery->delete();
                }
                TicketType::where('event_id', $event->id)->delete();
                $event->delete();
            });

            return response()->json(['success' => true, 'message' => 'Event berhasil dihapus dari platform.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus: ' . $e->getMessage()], 500);
        }
    }
}