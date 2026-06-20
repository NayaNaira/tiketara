<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penyelenggara - {{ $event ? $event->title : 'Semua Acara' }} ({{ $year }})</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.4;
            font-size: 12px;
            margin: 0;
            padding: 20px;
            background-color: #fff;
        }
        .header {
            border-bottom: 2px solid #222;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .header-title {
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0 0 5px 0;
        }
        .header-subtitle {
            font-size: 14px;
            color: #555;
            margin: 0 0 5px 0;
        }
        .header-meta {
            font-size: 11px;
            color: #777;
        }
        .logo-placeholder {
            float: right;
            font-size: 24px;
            font-weight: bold;
            color: #C9A84C;
            letter-spacing: 1px;
            margin-top: 10px;
        }
        .clear {
            clear: both;
        }
        .summary-box {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .summary-table {
            width: 100%;
            border-collapse: collapse;
        }
        .summary-table td {
            padding: 5px 10px;
        }
        .summary-value {
            font-size: 16px;
            font-weight: bold;
            color: #111;
        }
        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .table-data th {
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            padding: 8px;
            font-weight: bold;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
        }
        .table-data td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 11px;
        }
        .table-data tr:nth-child(even) {
            background-color: #fafafa;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .footer-sig {
            margin-top: 50px;
            float: right;
            width: 250px;
            text-align: center;
        }
        .signature-line {
            margin-top: 60px;
            border-top: 1px solid #333;
            padding-top: 5px;
            font-weight: bold;
        }
        @media print {
            body {
                padding: 0;
            }
            .no-print {
                display: none;
            }
            .page-break {
                page-break-before: always;
            }
        }
    </style>
</head>
<body>

    <!-- Print Action Trigger Button (Visual only in browser preview) -->
    <div class="no-print" style="margin-bottom: 20px; padding: 10px; background-color: #e2f0d9; border: 1px solid #a9d08e; border-radius: 4px; display: flex; justify-content: space-between; align-items: center;">
        <span style="color: #375623; font-weight: bold;">Dokumen Laporan Transaksi - Klik Cetak untuk menyimpan sebagai PDF</span>
        <button onclick="window.print()" style="background-color: #2e75b6; border: none; color: white; padding: 6px 12px; font-weight: bold; border-radius: 4px; cursor: pointer;">Cetak / Save PDF</button>
    </div>

    <div class="header">
        <div class="logo-placeholder">TIKETARA</div>
        <h1 class="header-title">Laporan Penjualan Tiket</h1>
        <h2 class="header-subtitle">Penyelenggara: {{ auth()->user()->name }}</h2>
        <div class="header-meta">
            Target Acara: <strong>{{ $event ? $event->title : 'Semua Acara/Konser' }}</strong> &nbsp;|&nbsp; 
            Tahun Periode: <strong>{{ $year }}</strong> &nbsp;|&nbsp; 
            Tanggal Cetak: <strong>{{ date('d-m-Y H:i') }}</strong>
        </div>
        <div class="clear"></div>
    </div>

    @php
        $totalRevenue = $orders->sum('total_amount');
        $totalTickets = $orders->sum('quantity');
        $totalTransactions = $orders->count();
    @endphp

    <div class="summary-box">
        <h3 style="margin-top: 0; margin-bottom: 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px;">Ringkasan Data Laporan</h3>
        <table class="summary-table">
            <tr>
                <td>Total Pendapatan Penjualan:</td>
                <td>Total Tiket Terjual:</td>
                <td>Total Transaksi Sukses:</td>
            </tr>
            <tr>
                <td class="summary-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td>
                <td class="summary-value">{{ number_format($totalTickets) }} Tiket</td>
                <td class="summary-value">{{ number_format($totalTransactions) }} Transaksi</td>
            </tr>
        </table>
    </div>

    <h3 style="margin-bottom: 10px;">Detail Transaksi Terdaftar</h3>
    <table class="table-data">
        <thead>
            <tr>
                <th style="width: 10%;">ID Order</th>
                <th style="width: 20%;">Nama Pembeli</th>
                <th style="width: 30%;">Nama Event / Konser</th>
                <th style="width: 10%;" class="text-center">Qty</th>
                <th style="width: 15%;" class="text-right">Total Pembayaran</th>
                <th style="width: 15%;" class="text-right">Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->user->name ?? 'N/A' }}</td>
                    <td>{{ $order->event->title ?? 'N/A' }}</td>
                    <td class="text-center">{{ $order->quantity }}</td>
                    <td class="text-right">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td class="text-right">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center" style="padding: 20px; color: #777; font-style: italic;">
                        Tidak ada data transaksi terekam untuk laporan ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="clear"></div>

    <div class="footer-sig">
        <div>Mengetahui,</div>
        <div style="font-weight: bold; margin-top: 5px;">Penyelenggara Acara</div>
        <div class="signature-line">
            {{ auth()->user()->name }}
        </div>
    </div>
    
    <div class="clear"></div>

</body>
</html>
