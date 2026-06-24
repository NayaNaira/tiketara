@extends('layouts.admin')
@section('title', 'Ringkasan')

@section('content')
<header class="p-4 lg:p-8 pb-2 lg:pb-4">
    <h1 class="text-2xl font-bold text-[#C9A84C] mb-1">Ringkasan Acara</h1>
    <p class="text-sm text-[#4A9FD4]">Kelola semua acara yang terdaftar di platform</p>
</header>

<div class="flex-1 p-4 lg:p-8 lg:pt-0 pt-0 overflow-y-auto">
    {{-- Ambil seluruh data mentah untuk diserahkan ke penampung data-attribute HTML --}}
    @php
        function formatShortAmount($amount) {
            if ($amount >= 1000000000) {
                return 'Rp ' . round($amount / 1000000000, 1) . 'B';
            } elseif ($amount >= 1000000) {
                return 'Rp ' . round($amount / 1000000, 1) . 'M';
            }
            return 'Rp ' . number_format($amount, 0, ',', '.');
        }
    @endphp

    <!-- Kelompok Filter Tombol Periode Aktif -->
    <div class="flex flex-wrap gap-2 mb-6 items-center bg-[#041830] p-3 rounded-xl border border-[#4A9FD4]/30">
        <span class="text-[#DADADA] text-sm mr-2 font-medium">Periode:</span>
        <button onclick="filterPeriode('today', this)" class="period-btn px-4 py-1.5 rounded-full text-xs font-medium border border-[#4A9FD4] text-[#4A9FD4] hover:bg-[#4A9FD4]/10 transition">Hari ini</button>
        <button onclick="filterPeriode('7days', this)" class="period-btn px-4 py-1.5 rounded-full text-xs font-medium border border-[#4A9FD4] text-[#4A9FD4] hover:bg-[#4A9FD4]/10 transition">7 Hari</button>
        <button onclick="filterPeriode('30days', this)" class="period-btn px-4 py-1.5 rounded-full text-xs font-medium border border-[#4A9FD4] text-[#4A9FD4] hover:bg-[#4A9FD4]/10 transition">30 Hari</button>
        <button onclick="filterPeriode('3months', this)" class="period-btn px-4 py-1.5 rounded-full text-xs font-medium border border-[#4A9FD4] text-[#4A9FD4] hover:bg-[#4A9FD4]/10 transition">3 Bulan</button>
        <button onclick="filterPeriode('all', this)" class="period-btn px-4 py-1.5 rounded-full text-xs font-semibold bg-white text-black transition">1 Tahun (Semua)</button>
        
        <div class="ml-auto flex items-center gap-2 bg-white text-black text-xs font-medium rounded-md py-1.5 px-3 cursor-pointer">
            <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <span id="labelRentang">Jan 2026 - Des 2026</span>
        </div>
    </div>

    {{-- COUNTER CARDS UTAMA --}}
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
        <div class="bg-[#041830] rounded-xl p-4 border border-[#4A9FD4]/30">
            <p class="text-[#DADADA] text-xs font-medium mb-2">Total Pendapatan</p>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-[#C9A84C]/10 flex items-center justify-center text-[#C9A84C]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 id="statRevenue" class="text-xl font-bold text-[#C9A84C] whitespace-nowrap">Rp 0</h3>
            </div>
        </div>
        <div class="bg-[#041830] rounded-xl p-4 border border-[#4A9FD4]/30">
            <p class="text-[#DADADA] text-xs font-medium mb-2">Total Tiket Terjual</p>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-[#C9A84C]/10 flex items-center justify-center text-[#C9A84C]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-[#C9A84C]"><span id="statTickets">0</span> <span class="text-sm font-normal text-gray-400">tiket</span></h3>
            </div>
        </div>
        <div class="bg-[#041830] rounded-xl p-4 border border-[#4A9FD4]/30">
            <p class="text-[#DADADA] text-xs font-medium mb-2">Jumlah Konser Aktif</p>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-gray-500/10 flex items-center justify-center text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-[#C9A84C]"><span id="statActive">0</span> <span class="text-sm font-normal text-gray-400">konser</span></h3>
            </div>
        </div>
        <div class="bg-[#041830] rounded-xl p-4 border border-[#4A9FD4]/30">
            <p class="text-[#DADADA] text-xs font-medium mb-2">Pending</p>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-yellow-500/10 flex items-center justify-center text-yellow-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-[#C9A84C]"><span id="statPending">0</span> <span class="text-sm font-normal text-gray-400">konser</span></h3>
            </div>
        </div>
        <div class="bg-[#041830] rounded-xl p-4 border border-[#4A9FD4]/30">
            <p class="text-[#DADADA] text-xs font-medium mb-2">Konser Selesai</p>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-green-500/10 flex items-center justify-center text-green-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-[#C9A84C]"><span id="statCompleted">0</span> <span class="text-sm font-normal text-gray-400">konser</span></h3>
            </div>
        </div>
    </div>

    {{-- KONTEN GRAFIK PROGRESS & LIST BARIS --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        {{-- BLOK KIRI: Tiket Terjual per Konser --}}
        <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6">
            <h3 class="text-white font-bold mb-6">Tiket Terjual per Konser</h3>
            
            <div id="wrapperProgress" class="space-y-6 max-h-[400px] overflow-y-auto pr-1">
                @forelse($events as $event)
                    @php
                        $sold = $event->orders ? $event->orders->where('status', 'paid')->sum('quantity') : 0;
                        $capacity = $event->ticketTypes ? $event->ticketTypes->sum('quota') : 0;
                        $percent = $capacity > 0 ? round(($sold / $capacity) * 100) : 0;
                        
                        $eventDate = \Carbon\Carbon::parse($event->event_date);
                    @endphp
                    <div class="progress-item" data-timestamp="{{ strtotime($event->event_date) }}">
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-[#DADADA] font-medium truncate max-w-xs">{{ $event->title }}</span>
                            <span class="text-[#C9A84C] font-semibold">{{ number_format($sold) }} <span class="text-xs text-gray-500 font-normal">/ {{ number_format($capacity) }}</span></span>
                        </div>
                        <div class="w-full bg-[#020D1A] rounded-full h-2">
                            <div class="bg-[#4A9FD4] h-2 rounded-full transition-all" style="width: {{ $percent }}%"></div>
                        </div>
                        <div class="text-right text-[10px] text-gray-500 mt-1">{{ $percent }}% Target</div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 italic text-center py-6">Tidak ada data visualisasi tiket konser.</p>
                @endforelse
            </div>
        </div>

        {{-- BLOK KANAN: Daftar Status Manajemen Konser Terpilih --}}
        <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6">
            <h3 class="text-white font-bold mb-6">Status Manajemen Konser</h3>
            
            <div id="wrapperRows" class="space-y-4 max-h-[400px] overflow-y-auto pr-1">
                @forelse($events as $event)
                    @php
                        $sold = $event->orders ? $event->orders->where('status', 'paid')->sum('quantity') : 0;
                        $revenue = $event->orders ? $event->orders->where('status', 'paid')->sum('total_amount') : 0;
                        $capacity = $event->ticketTypes ? $event->ticketTypes->sum('quota') : 0;
                        
                        $eventDate = \Carbon\Carbon::parse($event->event_date);
                        $statusUpper = strtoupper($event->status);

                        if ($statusUpper === 'PENDING' || $statusUpper === 'DRAFT') {
                            $badgeClass = 'border-[#C9A84C] text-[#C9A84C] bg-[#C9A84C]/10';
                            $liveStatus = 'PENDING';
                        } elseif ($eventDate->isPast() && !$eventDate->isToday()) {
                            $badgeClass = 'border-green-500 text-green-500 bg-green-500/10';
                            $liveStatus = 'SELESAI';
                        } else {
                            $badgeClass = 'border-[#4A9FD4] text-[#4A9FD4] bg-[#4A9FD4]/10';
                            $liveStatus = 'PUBLISH';
                        }
                    @endphp
                    
                    <div class="event-summary-row flex items-center pb-4 border-b border-[#202020]"
                         data-timestamp="{{ strtotime($event->event_date) }}"
                         data-revenue="{{ $revenue }}"
                         data-sold="{{ $sold }}"
                         data-status="{{ $liveStatus }}">
                        <div class="flex-1 min-w-0 pr-4">
                            <p class="text-[#DADADA] text-sm font-medium truncate">{{ $event->title }}</p>
                            <p class="text-[10px] text-gray-500 truncate">{{ $eventDate->format('d M Y') }} - {{ $event->venue }}</p>
                        </div>
                        <div class="w-20 sm:w-24 text-center text-[#C9A84C] text-xs font-semibold whitespace-nowrap shrink-0">
                            {{ number_format($sold) }}/{{ number_format($capacity) }}
                        </div>
                        <div class="w-24 flex justify-end shrink-0">
                            <span class="inline-flex items-center justify-center px-2.5 py-1 rounded-full border text-[9px] font-bold tracking-wider uppercase w-full {{ $badgeClass }}">
                                {{ $liveStatus }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 italic text-center py-6">Tidak ada record konser terdaftar.</p>
                @endforelse
            </div>
        </div>

    </div>
</div>

<script>
    // Inisialisasi awal saat halaman dibuka pertama kali
    document.addEventListener("DOMContentLoaded", function() {
        filterPeriode('all', document.querySelector('.period-btn:last-of-type'));
    });

    function filterPeriode(range, buttonElement) {
        // 1. Atur style active button filter
        document.querySelectorAll('.period-btn').forEach(btn => {
            btn.className = "period-btn px-4 py-1.5 rounded-full text-xs font-medium border border-[#4A9FD4] text-[#4A9FD4] hover:bg-[#4A9FD4]/10 transition";
        });
        buttonElement.className = "period-btn px-4 py-1.5 rounded-full text-xs font-semibold bg-white text-black transition";

        // 2. Kalkulasi rentang UNIX Timestamp berdasarkan waktu saat ini (Tahun Berjalan 2026)
        const nowMs = new Date().getTime(); 
        const oneDayMs = 24 * 60 * 60 * 1000;
        let startTimestamp = 0;

        if (range === 'today') {
            const todayStart = new Date();
            todayStart.setHours(0,0,0,0);
            startTimestamp = Math.floor(todayStart.getTime() / 1000);
            document.getElementById('labelRentang').innerText = "Hari Ini";
        } else if (range === '7days') {
            startTimestamp = Math.floor((nowMs - (7 * oneDayMs)) / 1000);
            document.getElementById('labelRentang').innerText = "7 Hari Terakhir";
        } else if (range === '30days') {
            startTimestamp = Math.floor((nowMs - (30 * oneDayMs)) / 1000);
            document.getElementById('labelRentang').innerText = "30 Hari Terakhir";
        } else if (range === '3months') {
            startTimestamp = Math.floor((nowMs - (90 * oneDayMs)) / 1000);
            document.getElementById('labelRentang').innerText = "3 Bulan Terakhir";
        } else {
            startTimestamp = 0; // Tampilkan seluruhnya
            document.getElementById('labelRentang').innerText = "Jan 2026 - Des 2026";
        }

        // 3. Logika penyaringan baris element DOM dan hitung ulang akumulasi statistik
        let totalRevenue = 0;
        let totalTickets = 0;
        let activeCount = 0;
        let pendingCount = 0;
        let completedCount = 0;

        // Iterasi List Baris Status Manajemen
        const rows = document.querySelectorAll('.event-summary-row');
        rows.forEach(row => {
            const time = parseInt(row.getAttribute('data-timestamp'));
            const rev = parseFloat(row.getAttribute('data-revenue'));
            const sold = parseInt(row.getAttribute('data-sold'));
            const status = row.getAttribute('data-status');

            if (time >= startTimestamp) {
                row.style.display = "flex";
                // Akumulasikan nilai item yang lolos filter waktu
                totalRevenue += rev;
                totalTickets += sold;
                
                if (status === 'PUBLISH') activeCount++;
                else if (status === 'PENDING') pendingCount++;
                else if (status === 'SELESAI') completedCount++;
            } else {
                row.style.display = "none";
            }
        });

        // Iterasi List Baris Progress Kiri agar sinkron
        const progressItems = document.querySelectorAll('.progress-item');
        progressItems.forEach(item => {
            const time = parseInt(item.getAttribute('data-timestamp'));
            if (time >= startTimestamp) {
                item.style.display = "block";
            } else {
                item.style.display = "none";
            }
        });

        // 4. Perbarui Tampilan Counter Box Atas secara Dinamis
        document.getElementById('statRevenue').innerText = helperFormatShortAmount(totalRevenue);
        document.getElementById('statTickets').innerText = totalTickets.toLocaleString('id-ID');
        document.getElementById('statActive').innerText = activeCount;
        document.getElementById('statPending').innerText = pendingCount;
        document.getElementById('statCompleted').innerText = completedCount;
    }

    // Helper JavaScript untuk penyingkatan mata uang di client side
    function helperFormatShortAmount(amount) {
        if (amount >= 1000000000) {
            return 'Rp ' + (amount / 1000000000).toFixed(1) + 'B';
        } else if (amount >= 1000000) {
            return 'Rp ' + (amount / 1000000).toFixed(1) + 'M';
        }
        return 'Rp ' + amount.toLocaleString('id-ID');
    }
</script>
@endsection