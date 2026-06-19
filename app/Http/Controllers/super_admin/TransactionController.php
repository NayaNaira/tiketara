<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Event;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Menampilkan semua riwayat transaksi tiket di platform
     */
    public function index()
    {
        $orders = Order::with(['user', 'event', 'ticketType'])
            ->latest()
            ->paginate(10);

        return view('super.transactions.index', compact('orders'));
    }

    /**
     * Menampilkan daftar transaksi tiket khusus untuk satu event tertentu
     */
    public function eventList($id)
    {
        $event = Event::findOrFail($id);
        
        $orders = Order::with(['user', 'ticketType'])
            ->where('events_id', $id)
            ->latest()
            ->paginate(10);

        return view('super.transactions.list', compact('event', 'orders'));
    }

    /**
     * Menampilkan detail nota/invoice satu transaksi tertentu
     */
    public function show($id)
    {
        $order = Order::with(['user', 'event', 'ticketType'])
            ->findOrFail($id);

        return view('super.transactions.show', compact('order'));
    }
}