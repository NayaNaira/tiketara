<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan Tiketara - {{ $year }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #222;
            margin: 0;
            padding: 30px;
            font-size: 13px;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px double #111;
            padding-bottom: 15px;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
            color: #041830;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .header p {
            margin: 5px 0 0 0;
            font-size: 13px;
            color: #555;
        }
        .meta-info {
            margin-bottom: 25px;
            width: 100%;
        }
        .meta-info td {
            border: none;
            padding: 4px 0;
        }
        .summary-boxes {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }
        .card {
            flex: 1;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 12px;
            background-color: #f9f9f9;
            text-align: center;
        }
        .card-title {
            font-size: 10px;
            text-transform: uppercase;
            color: #666;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .card-value {
            font-size: 16px;
            font-weight: bold;
            color: #041830;
        }
        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #041830;
            margin-bottom: 10px;
            border-left: 4px solid #C9A84C;
            padding-left: 8px;
            text-transform: uppercase;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #dbdbdb;
            padding: 10px 12px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #fafafa;
        }
        .text-right {
            text-align: right;
        }
        .footer {
            margin-top: 60px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
            font-size: 10px;
            color: #777;
            text-align: center;
        }
        
        /* Mengatur agar saat dicetak ke PDF/Kertas, tombol/elemen tidak penting tidak ikut ter-render */
        @media print {
            .no-print {
                display: none;
            }
            body {
                padding: 0;
            }
        }
    </style>
</head>
<body onload="window.print();">

    <div class="header">
        <h1>Laporan Rekapitulasi Penjualan Platform</h1>
        <p>Sistem Management Database Finansial &bull; <strong>TIKETARA</strong></p>
    </div>

    <table class="meta-info">
        <tr>
            <td style="width: 15%;"><strong>Periode Rekap</strong></td>
            <td style="width: 35%;">: Tahunan (Tahun Rekap {{ $year }})</td>
            <td style="width: 15%;"><strong>Tanggal Cetak</strong></td>
            <td style="width: 35%;">: {{ date('d F Y H:i') }} WIB</td>
        </tr>
        <tr>
            <td><strong>Otoritas Dokumen</strong></td>
            <td>: Konsol Admin Utama (Super Admin)</td>
            <td><strong>Status Berkas</strong></td>
            <td>: Terverifikasi Sistem Finansial</td>
        </tr>
    </table>

    <div class="summary-boxes">
        <div class="card">
            <div class="card-title">Total Pendapatan Kotor</div>
            <div class="card-value">Rp {{ number_format($orders->sum('total_amount'), 0, ',', '.') }}</div>
        </div>
        <div class="card">
            <div class="card-title">Volume Tiket Terjual</div>
            <div class="card-value">{{ $orders->sum('quantity') }} Tiket</div>
        </div>
        <div class="card">
            <div class="card-title">Total Invoice Berhasil</div>
            <div class="card-value">{{ $orders->count() }} Transaksi</div>
        </div>
    </div>

    <div class="section-title">Rincian Transaksi Manifes Pembeli</div>
    <table>
        <thead>
            <tr>
                <th style="width: 12%;">ID Order</th>
                <th style="width: 23%;">Nama Pelanggan</th>
                <th style="width: 30%;">Konser / Event Event</th>
                <th style="width: 15%;">Kuantitas</th>
                <th style="width: 20%;" class="text-right">Total Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->user->name ?? 'N/A' }}</td>
                    <td>{{ $order->event->title ?? 'N/A' }}</td>
                    <td>{{ $order->quantity }} Lembar</td>
                    <td class="text-right">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #999; padding: 30px;">
                        Tidak ditemukan riwayat data transaksi penjualan yang sah untuk periode tahun {{ $year }}.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Seluruh rincian data di atas dihasilkan secara komputerisasi langsung melalui server utama Tiketara.<br>
        Dokumen ini sah digunakan sebagai arsip digital internal platform.
    </div>

</body>
</html>