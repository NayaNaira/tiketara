@extends('layouts.admin')
@section('title', 'Daftar Transaksi - ' . $event->title)

@section('content')
<header class="p-8 pb-4 flex items-center gap-4">
    <a href="{{ route('super.transactions.index') }}" class="w-10 h-10 rounded-full bg-[#041830] border border-[#202020] flex items-center justify-center text-[#DADADA] hover:bg-white/10 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
    </a>
    <div>
        <h1 class="text-2xl font-bold text-[#C9A84C] mb-1">Daftar Transaksi: {{ $event->title }}</h1>
        <p class="text-sm text-[#4A9FD4]">Kelola data manifestasi riwayat tiket pembeli</p>
    </div>
</header>

<div class="flex-1 p-8 pt-0 overflow-y-auto">
    <!-- 📊 CARD STATISTIK DINAMIS PER-EVENT -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <!-- Total Semua Transaksi Di-order -->
        <div class="bg-[#041830] rounded-xl p-4 border border-[#4A9FD4]/30">
            <p class="text-[#DADADA] text-xs font-medium mb-2">Total Transaksi</p>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-[#C9A84C]/10 flex items-center justify-center text-[#C9A84C]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-[#C9A84C]">{{ number_format($orders->total()) }}</h3>
                    <p class="text-[10px] text-gray-400">Nota Terbikin</p>
                </div>
            </div>
        </div>

        <!-- Total Transaksi Lunas -->
        <div class="bg-[#041830] rounded-xl p-4 border border-[#4A9FD4]/30">
            <p class="text-[#DADADA] text-xs font-medium mb-2">Transaksi Lunas</p>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-green-500/10 flex items-center justify-center text-green-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-green-500">
                        {{ number_format($orders->where('status', 'paid')->count()) }}
                    </h3>
                    <p class="text-[10px] text-gray-400">Status Berhasil (Paid)</p>
                </div>
            </div>
        </div>

        <!-- Total Transaksi Gagal/Batal/Expired -->
        <div class="bg-[#041830] rounded-xl p-4 border border-[#4A9FD4]/30">
            <p class="text-[#DADADA] text-xs font-medium mb-2">Transaksi Batal / Expired</p>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-red-500/10 flex items-center justify-center text-red-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-white">
                        {{ number_format($orders->whereIn('status', ['expired', 'refunded'])->count()) }}
                    </h3>
                    <p class="text-[10px] text-gray-400">Gagal bayar / hangus</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Pencarian (Statis Komponen UI) -->
    <div class="flex flex-wrap gap-4 mb-6 items-center">
        <div class="relative flex-1 min-w-[200px]">
            <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <input type="text" placeholder="Cari ID Nota / Nama pembeli..." class="w-full bg-white text-black text-sm rounded-md py-2 pl-9 pr-4 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]">
        </div>
        
        <select class="bg-white text-black text-sm rounded-md py-2 px-4 focus:outline-none focus:ring-2 focus:ring-[#C9A84C] cursor-pointer">
            <option>Status: Semua</option>
            <option>Lunas</option>
            <option>Pending</option>
            <option>Expired</option>
        </select>
    </div>

    <!-- 🧾 TABEL DAFTAR NOTA TRANSAKSI MASUK -->
    <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 overflow-x-auto mb-4">
        <table class="w-full text-left text-sm whitespace-nowrap min-w-max">
            <thead class="text-[#4A9FD4] border-b border-[#4A9FD4]/30 bg-[#020D1A]/50">
                <tr>
                    <th class="px-6 py-4 font-medium">ID Transaksi</th>
                    <th class="px-6 py-4 font-medium">Nama Pembeli</th>
                    <th class="px-6 py-4 font-medium">Email</th>
                    <th class="px-6 py-4 font-medium">Nama Event</th>
                    <th class="px-6 py-4 font-medium">Jumlah Tiket</th>
                    <th class="px-6 py-4 font-medium">Total Harga</th>
                    <th class="px-6 py-4 font-medium">Tanggal Bayar</th>
                    <th class="px-6 py-4 font-medium text-center">Status</th>
                    <th class="px-6 py-4 font-medium text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800/40">
                @forelse($orders as $order)
                    <tr class="hover:bg-white/5 transition">
                        <!-- ID String Nota -->
                        <td class="px-6 py-4 text-[#C9A84C] font-semibold">
                            <a href="{{ route('super.transactions.show', $order->id) }}" class="hover:underline">
                                #{{ $order->id }}
                            </a>
                        </td>
                        
                        <!-- Nama Pembeli dari Relasi User -->
                        <td class="px-6 py-4 text-[#DADADA]">
                            <a href="{{ route('super.transactions.show', $order->id) }}" class="hover:underline hover:text-white transition">
                                {{ $order->user->name ?? 'User Terhapus' }}
                            </a>
                        </td>
                        
                        <td class="px-6 py-4 text-[#DADADA]">{{ $order->user->email ?? '-' }}</td>
                        <td class="px-6 py-4 text-[#DADADA] max-w-xs truncate">{{ $event->title }}</td>
                        <td class="px-6 py-4 text-[#DADADA]">{{ $order->quantity }} Tiket</td>
                        
                        <!-- Harga Rupiah Pembayaran -->
                        <td class="px-6 py-4 text-[#DADADA]">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </td>
                        
                        <td class="px-6 py-4 text-[#DADADA]">
                            {{ $order->created_at->translatedFormat('d M Y') }}
                        </td>
                        
                        <!-- Status Badge Label -->
                        <td class="px-6 py-4 text-center">
                            @if($order->status === 'paid')
                                <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-[#4A9FD4] text-[#4A9FD4] text-[10px] font-bold bg-[#4A9FD4]/10 uppercase">LUNAS</span>
                            @elseif($order->status === 'pending')
                                <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-yellow-500 text-yellow-400 text-[10px] font-bold bg-yellow-500/10 uppercase">PENDING</span>
                            @elseif($order->status === 'refunded')
                                <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-purple-500 text-purple-400 text-[10px] font-bold bg-purple-500/10 uppercase">REFUND</span>
                            @else
                                <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-red-500 text-red-500 text-[10px] font-bold bg-red-500/10 uppercase">GAGAL</span>
                            @endif
                        </td>
                        
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('super.transactions.show', $order->id) }}" class="w-8 h-8 rounded-full bg-white text-black flex items-center justify-center hover:bg-gray-200 transition" title="Lihat Detail Invoice">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-6 py-10 text-center text-gray-500 text-sm">
                            Belum ada rekam jejak transaksi tiket yang masuk untuk acara ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 entries-pagination">
        {{ $orders->links() }}
    </div>
</div>
@endsection