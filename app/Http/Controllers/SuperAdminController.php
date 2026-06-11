<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Order;
class SuperAdminController extends Controller
{
    public function summary()
    {
        $events = Event::orderBy('created_at', 'desc')->take(5)->get();
        return view('super.summary.index', compact('events'));
    }

    public function events()
    {
        $events = Event::orderBy('created_at', 'desc')->get();
        return view('super.events.index', compact('events'));
    }

    public function eventDetail($id)
    {
        $event = Event::find($id) ?? new Event([
            'id' => 1,
            'title' => 'SZA SOS World Tour 2026',
            'category' => 'R&B',
            'venue_name' => 'Indonesia Arena GBK',
            'city' => 'Jakarta Selatan',
            'ticket_quota' => 25000
        ]);
        return view('super.events.show', compact('event'));
    }

    public function transactions()
    {
        $transactions = [];
        return view('super.transactions.index', compact('transactions'));
    }

    public function transactionDetail($id)
    {
        return view('super.transactions.show');
    }

    public function reports()
    {
        $events = Event::orderBy('created_at', 'desc')->get();
        return view('super.reports.index', compact('events'));
    }

    public function export()
    {
        return view('super.reports.export');
    }
}
