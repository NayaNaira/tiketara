<?php

namespace App\Http\Controllers\promoter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PromoterDashboardController extends Controller
{
    /**
     * Halaman Ringkasan/Dashboard Utama Promotor
     */
    public function summary()
    {
        $promoterId = Auth::id();

        // Ambil semua event milik promoter ini beserta relasinya
        $events = Event::with(['ticketTypes', 'orders'])
            ->where('promoter_id', $promoterId)
            ->orderBy('created_at', 'desc')
            ->get();

        // Hitung total pendapatan dari event milik promoter ini
        $totalRevenue = Order::whereHas('event', function ($q) use ($promoterId) {
            $q->where('promoter_id', $promoterId);
        })->where('status', 'paid')->sum('total_amount');

        // Hitung total tiket terjual
        $totalTickets = Order::whereHas('event', function ($q) use ($promoterId) {
            $q->where('promoter_id', $promoterId);
        })->where('status', 'paid')->sum('quantity');

        // Konser Aktif (Approved)
        $activeCount = Event::where('promoter_id', $promoterId)
            ->where('status', 'approved')
            ->count();

        // Pending
        $pendingCount = Event::where('promoter_id', $promoterId)
            ->where('status', 'pending')
            ->count();

        // Selesai (Approved & Tanggal Lewat)
        $completedCount = Event::where('promoter_id', $promoterId)
            ->where('status', 'approved')
            ->where('event_date', '<', now())
            ->count();

        // Mengambil semua order berstatus lunas (paid) untuk promoter ini agar penghitungan filter periode akurat (berdasarkan tanggal transaksi)
        $ordersJson = Order::whereHas('event', function ($q) use ($promoterId) {
            $q->where('promoter_id', $promoterId);
        })->where('status', 'paid')
          ->get(['created_at', 'total_amount', 'quantity'])
          ->map(function($order) {
              return [
                  'time' => $order->created_at->timestamp,
                  'revenue' => (float)$order->total_amount,
                  'quantity' => (int)$order->quantity
              ];
          })->toJson();

        return view('promoter.dashboard.summary', compact(
            'events',
            'totalRevenue',
            'totalTickets',
            'activeCount',
            'pendingCount',
            'completedCount',
            'ordersJson'
        ));
    }

    /**
     * Halaman Konfigurasi & Preview Laporan
     */
    public function reports(Request $request)
    {
        $promoterId = Auth::id();
        $year = $request->get('period_year', date('Y'));

        $events = Event::with(['ticketTypes', 'orders.user'])
            ->where('promoter_id', $promoterId)
            ->where('status', '!=', 'draft')
            ->orderBy('created_at', 'desc')
            ->get();

        $event = null;
        if ($request->has('event_id') && $request->get('event_id') != '') {
            $event = Event::with(['ticketTypes', 'orders.user'])->where('promoter_id', $promoterId)->find($request->get('event_id'));
        }

        // Hitung stats agregat untuk preview (Filtered by selected year!)
        $query = Order::whereHas('event', function ($q) use ($promoterId) {
            $q->where('promoter_id', $promoterId);
        })->where('status', 'paid')
          ->whereYear('created_at', $year);

        if ($event) {
            $query->where('events_id', $event->id);
        }

        $stats = [
            'total_revenue' => (clone $query)->sum('total_amount'),
            'total_tickets' => (clone $query)->sum('quantity'),
            'success_ratio' => 100
        ];

        // Hitung grafik bulanan penjualan tiket untuk preview (Filtered by selected year!)
        $monthlyData = [];
        $rawMonthlySales = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthQuery = Order::whereHas('event', function ($q) use ($promoterId) {
                $q->where('promoter_id', $promoterId);
            })->where('status', 'paid')
              ->whereYear('created_at', $year)
              ->whereMonth('created_at', $month);

            if ($event) {
                $monthQuery->where('events_id', $event->id);
            }

            $rawMonthlySales[] = $monthQuery->sum('quantity');
        }

        $maxSales = max($rawMonthlySales) > 0 ? max($rawMonthlySales) : 1;
        for ($month = 1; $month <= 12; $month++) {
            $count = $rawMonthlySales[$month - 1];
            $monthlyData[] = [
                'count' => $count,
                'percent' => ($count / $maxSales) * 100
            ];
        }

        // Query 10 orders terbaru sesuai filter tahun & event untuk menghindari N+1 query loop
        $ordersQuery = Order::with(['user', 'event'])
            ->whereHas('event', function ($q) use ($promoterId) {
                $q->where('promoter_id', $promoterId);
            })
            ->where('status', 'paid')
            ->whereYear('created_at', $year)
            ->latest('created_at')
            ->limit(10);

        if ($event) {
            $ordersQuery->where('events_id', $event->id);
        }

        $previewOrders = $ordersQuery->get();

        return view('promoter.dashboard.reports', compact('events', 'event', 'stats', 'monthlyData', 'previewOrders', 'year'));
    }

    /**
     * Aksi Unduh/Export Laporan
     */
    public function export(Request $request)
    {
        $promoterId = Auth::id();
        $format = $request->get('format', 'pdf');
        $year = $request->get('period_year', date('Y'));
        
        $event = null;
        if ($request->has('event_id') && $request->get('event_id') != '') {
            $event = Event::with(['ticketTypes', 'orders.user'])->where('promoter_id', $promoterId)->find($request->get('event_id'));
        }

        // Query orders sesuai filter
        $query = Order::with(['user', 'event'])
            ->whereHas('event', function ($q) use ($promoterId) {
                $q->where('promoter_id', $promoterId);
            })
            ->where('status', 'paid')
            ->whereYear('created_at', $year);

        if ($event) {
            $query->where('events_id', $event->id);
        }

        $orders = $query->get();

        // 🟢 EXCEL (.XLS)
        if ($format === 'xlsx') {
            $fileName = "Laporan_Penyelenggara_" . ($event ? str_replace(' ', '_', $event->title) : "Semua") . "_{$year}.xls";
            $headers = [
                "Content-Type"        => "application/vnd.ms-excel",
                "Content-Disposition" => "attachment; filename=\"$fileName\"",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            ];

            $callback = function () use ($orders) {
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

        // 🟡 CSV
        if ($format === 'csv') {
            $fileName = "Laporan_Penyelenggara_" . ($event ? str_replace(' ', '_', $event->title) : "Semua") . "_{$year}.csv";
            $headers = [
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=\"$fileName\"",
            ];

            $callback = function () use ($orders) {
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

        // 🔴 PDF
        return view('promoter.dashboard.pdf_template', compact('orders', 'year', 'event'));
    }
}
