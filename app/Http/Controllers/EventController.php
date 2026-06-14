<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventGallery;
use App\Models\TicketType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    // =========================
    // INDEX
    // =========================
    public function index()
    {
        $events = Event::with(['galleries', 'ticketTypes'])
            ->latest()
            ->get();

        return view('event', compact('events'));
    }

    // =========================
    // SHOW (API)
    // =========================
    public function show($id)
    {
        $event = Event::with(['galleries', 'ticketTypes'])->find($id);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $event
        ]);
    }

    // =========================
    // STORE EVENT
    // =========================
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

            'gallery' => 'nullable|array',
            'gallery.*' => 'image|max:2048',

            'ticket_name' => 'required|array',
            'ticket_name.*' => 'required|string',

            'ticket_type_price' => 'required|array',
            'ticket_type_price.*' => 'required|numeric',

            'ticket_type_quota' => 'required|array',
            'ticket_type_quota.*' => 'required|integer',

            'start_sale' => 'required|array',
            'end_sale' => 'required|array',
        ]);

        DB::transaction(function () use ($request, $validated) {

            // poster
            $posterPath = $request->file('poster')
                ->store('events/posters', 'public');

            $validated['poster_path'] = $posterPath;
            $validated['promoter_id'] = Auth::id();

            // create event
            $event = Event::create($validated);

            // gallery
            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $image) {
                    $path = $image->store('events/gallery', 'public');

                    EventGallery::create([
                        'event_id' => $event->id,
                        'image_path' => $path,
                    ]);
                }
            }

            // ticket types
            foreach ($request->ticket_name as $i => $name) {
                TicketType::create([
                    'event_id' => $event->id,
                    'name' => $name,
                    'price' => $request->ticket_type_price[$i],
                    'quota' => $request->ticket_type_quota[$i],
                    'sold' => 0,
                    'start_sale' => $request->start_sale[$i],
                    'end_sale' => $request->end_sale[$i],
                    'status' => 'active',
                ]);
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Event created successfully'
        ], 201);
    }

    // =========================
    // EDIT PAGE
    // =========================
    public function edit($id)
    {
        $events = Event::with(['galleries', 'ticketTypes'])
            ->latest()
            ->get();

        $editEvent = Event::with(['galleries', 'ticketTypes'])
            ->findOrFail($id);

        return view('event', compact('events', 'editEvent'));
    }

    // =========================
    // UPDATE EVENT
    // =========================
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|max:150',
            'description' => 'sometimes',
            'category' => 'sometimes',
            'max_ticket_per_order' => 'sometimes|integer|min:1',
            'terms_and_conditions' => 'sometimes',
            'status' => 'sometimes|in:pending,approved,rejected',
        ]);

        DB::transaction(function () use ($request, $event, $validated) {

            // update event basic data
            $event->update($validated);

            // =========================
            // POSTER UPDATE
            // =========================
            if ($request->hasFile('poster')) {

                if ($event->poster_path) {
                    Storage::disk('public')->delete($event->poster_path);
                }

                $path = $request->file('poster')
                    ->store('events/posters', 'public');

                $event->update([
                    'poster_path' => $path
                ]);
            }

            // =========================
            // GALLERY (ADD ONLY)
            // =========================
            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $file) {
                    $path = $file->store('events/gallery', 'public');

                    EventGallery::create([
                        'event_id' => $event->id,
                        'image_path' => $path
                    ]);
                }
            }

            // =========================
            // TICKET TYPES (REPLACE MODE)
            // =========================
            TicketType::where('event_id', $event->id)->delete();

            if ($request->filled('ticket_name')) {
                foreach ($request->ticket_name as $i => $name) {
                    TicketType::create([
                        'event_id' => $event->id,
                        'name' => $name,
                        'price' => $request->ticket_type_price[$i],
                        'quota' => $request->ticket_type_quota[$i],
                        'start_sale' => $request->start_sale[$i],
                        'end_sale' => $request->end_sale[$i],
                        'sold' => 0,
                        'status' => 'active',
                    ]);
                }
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Event updated successfully'
        ]);
    }

    // =========================
    // DELETE EVENT
    // =========================
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        DB::transaction(function () use ($event) {

            // delete poster
            if ($event->poster_path) {
                Storage::disk('public')->delete($event->poster_path);
            }

            // delete gallery files + db
            foreach ($event->galleries as $gallery) {
                Storage::disk('public')->delete($gallery->image_path);
                $gallery->delete();
            }

            // delete ticket types
            TicketType::where('event_id', $event->id)->delete();

            // delete event
            $event->delete();
        });

        return response()->json([
            'success' => true,
            'message' => 'Event deleted successfully'
        ]);
    }

    // =========================
    // APPROVE
    // =========================
    public function approve($id)
    {
        $event = Event::findOrFail($id);

        $event->update([
            'status' => 'approved'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Event approved successfully'
        ]);
    }

    // =========================
    // REJECT
    // =========================
    public function reject($id)
    {
        $event = Event::findOrFail($id);

        $event->update([
            'status' => 'rejected'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Event rejected successfully'
        ]);
    }

    // =========================
    // DELETE SINGLE GALLERY
    // =========================
    public function deleteGallery($id)
    {
        $gallery = EventGallery::findOrFail($id);

        Storage::disk('public')->delete($gallery->image_path);

        $gallery->delete();

        return response()->json([
            'success' => true
        ]);
    }
}