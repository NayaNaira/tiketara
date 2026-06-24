<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Order;
use App\Models\TicketType;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Halaman Dashboard Utama Super Admin (Ringkasan Data & Statistik)
     */
    public function summary()
    {
        $events = Event::with([
             'orders',
             'ticketTypes'
         ])
         ->whereNotIn('status', ['draft', 'DRAFT'])
         ->latest()
           ->get();
            
        $totalEvents = Event::where('status', '!=', 'draft')
            ->where('status', '!=', 'DRAFT')
            ->count();

        // Disamakan statusnya menggunakan 'paid' sesuai data transaksi lunas
        $totalOrders = Order::where('status', 'paid')->count();

        return view('super.summary.index', compact('events', 'totalEvents', 'totalOrders'));
    }

    /**
     * Halaman Laporan Keuangan Penjualan Tiket
     * PROTEKSI: Mencegah event berstatus DRAFT agar tidak muncul
     */
    public function reports()
    {
        $events = Event::with(['ticketTypes', 'orders'])
            ->where('status', '!=', 'draft')
            ->where('status', '!=', 'DRAFT')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('super.reports.index', compact('events'));
    }

    /**
     * Menampilkan Halaman Detail Laporan per Event Sebelum Diunduh
     */
  public function showReport($id)
{
    $event = Event::with(['ticketTypes', 'orders.user'])
        ->where('status', '!=', 'draft')
        ->where('status', '!=', 'DRAFT')
        ->findOrFail($id);

    $stats = [
        'total_revenue' => $event->orders
            ->where('status', 'paid')
            ->sum('total_amount'),

        'total_tickets' => $event->orders
            ->where('status', 'paid')
            ->sum('quantity'),

        'success_ratio' => 100
    ];

    // Grafik pendapatan bulanan khusus event
    $monthlyData = [];

    for ($month = 1; $month <= 12; $month++) {

        $revenue = Order::where('events_id', $event->id)
            ->where('status', 'paid')
            ->whereMonth('created_at', $month)
            ->whereYear(
                'created_at',
                \Carbon\Carbon::parse($event->event_date)->year
            )
            ->sum('total_amount');

        $monthlyData[] = $revenue;
    }

    $maxRevenue = max($monthlyData) ?: 1;

    $monthlyData = array_map(function ($value) use ($maxRevenue) {
        return round(($value / $maxRevenue) * 100, 2);
    }, $monthlyData);

    return view(
        'super.reports.export',
        compact('event', 'stats', 'monthlyData')
    );
}

    /**
     * Halaman Form Konfigurasi & Aksi Download Laporan Tahunan Global
     */
    public function export(Request $request)
    {
        $event = null;
        if ($request->has('event_id') && $request->get('event_id') != '') {
            $event = Event::with(['ticketTypes', 'orders.user'])->find($request->get('event_id'));
        }

        // JIKA TIDAK ADA PILIHAN FORMAT: Tampilkan halaman form konfigurasinya
        if (!$request->has('format')) {
            $currentYear = date('Y'); // Mengambil tahun berjalan (2026)

            // Ambil data agregat riil untuk dipajang di sisi 'Preview Laporan'
            $stats = [
                'total_revenue' => Order::where('status', 'paid')->sum('total_amount'),
                'total_tickets' => Order::where('status', 'paid')->sum('quantity'),
                'total_capacity' => TicketType::sum('quota'),
                'success_ratio' => 100 
            ];

            // 📊 PROSES MEMBUAT GRAFIK BULANAN DINAMIS (Januari - Desember)
            $monthlyData = [];
            for ($month = 1; $month <= 12; $month++) {
                // Hitung total tiket terjual di bulan terkait
                $totalTicketsMonth = Order::where('status', 'paid')
                    ->whereYear('created_at', $currentYear)
                    ->whereMonth('created_at', $month)
                    ->sum('quantity');
                    
                $monthlyData[] = $totalTicketsMonth;
            }

            // Cari angka penjualan tertinggi sebagai acuan skala tinggi grafik batang
            $maxSales = max($monthlyData) > 0 ? max($monthlyData) : 1;
            
            // Ubah data penjualan menjadi persentase skala (max 100%) agar tinggi CSS proporsional
            $monthlyData = array_map(function($value) use ($maxSales) {
                return ($value / $maxSales) * 100;
            }, $monthlyData);

            return view('super.reports.export', compact('stats', 'monthlyData', 'event'));
        }

        // JIKA TOMBOL DOWNLOAD DIKLIK (Proses Ekspor Berjalan)
        $format = $request->get('format', 'pdf');
        $year = $request->get('period_year', 2026);

        // Ambil data manifestasi transaksi lunas sesuai filter tahun
        $query = Order::with(['user', 'event'])
            ->where('status', 'paid')
            ->whereYear('created_at', $year);

        if ($event) {
            $query->where('events_id', $event->id);
        }

        $orders = $query->get();

        // 🟢 PROSES EKSPOR EXCEL (.XLS / .XLSX)
        if ($format === 'xlsx') {
            $fileName = "Laporan_Tiketara_Periode_{$year}.xls";
            $headers = [
                "Content-Type"        => "application/vnd.ms-excel",
                "Content-Disposition" => "attachment; filename=\"$fileName\"",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            ];

            $callback = function() use($orders) {
                echo "<table border='1'>";
                echo "<tr>
                        <th style='background-color:#f2f2f2;'>ID Order</th>
                        <th style='background-color:#f2f2f2;'>Nama Pembeli</th>
                        <th style='background-color:#f2f2f2;'>Nama Event / Konser</th>
                        <th style='background-color:#f2f2f2;'>Jumlah Tiket</th>
                        <th style='background-color:#f2f2f2;'>Total Pembayaran</th>
                        <th style='background-color:#f2f2f2;'>Tanggal Transaksi</th>
                      </tr>";

                foreach ($orders as $order) {
                    echo "<tr>";
                    echo "<td>#{$order->id}</td>";
                    echo "<td>" . ($order->user->name ?? 'N/A') . "</td>";
                    echo "<td>" . ($order->event->title ?? 'N/A') . "</td>";
                    echo "<td>{$order->quantity} Tiket</td>";
                    echo "<td>Rp " . number_format($order->total_amount, 0, ',', '.') . "</td>";
                    echo "<td>" . $order->created_at->format('Y-m-d H:i') . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            };

            return response()->stream($callback, 200, $headers);
        }

        // 🟡 PROSES EKSPOR CSV MURNI
        if ($format === 'csv') {
            $fileName = "Laporan_Tiketara_Periode_{$year}.csv";
            $headers = [
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=\"$fileName\"",
            ];

            $callback = function() use($orders) {
                $file = fopen('php://output', 'w');
                fputcsv($file, ['ID Order', 'Nama Pembeli', 'Nama Event / Konser', 'Jumlah Tiket', 'Total Pembayaran', 'Tanggal Transaksi']);

                foreach ($orders as $order) {
                    fputcsv($file, [
                        '#' . $order->id,
                        $order->user->name ?? 'N/A',
                        $order->event->title ?? 'N/A',
                        $order->quantity . ' Tiket',
                        'Rp ' . number_format($order->total_amount, 0, ',', '.'),
                        $order->created_at->format('Y-m-d H:i')
                    ]);
                }
                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }

        // 🔴 PROSES EKSPOR PDF (Trik Cetak Instan Windows Print)
        return view('super.reports.pdf_template', compact('orders', 'year', 'event'));
    }
}