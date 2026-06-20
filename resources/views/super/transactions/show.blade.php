@extends('layouts.admin')
@section('title', 'Detail Transaksi #' . $order->id)

@section('content')
<header class="p-8 pb-4 flex items-center gap-4">
    <a href="{{ url()->previous() }}" class="w-10 h-10 rounded-full bg-[#041830] border border-[#202020] flex items-center justify-center text-[#DADADA] hover:bg-white/10 transition shrink-0">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
    </a>
    <div>
        <h1 class="text-2xl font-bold text-[#C9A84C] mb-1">Detail Transaksi - #{{ $order->id }}</h1>
        <p class="text-sm text-[#4A9FD4]">Kelola semua transaksi yang masuk di platform</p>
    </div>
</header>

<div class="flex-1 p-8 pt-0 overflow-y-auto space-y-6">
    @if($order->status === 'paid')
        <div class="bg-[#041830] border border-green-500 rounded-xl p-4 flex justify-between items-center relative overflow-hidden">
            <div class="absolute left-0 top-0 bottom-0 w-1 bg-green-500"></div>
            <div class="flex gap-4 items-center z-10">
                <div class="w-8 h-8 rounded-md bg-green-500 flex items-center justify-center text-white shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div>
                    <h3 class="text-green-500 font-bold tracking-wide">TRANSAKSI BERHASIL / LUNAS</h3>
                    <p class="text-xs text-[#4A9FD4]">Pembayaran dikonfirmasi pada {{ $order->updated_at->translatedFormat('d F Y, H:i') }} WIB</p>
                </div>
            </div>
            <div class="text-sm text-[#DADADA] z-10 font-medium">
                Kode: <span class="text-white">#{{ $order->id }}</span>
            </div>
        </div>
    @elseif($order->status === 'pending')
        <div class="bg-[#041830] border border-yellow-500 rounded-xl p-4 flex justify-between items-center relative overflow-hidden">
            <div class="absolute left-0 top-0 bottom-0 w-1 bg-yellow-500"></div>
            <div class="flex gap-4 items-center z-10">
                <div class="w-8 h-8 rounded-md bg-yellow-500 flex items-center justify-center text-white shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h3 class="text-yellow-500 font-bold tracking-wide">MENUNGGU PEMBAYARAN</h3>
                    <p class="text-xs text-[#4A9FD4]">Invoice diterbitkan pada {{ $order->created_at->translatedFormat('d F Y, H:i') }} WIB</p>
                </div>
            </div>
            <div class="text-sm text-[#DADADA] z-10 font-medium">
                Kode: <span class="text-white">#{{ $order->id }}</span>
            </div>
        </div>
    @else
        <div class="bg-[#041830] border border-red-500 rounded-xl p-4 flex justify-between items-center relative overflow-hidden">
            <div class="absolute left-0 top-0 bottom-0 w-1 bg-red-500"></div>
            <div class="flex gap-4 items-center z-10">
                <div class="w-8 h-8 rounded-md bg-red-500 flex items-center justify-center text-white shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </div>
                <div>
                    <h3 class="text-red-500 font-bold tracking-wide">TRANSAKSI BATAL / EXPIRED</h3>
                    <p class="text-xs text-[#4A9FD4]">Sistem menutup otomatis transaksi pada {{ $order->updated_at->translatedFormat('d F Y, H:i') }} WIB</p>
                </div>
            </div>
            <div class="text-sm text-[#DADADA] z-10 font-medium">
                Kode: <span class="text-white">#{{ $order->id }}</span>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- KOLOM KIRI: DATA USER & BILLING -->
        <div class="space-y-6">
            <!-- Data Pembeli -->
            <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6">
                <h3 class="text-white font-bold mb-4 border-b border-[#202020] pb-2">Data Pembeli</h3>
                
                <div class="flex items-center gap-4 mb-6">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($order->user->name ?? 'User') }}&background=C9A84C&color=fff" class="w-12 h-12 rounded-full border-2 border-[#4A9FD4]">
                    <div>
                        <h4 class="text-white font-bold text-lg leading-tight">{{ $order->user->name ?? 'User Terhapus' }}</h4>
                        <p class="text-xs text-gray-400 flex items-center gap-1 mt-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg> 
                            {{ $order->user->email ?? '-' }}
                        </p>
                        <p class="text-xs text-gray-400 flex items-center gap-1 mt-0.5">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg> 
                            {{ $order->user->phone ?? '-' }}
                        </p>
                    </div>
                </div>

                <table class="w-full text-sm text-[#DADADA]">
                    <tbody class="divide-y divide-[#202020]">
                        <tr>
                            <td class="py-2.5 w-1/3">Terdaftar sejak</td>
                            <td class="py-2.5 text-white">
                                {{ $order->user ? $order->user->created_at->translatedFormat('d F Y') : '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2.5">Kota asal</td>
                            <td class="py-2.5 text-white">{{ $order->user->city ?? 'Tidak Mengisi' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Ringkasan Pembayaran -->
            <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6">
                <h3 class="text-white font-bold mb-4 border-b border-[#202020] pb-2">Ringkasan Pembayaran</h3>
                
                <div class="space-y-3 text-sm text-[#DADADA] mb-4">
                    <div class="flex justify-between">
                        <span>Harga tiket ({{ $order->quantity }}x)</span>
                        <span class="text-white">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Biaya layanan Platform</span>
                        <span class="text-white">Rp 0</span>
                    </div>
                </div>
                
                <div class="flex justify-between text-white font-bold text-lg mb-6 border-t border-[#202020] pt-3">
                    <span>TOTAL DIBAYAR</span>
                    <span class="text-[#C9A84C]">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>

                <div class="bg-[#4A9FD4]/10 border border-[#4A9FD4]/30 rounded-lg p-3 flex items-center gap-3">
                    <div class="bg-[#4A9FD4] text-[#020D1A] text-[10px] font-bold px-2 py-1 rounded">GATEWAY</div>
                    <p class="text-sm text-white font-medium">Virtual Account Otomatis</p>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: DETAIL MANIFESTASI KONSER -->
        <div class="space-y-6">
            <!-- Informasi Konser -->
            <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6">
                <h3 class="text-white font-bold mb-4 border-b border-[#202020] pb-2">Informasi Konser</h3>
                
                <div class="flex gap-4 mb-6">
                    <img src="{{ $order->event->image_url ?? 'https://images.unsplash.com/photo-1516280440502-120042784eb4?q=80&w=200&auto=format&fit=crop' }}" class="w-24 h-16 object-cover rounded-md bg-gray-800">
                    <div>
                        <h4 class="text-white font-bold text-sm">{{ $order->event->title ?? 'Nama Acara Tidak Ditemukan' }}</h4>
                        <p class="text-xs text-[#C9A84C] italic mb-1">{{ $order->event->category ?? 'Kategori Hiburan' }}</p>
                        <p class="text-[10px] text-gray-400 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> 
                            {{ $order->event ? \Carbon\Carbon::parse($order->event->start_time)->translatedFormat('d F Y • H:i') . ' WIB' : '-' }}
                        </p>
                        <p class="text-[10px] text-gray-400 flex items-center gap-1 mt-0.5">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg> 
                            {{ $order->event->venue ?? '-' }}, {{ $order->event->city ?? '-' }}
                        </p>
                    </div>
                </div>

                <table class="w-full text-sm text-[#DADADA]">
                    <tbody class="divide-y divide-[#202020]">
                        <tr>
                            <td class="py-2.5 w-1/3">Kategori Tiket</td>
                            <td class="py-2.5 text-white">General Admission (GA)</td>
                        </tr>
                        <tr>
                            <td class="py-2.5">Jumlah Tiket</td>
                            <td class="py-2.5 text-white">{{ $order->quantity }} tiket</td>
                        </tr>
                        <tr>
                            <td class="py-2.5 border-b-0">Rata-rata per Tiket</td>
                            <td class="py-2.5 border-b-0 text-white">
                                Rp {{ number_format($order->total_amount / max($order->quantity, 1), 0, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Detail Lembar Tiket Pembeli (Looping Dinamis) -->
            <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6">
                <h3 class="text-white font-bold mb-4 border-b border-[#202020] pb-2">Detail Manifes Tiket</h3>
                
                <div class="space-y-4">
                    {{-- Di sini diasumsikan kamu memiliki relasi atau meloop berdasarkan kuantitas order --}}
                    @for($i = 1; $i <= $order->quantity; $i++)
                        <div class="relative pl-4">
                            <div class="absolute left-0 top-0 bottom-0 w-1.5 {{ $i % 2 == 0 ? 'bg-[#4A9FD4]' : 'bg-[#C9A84C]' }} rounded-full"></div>
                            <h4 class="text-white font-bold text-sm mb-2 tracking-wide">TIKET #{{ $i }} — {{ $order->event->title ?? 'Event' }}</h4>
                            <div class="grid grid-cols-2 text-xs text-[#DADADA] gap-y-1">
                                <p>Seat/Kategori: <span class="text-white font-medium">Festival Standard</span></p>
                                <p>Pemegang: <span class="text-white font-medium">{{ $order->user->name ?? 'Pembeli' }}</span></p>
                                <p class="col-span-2">Secure Ticket Code: <span class="font-mono text-[#4A9FD4]">EV-{{ $order->id }}-00{{ $i }}</span></p>
                            </div>
                        </div>
                        
                        @if($i < $order->quantity)
                            <div class="h-px bg-[#202020] my-2"></div>
                        @endif
                    @endfor
                </div>
            </div>
        </div>

    </div>
</div>
@endsection