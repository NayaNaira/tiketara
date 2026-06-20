@extends('layouts.admin')
@section('title', 'Daftar Transaksi')

@section('content')
<header class="p-4 lg:p-8 pb-2 lg:pb-4">
    <h1 class="text-2xl font-bold text-[#C9A84C] mb-1">Daftar Transaksi</h1>
    <p class="text-sm text-[#4A9FD4]">Pilih acara untuk melihat daftar transaksi</p>
</header>

<div class="flex-1 p-4 lg:p-8 lg:pt-0 pt-0 overflow-y-auto">
    
    <div class="flex flex-wrap gap-4 mb-6 items-center">
        <div class="relative flex-1 min-w-[200px]">
            <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <input type="text" placeholder="Cari nama acara..." class="w-full bg-white text-black text-sm rounded-md py-2 pl-9 pr-4 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]">
        </div>
        
        <select class="bg-white text-black text-sm rounded-md py-2 px-4 focus:outline-none focus:ring-2 focus:ring-[#C9A84C] cursor-pointer appearance-none pr-8 relative">
            <option>Status: Semua</option>
            <option>Publish</option>
            <option>Draft</option>
            <option>Selesai</option>
        </select>

        <select class="bg-white text-black text-sm rounded-md py-2 px-4 focus:outline-none focus:ring-2 focus:ring-[#C9A84C] cursor-pointer appearance-none pr-8">
            <option>Kategori: Semua</option>
            <option>Konser</option>
            <option>Festival</option>
        </select>

        <div class="bg-white text-black text-sm rounded-md py-2 px-4 flex items-center gap-2 cursor-pointer">
            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <span>Jan 2026 - Des 2026</span>
        </div>

        <select class="bg-white text-black text-sm rounded-md py-2 px-4 focus:outline-none focus:ring-2 focus:ring-[#C9A84C] cursor-pointer appearance-none pr-8">
            <option>Urutkan: Terbaru</option>
            <option>Terlama</option>
        </select>
    </div>

    <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 overflow-x-auto">
        <table class="w-full text-left text-sm whitespace-nowrap min-w-max">
            <thead class="text-[#4A9FD4] border-b border-[#4A9FD4]/30">
                <tr>
                    <th class="px-6 py-4 font-medium">No</th>
                    <th class="px-6 py-4 font-medium">Nama Konser</th>
                    <th class="px-6 py-4 font-medium">Tanggal & Waktu</th>
                    <th class="px-6 py-4 font-medium">Venue & Kota</th>
                    <th class="px-6 py-4 font-medium">Kategori</th>
                    <th class="px-6 py-4 font-medium">Tiket Terjual</th>
                    <th class="px-6 py-4 font-medium">Pendapatan</th>
                    <th class="px-6 py-4 font-medium text-center">Status</th>
                    <th class="px-6 py-4 font-medium text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#202020]">
                @forelse($events as $index => $event)
                    <tr class="hover:bg-white/5 transition">
                        <td class="px-6 py-4 text-[#DADADA]">{{ $index + 1 }}</td>
                        
                        <!-- 🔗 Nama Konser dibuat bisa diklik menuju List Transaksi -->
                        <td class="px-6 py-4 font-medium text-white max-w-xs truncate">
                            <a href="{{ route('super.transactions.eventList', $event->id) }}" class="hover:text-[#C9A84C] hover:underline transition">
                                {{ $event->title }}
                            </a>
                        </td>
                        
                        <td class="px-6 py-4 text-[#DADADA]">
                            {{ \Carbon\Carbon::parse($event->start_time)->translatedFormat('d M Y') }}<br>
                            <span class="text-xs">{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} WIB</span>
                        </td>
                        <td class="px-6 py-4 text-[#DADADA]">{{ $event->venue }}, {{ $event->city }}</td>
                        <td class="px-6 py-4 text-[#DADADA]">{{ $event->category ?? '-' }}</td>
                        
                        <td class="px-6 py-4 text-[#DADADA]">
                            {{ number_format($event->tickets_sold ?? 0) }} / {{ number_format($event->max_capacity ?? 0) }}
                        </td>
                        
                        <td class="px-6 py-4 text-[#DADADA]">
                            {{ $event->revenue > 0 ? 'Rp ' . number_format($event->revenue, 0, ',', '.') : '-' }}
                        </td>
                        
                        <td class="px-6 py-4 text-center">
    @php
        $currentTime = \Carbon\Carbon::now();
        $startTime = \Carbon\Carbon::parse($event->start_time);
        
        // Misalkan durasi konser rata-rata 3 jam, kamu bisa sesuaikan durasinya
        $endTime = \Carbon\Carbon::parse($event->start_time)->addHours(3); 
    @endphp

    @if($currentTime->lt($startTime))
        <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-[#C9A84C] text-[#C9A84C] text-xs font-bold bg-[#C9A84C]/10 uppercase tracking-wide">
            Upcoming
        </span>
    @elseif($currentTime->between($startTime, $endTime))
        <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-[#4A9FD4] text-[#4A9FD4] text-xs font-bold bg-[#4A9FD4]/10 uppercase tracking-wide animate-pulse">
            Ongoing
        </span>
    @else
        <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-gray-500 text-gray-400 text-xs font-bold bg-gray-500/10 uppercase tracking-wide">
            Selesai
        </span>
    @endif
</td>
                        
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <!-- 🔗 Tombol Aksi mengarah ke List Transaksi -->
                                <a href="{{ route('super.transactions.eventList', $event->id) }}" class="px-4 py-2 bg-[#4A9FD4]/10 text-[#4A9FD4] border border-[#4A9FD4] rounded-md hover:bg-[#4A9FD4] hover:text-white transition text-xs font-semibold whitespace-nowrap">
                                    Lihat Transaksi
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-6 py-10 text-center text-gray-500 text-sm">
                            Tidak ada data acara atau transaksi yang tersedia.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection