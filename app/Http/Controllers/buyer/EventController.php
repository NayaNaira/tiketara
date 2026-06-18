<?php

namespace App\Http\Controllers\buyer;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with(['galleries', 'ticketTypes'])
            ->where('status', 'approved')
            ->latest()
            ->get();

        return view('buyer.event.index', compact('events')); 
    }

    public function show($id)
    {
        $event = Event::with(['galleries', 'ticketTypes'])
            ->where('status', 'approved')
            ->findOrFail($id);

        return view('buyer.event.show', compact('event'));
    }
}