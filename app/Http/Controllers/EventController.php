<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
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
            'promoter_id' => 'required|exists:users,id',
            'title' => 'required|max:150',
            'description' => 'required',
            'ticket_price' => 'required|numeric|min:0',
            'category' => 'required|max:100',
            'ticket_quota' => 'required|integer|min:1',
            'poster_url' => 'required|string',
            'terms_and_conditions' => 'required',
        ]);

        $event = Event::create($validated);

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
            'poster_url' => 'sometimes|string',
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