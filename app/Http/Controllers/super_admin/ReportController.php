<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Event;

class ReportController extends Controller
{
    public function index()
    {
        // Data statistik yang tampil di preview ringkasan halaman utama
        $stats = [
            'total_revenue' => Order::where('status', 'paid')->sum('total_amount'),
            'total_tickets' => Order::where('status', 'paid')->sum('quantity'),
            'success_ratio' => 100 // atau sesuaikan rumus persentase targetmu
        ];

        return view('super.report.index', compact('stats'));
    }

    public function export(Request $request)
    {
        $format = $request->get('format', 'pdf');
        $year = $request->get('period_year', 2026);

        // Tarik data order yang sukses lunas berdasarkan tahun filter
        $orders = Order::with(['user', 'event'])
            ->where('status', 'paid')
            ->whereYear('created_at', $year)
            ->get();

        // 🟢 JIKA USER MEMILIH FORMAT CSV / EXCEL
        if ($format === 'csv' || $format === 'xlsx') {
            $fileName = "Laporan_Tiketara_{$year}.csv";
            $headers = [
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            ];

            $columns = ['ID Order', 'Nama Pembeli', 'Event', 'Jumlah Tiket', 'Total Bayar', 'Tanggal'];

            $callback = function() use($orders, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach ($orders as $order) {
                    fputcsv($file, [
                        $order->id,
                        $order->user->name ?? 'N/A',
                        $order->event->title ?? 'N/A',
                        $order->quantity,
                        $order->total_amount,
                        $order->created_at->format('Y-m-d H:i')
                    ]);
                }
                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }

        // 🔴 JIKA USER MEMILIH FORMAT PDF (Gunakan Trik Lembar Cetak Print CSS)
        return view('super.report.pdf_template', compact('orders', 'year'));
    }
}