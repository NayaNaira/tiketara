@extends('layouts.promoter')
@section('title', 'Edit Acara')

@section('content')
<header class="p-4 lg:p-8 pb-2 lg:pb-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h1 class="text-2xl font-bold text-[#C9A84C] mb-1">Edit Acara</h1>
        <p class="text-sm text-[#4A9FD4]">Kelola status draft, ubah detail, atau hapus acara Anda</p>
    </div>
    <a href="{{ route('promoter.event.create') }}" class="bg-[#C9A84C] hover:bg-[#b09141] text-[#020D1A] font-bold py-2.5 px-5 rounded-lg transition text-sm flex items-center gap-2 shadow-lg cursor-pointer">
        <i class="fa-solid fa-plus"></i> Daftarkan Acara Baru
    </a>
</header>

<div class="flex-1 p-4 lg:p-8 lg:pt-0 pt-0 overflow-y-auto">
    @if ($errors->any())
        <div class="bg-red-500/10 border border-red-500/30 text-red-500 px-4 py-3 rounded-lg text-sm mb-6 flex items-start gap-2">
            <i class="fa-solid fa-triangle-exclamation mt-0.5"></i>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/30 text-green-500 px-4 py-3 rounded-lg text-sm mb-6 flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 gap-4">
        @forelse($events as $event)
            <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-5 flex flex-col md:flex-row gap-5 items-stretch transition hover:border-[#C9A84C]/50 shadow-md">
                
                {{-- Event Poster --}}
                <div class="w-full md:w-36 shrink-0 h-48 md:h-auto rounded-lg overflow-hidden border border-[#4A9FD4]/20 relative bg-[#020D1A] flex items-center justify-center">
                    @if($event->poster_path)
                        <img src="{{ asset('storage/' . $event->poster_path) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="flex flex-col items-center justify-center text-gray-500">
                            <i class="fa-regular fa-image text-3xl mb-1"></i>
                            <span class="text-[10px]">No Poster</span>
                        </div>
                    @endif
                </div>

                {{-- Event Details --}}
                <div class="flex-1 flex flex-col justify-between">
                    <div>
                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            <span class="px-2 py-0.5 text-[10px] font-bold rounded-full bg-[#4A9FD4]/10 text-[#4A9FD4] border border-[#4A9FD4]/20 uppercase">
                                {{ str_replace('_', ' ', $event->category) }}
                            </span>
                            
                            @php
                                $statusLower = strtolower($event->status);
                                if ($statusLower === 'draft') {
                                    $badgeClass = 'border-gray-500/30 text-gray-400 bg-gray-500/10';
                                    $statusText = 'Draft';
                                } elseif ($statusLower === 'pending') {
                                    $badgeClass = 'border-yellow-500/30 text-yellow-500 bg-yellow-500/10';
                                    $statusText = 'Menunggu Persetujuan';
                                } elseif ($statusLower === 'approved') {
                                    $badgeClass = 'border-green-500/30 text-green-500 bg-green-500/10';
                                    $statusText = 'Disetujui / Publish';
                                } else {
                                    $badgeClass = 'border-red-500/30 text-red-500 bg-red-500/10';
                                    $statusText = 'Ditolak';
                                }
                            @endphp
                            <span class="px-2.5 py-0.5 text-[10px] font-bold rounded-full border {{ $badgeClass }} uppercase tracking-wider">
                                {{ $statusText }}
                            </span>
                        </div>

                        <h2 class="text-lg font-bold text-white mb-2 hover:text-[#C9A84C] transition">
                            {{ $event->title }}
                        </h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-y-2 gap-x-4 text-xs text-[#DADADA] mt-3">
                            <div class="flex items-center gap-2">
                                <i class="fa-regular fa-calendar text-[#C9A84C] w-4"></i>
                                <span>{{ $event->event_date ? $event->event_date->format('d M Y') : 'N/A' }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fa-regular fa-clock text-[#C9A84C] w-4"></i>
                                <span>{{ $event->start_time }} WIB</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-map-location-dot text-[#C9A84C] w-4"></i>
                                <span class="truncate">{{ $event->venue_name }}, {{ $event->city }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Tickets Summary & Actions --}}
                    <div class="mt-4 pt-4 border-t border-[#202020] flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                        {{-- Ticket Categories --}}
                        <div class="flex flex-wrap gap-2 items-center">
                            <span class="text-[10px] text-gray-400 font-semibold uppercase tracking-wider">Tiket:</span>
                            @forelse($event->ticketTypes as $ticket)
                                <div class="bg-[#020D1A] border border-[#4A9FD4]/20 rounded px-2.5 py-1 text-[10px]">
                                    <span class="font-bold text-white">{{ $ticket->name }}</span>
                                    <span class="text-gray-400 mx-1">|</span>
                                    <span class="text-[#C9A84C] font-semibold">Rp {{ number_format($ticket->price, 0, ',', '.') }}</span>
                                    <span class="text-gray-500 ml-1">({{ $ticket->quota }} kuota)</span>
                                </div>
                            @empty
                                <span class="text-xs text-gray-500 italic">Belum ada kategori tiket</span>
                            @endforelse
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex items-center gap-2 w-full lg:w-auto justify-end">
                            @if($event->status === 'draft')
                                {{-- Ajukan Persetujuan --}}
                                <form action="{{ route('promoter.event.update', $event->id) }}" method="POST" class="m-0">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="pending">
                                    <button type="submit" class="bg-[#4A9FD4] hover:bg-[#3d8dbf] text-white font-bold py-1.5 px-3 rounded-lg text-xs flex items-center gap-1.5 transition cursor-pointer">
                                        <i class="fa-regular fa-paper-plane"></i> Ajukan
                                    </button>
                                </form>

                                {{-- Edit Button --}}
                                <a href="{{ route('promoter.event.edit', $event->id) }}" class="border border-[#C9A84C] text-[#C9A84C] hover:bg-[#C9A84C]/10 font-bold py-1.5 px-3 rounded-lg text-xs flex items-center gap-1.5 transition cursor-pointer">
                                    <i class="fa-regular fa-pen-to-square"></i> Edit
                                </a>

                                {{-- Delete Button --}}
                                <form action="{{ route('promoter.event.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus draft event ini secara permanen?');" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600/10 border border-red-500/30 text-red-500 hover:bg-red-600 hover:text-white font-bold py-1.5 px-3 rounded-lg text-xs flex items-center gap-1.5 transition cursor-pointer">
                                        <i class="fa-regular fa-trash-can"></i> Hapus
                                    </button>
                                </form>
                            @elseif($event->status === 'pending')
                                <div class="text-[11px] text-yellow-500/80 bg-yellow-500/5 border border-yellow-500/20 px-3 py-1.5 rounded-lg flex items-center gap-2">
                                    <i class="fa-solid fa-hourglass-half animate-pulse"></i>
                                    <span>Sedang ditinjau oleh Admin</span>
                                </div>
                            @elseif($event->status === 'approved')
                                <div class="text-[11px] text-green-500/80 bg-green-500/5 border border-green-500/20 px-3 py-1.5 rounded-lg flex items-center gap-2">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <span>Event Aktif & Terpublish</span>
                                </div>
                            @elseif($event->status === 'rejected')
                                <div class="flex items-center gap-3">
                                    <div class="text-[11px] text-red-500/85 bg-red-500/5 border border-red-500/20 px-3 py-1.5 rounded-lg max-w-xs">
                                        <div class="font-bold mb-0.5"><i class="fa-solid fa-circle-xmark"></i> Ditolak Admin</div>
                                        @if($event->rejection_reason)
                                            <p class="text-[10px] leading-tight text-red-400/90 italic">"{{ $event->rejection_reason }}"</p>
                                        @endif
                                    </div>
                                    
                                    {{-- Delete Button --}}
                                    <form action="{{ route('promoter.event.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ditolak ini?');" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600/10 border border-red-500/30 text-red-500 hover:bg-red-600 hover:text-white font-bold py-1.5 px-3 rounded-lg text-xs flex items-center gap-1.5 transition cursor-pointer">
                                            <i class="fa-regular fa-trash-can"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-12 text-center flex flex-col items-center justify-center">
                <div class="w-16 h-16 rounded-full bg-[#4A9FD4]/10 flex items-center justify-center text-[#4A9FD4] mb-4 text-2xl">
                    <i class="fa-regular fa-calendar-plus"></i>
                </div>
                <h3 class="text-white font-bold text-lg mb-1">Belum Ada Acara Terdaftar</h3>
                <p class="text-[#DADADA] text-sm max-w-md mb-6">Mulai dengan mendaftarkan acara konser atau festival Anda untuk mulai menjual tiket.</p>
                <a href="{{ route('promoter.event.create') }}" class="bg-[#C9A84C] hover:bg-[#b09141] text-[#020D1A] font-bold py-2.5 px-6 rounded-lg transition text-sm flex items-center gap-2 shadow-lg cursor-pointer">
                    <i class="fa-solid fa-plus"></i> Daftarkan Acara Pertama Anda
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection