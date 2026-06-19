<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Order;

class DashboardController extends Controller
{
    /**
     * Halaman Dashboard Utama Super Admin (Ringkasan Data & Statistik)
     */
    public function summary()
    {
        // Ambil 5 event terbaru untuk widget komponen visual
        $events = Event::where('status', '!=', 'draft')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        // Menghitung total pendapatan, total tiket terjual, dll.
        $totalEvents = Event::where('status', '!=', 'draft')->count();
        $totalOrders = Order::where('status', 'success')->count();

        return view('super.summary.index', compact('events', 'totalEvents', 'totalOrders'));
    }

    /**
     * Halaman Laporan Keuangan Penjualan Tiket
     */
    public function reports()
    {
        $events = Event::with(['ticketTypes'])->orderBy('created_at', 'desc')->get();
        return view('super.reports.index', compact('events'));
    }

    /**
     * Aksi Cetak / Download Laporan Keuangan
     */
    public function export()
    {
        return view('super.reports.export');
    }
}