<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Menampilkan semua daftar event untuk melihat rangkuman transaksi
     */
    public function index()
    {
        // 1. Ambil event yang statusnya BUKAN draft
        // 2. Optimasi hitungan tiket terjual langsung via subquery sum(quantity)
        // 3. Optimasi hitungan revenue langsung via subquery sum(total_amount) agar tidak terkena N+1 Query Issue
        $events = Event::where('status', '!=', 'draft')
            ->withCount(['orders as tickets_sold' => function($query) {
                $query->where('status', 'paid')->select(DB::raw('coalesce(sum(quantity), 0)'));
            }])
            ->withSum(['orders as revenue' => function($query) {
                $query->where('status', 'paid');
            }], 'total_amount')
            ->latest()
            ->get()
            ->map(function($event) {
                // Set default 0 jika null agar tampilan di Blade aman dari error
                $event->revenue = $event->revenue ?? 0;
                return $event;
            });

        return view('super.transactions.index', compact('events'));
    }

    /**
     * Menampilkan daftar transaksi tiket khusus untuk satu event tertentu
     */
    public function eventList($id)
    {
        // Pastikan event yang dicari bukan draft, jika draft/tidak ada langsung throw 404
        $event = Event::where('status', '!=', 'draft')->findOrFail($id);
        
        $orders = Order::with(['user']) 
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
        // Load relasi user dan event pembeli
        $order = Order::with(['user', 'event'])->findOrFail($id);

        return view('super.transactions.show', compact('order'));
    }
}