<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EventGallery;


class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('galleries')->latest()->get();

        return view('event', compact('events'));
        return response()->json([
            'success' => true,
            'data' => Event::all()
        ]);
    }

    public function show($id)
    {
        $event = Event::find($id);

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

    'ticket_price' => 'required|numeric|min:0',
    'ticket_quota' => 'required|integer|min:1',

    'terms_and_conditions' => 'required',

    'poster' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',

    'gallery' => 'nullable|array',
    'gallery.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',

]);
$posterPath = $request->file('poster')
    ->store('events/posters', 'public');

$validated['promoter_id'] = Auth::id();
$validated['poster_path'] = $posterPath;

$event = Event::create($validated);

if ($request->hasFile('gallery')) {

    foreach ($request->file('gallery') as $image) {

        $path = $image->store('events/gallery', 'public');

        EventGallery::create([
            'event_id' => $event->id,
            'image_path' => $path,
        ]);
    }
}

        return response()->json([
            'success' => true,
            'message' => 'Event created successfully',
            'data' => $event
        ], 201);
        
    }



    public function update(Request $request, $id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|max:150',
            'description' => 'sometimes',
            'ticket_price' => 'sometimes|numeric|min:0',
            'category' => 'sometimes|max:100',
            'ticket_quota' => 'sometimes|integer|min:1',
            'max_ticket_per_order' => 'required|integer|min:1',
            'poster_path' => 'sometimes|string',
            'terms_and_conditions' => 'sometimes',
            'status' => 'sometimes|in:pending,approved,rejected',
        ]);

        $event->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Event updated successfully',
            'data' => $event
        ]);
    }

    public function destroy($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found'
            ], 404);
        }

        $event->delete();

        return response()->json([
            'success' => true,
            'message' => 'Event deleted successfully'
        ]);
    }

    public function approve($id)
    {
        $event = Event::findOrFail($id);

        $event->update([
            'status' => 'approved'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Event approved successfully',
            'data' => $event
        ]);
    }

    public function reject($id)
    {
        $event = Event::findOrFail($id);

        $event->update([
            'status' => 'rejected'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Event rejected successfully',
            'data' => $event
        ]);
    }

}