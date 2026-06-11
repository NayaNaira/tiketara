<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\TicketType;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    public function index()
    {
        $events = Event::all();

        $ticketTypes = TicketType::with('event')->get();

        return view('ticket-types', compact(
            'events',
            'ticketTypes'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required',
            'price' => 'required|numeric',
            'quota' => 'required|integer',
            'start_sale' => 'required',
            'end_sale' => 'required',
        ]);

        $validated['sold'] = 0;
        $validated['status'] = 'active';

        TicketType::create($validated);

        return redirect()
            ->back()
            ->with('success', 'Ticket Type created');
    }
}