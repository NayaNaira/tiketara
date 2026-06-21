@extends('layouts.admin')
@section('title', 'Detail Acara')

@section('content')
@php
    // Solusi toleransi nama relasi agar data kategori tidak kosong
    $ticketsRelation = $event->ticketTypes ?? $event->ticket_types;
    
    $totalSold = $ticketsRelation ? $ticketsRelation->sum('sold') : 0;
    $totalQuota = $ticketsRelation ? $ticketsRelation->sum('quota') : 0;
    $remainingTickets = $totalQuota - $totalSold;

    $totalRevenue = $ticketsRelation ? $ticketsRelation->sum(function ($ticket) {
        return $ticket->sold * ($ticket->price ?? 0);
    }) : 0;

    $soldPercentage = $totalQuota > 0 ? round(($totalSold / $totalQuota) * 100) : 0;
    $remainingPercentage = $totalQuota > 0 ? round(($remainingTickets / $totalQuota) * 100, 1) : 0;

    // Menentukan warna tema dinamis berdasarkan status
    // Jika pending = kuning emas (#C9A84C), jika approved/lainnya = biru (#4A9FD4)
    $themeColor = $event->status === 'pending' ? '#C9A84C' : '#4A9FD4';
    $themeBorderClass = $event->status === 'pending' ? 'border-[#C9A84C]/30' : 'border-[#4A9FD4]/30';
    $themeTextClass = $event->status === 'pending' ? 'text-[#C9A84C]' : 'text-[#4A9FD4]';
    $themeBgClass = $event->status === 'pending' ? 'bg-[#C9A84C]' : 'bg-[#4A9FD4]';
    $themeBgLowOpacity = $event->status === 'pending' ? 'bg-[#C9A84C]/10' : 'bg-[#4A9FD4]/10';
    $themeBorderSolid = $event->status === 'pending' ? 'border-[#C9A84C]' : 'border-[#4A9FD4]';

    // Logika Dinamis untuk Progress Bar Status Approval
    $progressWidth = '25%';
    if ($event->status === 'pending') $progressWidth = '66%';
    if ($event->status === 'approved' || $event->status === 'rejected') $progressWidth = '100%';
@endphp

<header class="p-8 pb-4 flex justify-between items-center border-b border-[#202020] bg-[#020D1A] sticky top-0 z-10">
    <div class="flex items-center gap-4">
        <a href="{{ url()->previous() }}" class="w-10 h-10 rounded-full bg-[#041830] border border-[#202020] flex items-center justify-center text-[#DADADA] hover:bg-white/10 transition shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-[#C9A84C] mb-1">Detail Acara - {{ $event->title }}</h1>
            <p class="text-sm {{ $themeTextClass }}">Kelola semua acara yang terdaftar di platform</p>
        </div>
    </div>
    
    @if($event->status === 'pending')
    <div class="flex gap-3">
        <form id="form-tolak" action="{{ route('super.event.reject', $event->id) }}" method="POST" onsubmit="return handleRejectForm(event)">
            @csrf
            @method('PATCH')
            <input type="hidden" name="rejection_reason" id="rejection_reason_input">
            <button type="submit" class="bg-white border border-gray-300 text-red-500 hover:bg-red-50 text-sm font-semibold py-2 px-6 rounded-md transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Tolak
            </button>
        </form>
        
        <form action="{{ route('super.event.approve', $event->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menyetujui event ini?')">
            @csrf
            @method('PATCH')
            <button type="submit" class="bg-white border border-gray-300 text-green-600 hover:bg-green-50 text-sm font-semibold py-2 px-6 rounded-md transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Setujui
            </button>
        </form>
    </div>
    @endif
</header>

<div class="flex-1 p-8 overflow-y-auto space-y-6">
    @if(session('success'))
    <div class="bg-green-500/10 border border-green-500/30 text-green-400 p-4 rounded-xl text-sm">
        {{ session('success') }}
    </div>
    @endif

    @if($event->status === 'rejected')
    <div class="bg-red-500/10 border border-red-500/30 text-red-400 p-4 rounded-xl text-sm">
        <strong>⚠️ Acara Ini Telah Ditolak.</strong> Alasan: {{ $event->rejection_reason ?? 'Tidak ada catatan khusus.' }}
    </div>
    @endif

    <div class="bg-[#041830] rounded-xl border {{ $themeBorderClass }} p-6 flex flex-col lg:flex-row justify-between gap-6">
        <div class="flex-1">
            <div class="flex items-center gap-2 {{ $themeTextClass }} text-xs font-bold mb-2 uppercase tracking-wide">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                </svg>
                {{ str_replace('_', ' ', $event->category) }}
            </div>
            <h2 class="text-3xl font-bold text-[#C9A84C] mb-4 font-['Playfair_Display']">
                {{ $event->title }}
            </h2>
            
            <div class="space-y-2 text-sm text-[#DADADA] mb-6">
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>
                        {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y') : '-' }}
                        •
                        {{ $event->start_time ? \Carbon\Carbon::parse($event->start_time)->format('H:i') : '--:--' }} WIB
                    </span>
                </div>
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>{{ $event->venue_name }}, {{ $event->city }}</span>
                </div>
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <span>Organizer: {{ $event->promoter->name ?? '-' }}</span>
                </div>
            </div>

            <div class="flex gap-2">
                <span class="px-4 py-1 rounded-full border {{ $themeBorderSolid }} {{ $themeTextClass }} text-xs font-bold {{ $themeBgLowOpacity }} uppercase">
                    {{ $event->status }}
                </span>
                <span class="px-4 py-1 rounded-full border border-gray-400 text-gray-300 text-xs font-bold bg-white/5 uppercase">
                    {{ str_replace('_', ' ', $event->age_rating) }}
                </span>
            </div>
        </div>
        
        <div class="w-64 h-40 rounded-xl overflow-hidden hidden lg:block shrink-0 relative bg-[#020D1A] border border-[#4A9FD4]/20 flex items-center justify-center">
            @if($event->poster_path)
                <img src="{{ $event->poster_url }}" class="w-full h-full object-cover" alt="{{ $event->title }}" onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
            @endif
            <div class="@if($event->poster_path) hidden @endif absolute inset-0 flex flex-col items-center justify-center text-gray-500 bg-gradient-to-br from-[#0c1e35] to-[#1a3a60] p-2 text-center">
                <i class="fa-regular fa-image text-2xl mb-1 text-[#C9A84C]"></i>
                <span class="text-[10px] uppercase tracking-wider font-semibold text-slate-300">No Poster</span>
            </div>
        </div>
    </div>

    <div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
            <div class="bg-[#041830] rounded-xl p-4 border {{ $themeBorderClass }}">
                <div class="flex gap-3 mb-1">
                    <svg class="w-5 h-5 text-[#C9A84C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                    </svg>
                    <p class="text-[#DADADA] text-sm font-medium">Tiket Terjual</p>
                </div>
                <h3 class="text-2xl font-bold text-[#C9A84C]">{{ number_format($totalSold) }}</h3>
                <p class="text-[10px] text-gray-400">dari {{ number_format($totalQuota) }} kapasitas</p>
            </div>
            <div class="bg-[#041830] rounded-xl p-4 border {{ $themeBorderClass }}">
                <div class="flex gap-3 mb-1">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <p class="text-[#DADADA] text-sm font-medium">Sisa Tiket</p>
                </div>
                <h3 class="text-2xl font-bold text-[#C9A84C]">{{ number_format($remainingTickets) }}</h3>
                <p class="text-[10px] text-gray-400">{{ $remainingPercentage }}% masih tersedia</p>
            </div>
            <div class="bg-[#041830] rounded-xl p-4 border {{ $themeBorderClass }}">
                <div class="flex gap-3 mb-1">
                    <svg class="w-5 h-5 text-[#C9A84C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-[#DADADA] text-sm font-medium">Total Pendapatan</p>
                </div>
                <h3 class="text-2xl font-bold text-[#C9A84C]">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                <p class="text-[10px] text-gray-400">Ter-update real-time</p>
            </div>
            <div class="bg-[#041830] rounded-xl p-4 border {{ $themeBorderClass }}">
                <div class="flex gap-3 mb-1">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    <p class="text-[#DADADA] text-sm font-medium">Rata-rata Konversi</p>
                </div>
                <h3 class="text-2xl font-bold text-white">{{ $soldPercentage }}%</h3>
                <p class="text-[10px] text-gray-400">Target terpenuhi</p>
            </div>
        </div>
        
        <div class="w-full bg-[#020D1A] rounded-full h-1.5 flex items-center pr-4">
            <div class="{{ $themeBgClass }} h-1.5 rounded-full" style="width: {{ $soldPercentage }}%"></div>
            <span class="text-[10px] text-white ml-2">{{ $soldPercentage }}%</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-7 space-y-6">
            <div class="bg-[#041830] rounded-xl border {{ $themeBorderClass }} p-6">
                <h3 class="text-white font-bold mb-4 border-b border-[#202020] pb-2">Informasi Konser</h3>
                <table class="w-full text-sm text-[#DADADA]">
                    <tbody class="divide-y divide-[#202020]">
                        <tr>
                            <td class="py-3 w-1/3">Nama Konser</td>
                            <td class="py-3 font-medium text-white">{{ $event->title }}</td>
                        </tr>
                        <tr>
                            <td class="py-3">Penyelenggara</td>
                            <td class="py-3 text-white">{{ $event->promoter->name ?? 'Penyelenggara Eksternal' }}</td>
                        </tr>
                        <tr>
                            <td class="py-3">Kategori</td>
                            <td class="py-3 text-white">{{ str_replace('_', ' ', $event->category) }}</td>
                        </tr>
                        <tr>
                            <td class="py-3">Tanggal</td>
                            <td class="py-3 text-white">{{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y') : '-' }}</td>
                        </tr>
                        <tr>
                            <td class="py-3">Waktu Mulai</td>
                            <td class="py-3 text-white">
                                {{ $event->start_time ? \Carbon\Carbon::parse($event->start_time)->format('H:i') : '--:--' }} 
                                - 
                                {{ $event->end_time ? \Carbon\Carbon::parse($event->end_time)->format('H:i') : '--:--' }} WIB
                            </td>
                        </tr>
                        <tr>
                            <td class="py-3">Venue</td>
                            <td class="py-3 text-white">{{ $event->venue_name }}</td>
                        </tr>
                        <tr>
                            <td class="py-3">Kota</td>
                            <td class="py-3 text-white">{{ $event->city }}</td>
                        </tr>
                        <tr>
                            <td class="py-3">Kapasitas</td>
                            <td class="py-3 text-white">{{ number_format($totalQuota) }} tiket</td>
                        </tr>
                        <tr>
                            <td class="py-3">Batas Usia</td>
                            <td class="py-3 text-white">{{ str_replace('_', ' ', $event->age_rating) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="bg-[#041830] rounded-xl border {{ $themeBorderClass }} p-6">
                <h3 class="text-white font-bold mb-6">Status Approval</h3>
                <div class="relative flex justify-between">
                    <div class="absolute top-1/2 left-0 w-full h-1 bg-[#202020] -translate-y-1/2"></div>
                    <div class="absolute top-1/2 left-0 h-1 {{ $themeBgClass }} -translate-y-1/2 transition-all duration-500" style="width: {{ $progressWidth }}"></div>
                    
                    <div class="relative z-10 flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full {{ $themeBgClass }} text-white flex items-center justify-center font-bold text-sm mb-2">1</div>
                        <span class="text-[10px] text-[#DADADA]">Draft</span>
                    </div>
                    
                    <div class="relative z-10 flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full {{ in_array($event->status, ['pending', 'approved', 'rejected']) ? $themeBgClass . ' text-white' : 'bg-[#202020] text-gray-400' }} flex items-center justify-center font-bold text-sm mb-2">2</div>
                        <span class="text-[10px] text-[#DADADA]">Review Admin</span>
                    </div>
                    
                    <div class="relative z-10 flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full {{ $event->status === 'approved' ? 'bg-green-500 text-white' : ($event->status === 'rejected' ? 'bg-red-500 text-white' : 'bg-[#202020] text-gray-400') }} flex items-center justify-center font-bold text-sm mb-2">3</div>
                        <span class="text-[10px] text-[#DADADA] uppercase font-semibold">{{ $event->status }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-5 space-y-6">
            <div class="bg-[#041830] rounded-xl border {{ $themeBorderClass }} p-6">
                <h3 class="text-white font-bold mb-4 border-b border-[#202020] pb-2">Kategori Tiket</h3>
                <div class="space-y-4">
                    @if($ticketsRelation && $ticketsRelation->count() > 0)
                        @foreach($ticketsRelation as $ticket)
                            @php
                                $percentage = $ticket->quota > 0 ? round(($ticket->sold / $ticket->quota) * 100) : 0;
                            @endphp
                            <div class="flex items-center gap-4 text-sm">
                                <div class="w-1.5 h-10 {{ $themeBgClass }} rounded-full shrink-0"></div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-white font-medium truncate">{{ $ticket->name }}</p>
                                </div>
                                <div class="text-[#DADADA] shrink-0">
                                    Rp {{ number_format($ticket->price ?? 0, 0, ',', '.') }}
                               </div>
                                <div class="text-white font-medium text-right w-20 shrink-0">
                                    {{ number_format($ticket->sold) }}/{{ number_format($ticket->quota) }}
                                </div>
                                <div class="w-16 shrink-0 hidden sm:block">
                                    <div class="w-full bg-[#020D1A] rounded-full h-1.5">
                                        <div class="{{ $themeBgClass }} h-1.5 rounded-full" style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>
                                <div class="text-[10px] text-gray-400 w-8 text-right shrink-0">
                                    {{ $percentage }}%
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-sm text-gray-400 text-center py-4">Belum ada kategori tiket yang dibuat.</p>
                    @endif
                </div>
            </div>

            <div class="bg-[#041830] rounded-xl border {{ $themeBorderClass }} p-6 h-64 flex flex-col">
                <h3 class="text-white font-bold mb-1 border-b border-[#202020] pb-2">Statistik Penjualan</h3>
                <p class="text-[10px] text-gray-400 mb-4">Penjualan Harian (Minggu Terakhir)</p>
                
                <div class="flex-1 flex items-end justify-between gap-2">
                    <div class="flex flex-col items-center w-full">
                        <div class="w-full bg-white/20 rounded-t-sm" style="height: 20%"></div>
                        <span class="text-[10px] text-[#DADADA] mt-2">Sen</span>
                    </div>
                    <div class="flex flex-col items-center w-full">
                        <div class="w-full bg-white/40 rounded-t-sm" style="height: 40%"></div>
                        <span class="text-[10px] text-[#DADADA] mt-2">Sel</span>
                    </div>
                    <div class="flex flex-col items-center w-full">
                        <div class="w-full bg-white/30 rounded-t-sm" style="height: 30%"></div>
                        <span class="text-[10px] text-[#DADADA] mt-2">Rab</span>
                    </div>
                    <div class="flex flex-col items-center w-full">
                        <div class="w-full {{ $themeBgClass }} rounded-t-sm" style="height: 55%"></div>
                        <span class="text-[10px] text-[#DADADA] mt-2">Kam</span>
                    </div>
                    <div class="flex flex-col items-center w-full">
                        <div class="w-full bg-white/35 rounded-t-sm" style="height: 35%"></div>
                        <span class="text-[10px] text-[#DADADA] mt-2">Jum</span>
                    </div>
                    <div class="flex flex-col items-center w-full">
                        <div class="w-full bg-[#C9A84C] rounded-t-sm" style="height: 85%"></div>
                        <span class="text-[10px] text-[#DADADA] mt-2">Sab</span>
                    </div>
                    <div class="flex flex-col items-center w-full">
                        <div class="w-full bg-white/55 rounded-t-sm" style="height: 55%"></div>
                        <span class="text-[10px] text-[#DADADA] mt-2">Min</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function handleRejectForm(e) {
    e.preventDefault(); // Menghentikan submit form otomatis
    
    const reason = prompt('Masukkan alasan penolakan event:');
    if (reason === null) return false; // Jika menekan tombol cancel
    
    if (reason.trim() === '') {
        alert('Alasan penolakan tidak boleh kosong!');
        return false;
    }
    
    // Transfer string teks alasan ke input hidden di dalam HTML Form, lalu kirim
    document.getElementById('rejection_reason_input').value = reason;
    document.getElementById('form-tolak').submit();
}
</script>
@endsection