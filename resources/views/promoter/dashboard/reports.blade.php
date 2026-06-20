@extends('layouts.promoter')
@section('title', 'Export Laporan')

@section('content')
<header class="p-4 lg:p-8 pb-2 lg:pb-4">
    <h1 class="text-2xl font-bold text-[#C9A84C] mb-1">Export Laporan</h1>
    <p class="text-sm text-[#4A9FD4]">Konfigurasi filter dan unduh rekapitulasi data penjualan tiket Anda</p>
</header>

<div class="flex-1 p-4 lg:p-8 lg:pt-0 pt-0 overflow-y-auto">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        {{-- LEFT PANEL: Configuration & Filters --}}
        <div class="lg:col-span-4 bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6 space-y-6">
            <h2 class="text-white font-bold text-sm uppercase tracking-wider border-b border-[#202020] pb-2 text-gold">
                <i class="fa-solid fa-sliders mr-2"></i> Konfigurasi Laporan
            </h2>

            <form action="{{ route('promoter.reports') }}" method="GET" id="report-filter-form" class="space-y-4 m-0">
                {{-- Event Select --}}
                <div>
                    <label class="block text-xs font-semibold text-[#DADADA] mb-2 uppercase tracking-wider">Pilih Acara / Konser</label>
                    <select name="event_id" onchange="this.form.submit()" class="w-full bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-[#C9A84C] cursor-pointer">
                        <option value="">Semua Acara</option>
                        @foreach($events as $ev)
                            <option value="{{ $ev->id }}" {{ request('event_id') == $ev->id ? 'selected' : '' }}>
                                {{ $ev->title }} ({{ ucfirst($ev->status) }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Year Select --}}
                <div>
                    <label class="block text-xs font-semibold text-[#DADADA] mb-2 uppercase tracking-wider">Tahun Laporan</label>
                    <select name="period_year" onchange="this.form.submit()" class="w-full bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-[#C9A84C] cursor-pointer">
                        @php
                            $currentYear = (int)date('Y');
                        @endphp
                        @for($y = $currentYear; $y >= $currentYear - 3; $y--)
                            <option value="{{ $y }}" {{ request('period_year', $currentYear) == $y ? 'selected' : '' }}>
                                Tahun {{ $y }}
                            </option>
                        @endfor
                    </select>
                </div>
            </form>

            {{-- Export Buttons --}}
            <div class="space-y-3 pt-4 border-t border-[#202020]">
                <label class="block text-xs font-semibold text-[#DADADA] mb-2 uppercase tracking-wider">Format Unduhan</label>
                
                @php
                    $exportParams = [
                        'event_id' => request('event_id'),
                        'period_year' => request('period_year', date('Y'))
                    ];
                @endphp

                {{-- Excel --}}
                <a href="{{ route('promoter.reports.export', array_merge($exportParams, ['format' => 'xlsx'])) }}" 
                   class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2.5 px-4 rounded-lg text-xs flex items-center justify-center gap-2 transition cursor-pointer">
                    <i class="fa-regular fa-file-excel text-lg"></i> Unduh Excel (.XLS)
                </a>

                {{-- CSV --}}
                <a href="{{ route('promoter.reports.export', array_merge($exportParams, ['format' => 'csv'])) }}" 
                   class="w-full bg-[#4A9FD4] hover:bg-[#3d8dbf] text-white font-bold py-2.5 px-4 rounded-lg text-xs flex items-center justify-center gap-2 transition cursor-pointer">
                    <i class="fa-solid fa-file-csv text-lg"></i> Unduh CSV (.CSV)
                </a>

                {{-- PDF --}}
                <a href="{{ route('promoter.reports.export', array_merge($exportParams, ['format' => 'pdf'])) }}" target="_blank"
                   class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 px-4 rounded-lg text-xs flex items-center justify-center gap-2 transition cursor-pointer">
                    <i class="fa-regular fa-file-pdf text-lg"></i> Unduh PDF / Cetak Laporan (.PDF)
                </a>
            </div>
        </div>

        {{-- RIGHT PANEL: Live Preview Pane --}}
        <div class="lg:col-span-8 space-y-6">
            {{-- Preview Title Card --}}
            <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6">
                <div class="flex items-center justify-between border-b border-[#202020] pb-3 mb-4">
                    <div>
                        <span class="text-[10px] text-[#4A9FD4] font-bold uppercase tracking-wider">Preview Laporan</span>
                        <h2 class="text-white font-bold text-lg leading-tight">
                            {{ $event ? $event->title : 'Semua Acara Penyelenggara' }}
                        </h2>
                    </div>
                    <span class="text-xs text-[#DADADA] font-semibold bg-[#020D1A] px-3 py-1 rounded-md border border-[#4A9FD4]/20">
                        Periode: {{ request('period_year', date('Y')) }}
                    </span>
                </div>

                {{-- Stats cards in preview --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                    <div class="bg-[#020D1A] border border-[#4A9FD4]/20 p-4 rounded-lg">
                        <span class="text-[10px] text-gray-500 font-bold uppercase tracking-wider block mb-1">Total Penjualan Kotor</span>
                        <span class="text-lg font-bold text-[#C9A84C]">Rp {{ number_format($stats['total_revenue'] ?? 0, 0, ',', '.') }}</span>
                    </div>
                    <div class="bg-[#020D1A] border border-[#4A9FD4]/20 p-4 rounded-lg">
                        <span class="text-[10px] text-gray-500 font-bold uppercase tracking-wider block mb-1">Tiket Terdistribusi</span>
                        <span class="text-lg font-bold text-[#C9A84C]">{{ number_format($stats['total_tickets'] ?? 0, 0, ',', '.') }} Tiket</span>
                    </div>
                </div>

                {{-- Sales Distribution Chart Preview --}}
                <div>
                    <h3 class="text-white font-bold text-xs uppercase tracking-wider mb-4"><i class="fa-solid fa-chart-simple mr-1 text-[#C9A84C]"></i> Distribusi Penjualan Tiket Bulanan</h3>
                    <div class="bg-[#020D1A] border border-[#4A9FD4]/20 rounded-lg p-5">
                        <div class="flex items-end justify-between gap-2 h-36 pt-2">
                            @php
                                $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
                            @endphp
                            @foreach($monthlyData as $idx => $percent)
                                <div class="flex-1 flex flex-col items-center group relative h-full justify-end">
                                    {{-- Tooltip info --}}
                                    <div class="absolute bottom-full mb-1 bg-black text-white text-[9px] rounded py-0.5 px-1.5 opacity-0 group-hover:opacity-100 transition whitespace-nowrap z-10 pointer-events-none border border-[#4A9FD4]/20 shadow-md">
                                        {{ round($percent) }}% Sales Max
                                    </div>
                                    {{-- Bar --}}
                                    <div class="w-full bg-[#4A9FD4] hover:bg-[#C9A84C] rounded-t transition-all duration-500" style="height: {{ max($percent, 3) }}%"></div>
                                    <span class="text-[9px] text-gray-500 mt-2 font-medium">{{ $months[$idx] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Transactions Table Preview --}}
            <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6">
                <h3 class="text-white font-bold text-xs uppercase tracking-wider mb-4"><i class="fa-solid fa-list-check mr-1 text-[#C9A84C]"></i> Sampel Transaksi Terakhir (Maks. 10 Data)</h3>
                
                <div class="overflow-x-auto rounded-lg border border-[#4A9FD4]/20">
                    <table class="w-full text-left text-xs whitespace-nowrap">
                        <thead>
                            <tr class="bg-[#020D1A] text-gray-400 border-b border-[#202020] uppercase font-semibold">
                                <th class="p-3">ID Order</th>
                                <th class="p-3">Pembeli</th>
                                <th class="p-3">Konser</th>
                                <th class="p-3 text-center">Qty</th>
                                <th class="p-3 text-right">Total Bayar</th>
                                <th class="p-3 text-right">Tanggal Transaksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#202020] text-[#DADADA]">
                            @php
                                $previewOrders = $event 
                                    ? $event->orders->where('status', 'paid') 
                                    : $events->flatMap(function($e) { return $e->orders; })->where('status', 'paid');
                                
                                $previewOrders = $previewOrders->sortByDesc('created_at')->take(10);
                            @endphp

                            @forelse($previewOrders as $order)
                                <tr class="hover:bg-[#020D1A]/40 transition">
                                    <td class="p-3 font-semibold text-[#4A9FD4]">#{{ $order->id }}</td>
                                    <td class="p-3 font-bold text-white">{{ $order->user->name ?? 'N/A' }}</td>
                                    <td class="p-3 truncate max-w-[150px]">{{ $order->event->title ?? 'N/A' }}</td>
                                    <td class="p-3 text-center font-semibold">{{ $order->quantity }}</td>
                                    <td class="p-3 text-right font-bold text-[#C9A84C]">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                    <td class="p-3 text-right text-gray-500">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-6 text-center text-gray-500 italic bg-[#020D1A]/10">
                                        Tidak ada transaksi penjualan terekam untuk filter ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
