@extends('layouts.admin')
@section('title', 'Daftar Transaksi')

@section('content')
<header class="p-8 pb-4 flex items-center gap-4">
    <a href="{{ route('super.transactions.index') }}" class="w-10 h-10 rounded-full bg-[#041830] border border-[#202020] flex items-center justify-center text-[#DADADA] hover:bg-white/10 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
    </a>
    <div>
        <h1 class="text-2xl font-bold text-[#C9A84C] mb-1">Daftar Transaksi Event</h1>
        <p class="text-sm text-[#4A9FD4]">Kelola transaksi untuk acara yang dipilih</p>
    </div>
</header>

<div class="flex-1 p-8 pt-0 overflow-y-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-[#041830] rounded-xl p-4 border border-[#4A9FD4]/30">
            <p class="text-[#DADADA] text-xs font-medium mb-2">Total Transaksi</p>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-[#C9A84C]/10 flex items-center justify-center text-[#C9A84C]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-[#C9A84C]">124,392</h3>
                    <p class="text-[10px] text-gray-400">Semua waktu</p>
                </div>
            </div>
        </div>
        <div class="bg-[#041830] rounded-xl p-4 border border-[#4A9FD4]/30">
            <p class="text-[#DADADA] text-xs font-medium mb-2">Transaksi Lunas</p>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-green-500/10 flex items-center justify-center text-green-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-green-500">118,204</h3>
                    <p class="text-[10px] text-gray-400">95.0% success rate</p>
                </div>
            </div>
        </div>
        <div class="bg-[#041830] rounded-xl p-4 border border-[#4A9FD4]/30">
            <p class="text-[#DADADA] text-xs font-medium mb-2">Transaksi Batal/Refund</p>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-gray-500/10 flex items-center justify-center text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-white">4,892</h3>
                    <p class="text-[10px] text-gray-400">3.9% cancel rate</p>
                </div>
            </div>
        </div>
    </div>

        <div class="flex flex-wrap gap-4 mb-6 items-center">
        <div class="relative flex-1 min-w-[200px]">
            <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <input type="text" placeholder="Kode booking / nama..." class="w-full bg-white text-black text-sm rounded-md py-2 pl-9 pr-4 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]">
        </div>
        
        <select class="bg-white text-black text-sm rounded-md py-2 px-4 focus:outline-none focus:ring-2 focus:ring-[#C9A84C] cursor-pointer appearance-none pr-8 relative">
            <option>Status: Semua</option>
            <option>Lunas</option>
            <option>Pending</option>
            <option>Gagal</option>
        </select>

        <select class="bg-white text-black text-sm rounded-md py-2 px-4 focus:outline-none focus:ring-2 focus:ring-[#C9A84C] cursor-pointer appearance-none pr-8">
            <option>Konser: Semua</option>
            <option>SZA SOS World Tour</option>
        </select>

        <div class="bg-white text-black text-sm rounded-md py-2 px-4 flex items-center gap-2 cursor-pointer">
            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <span>Jan 2026 - Des 2026</span>
        </div>

        <select class="bg-white text-black text-sm rounded-md py-2 px-4 focus:outline-none focus:ring-2 focus:ring-[#C9A84C] cursor-pointer appearance-none pr-8">
            <option>Harga: Semua</option>
        </select>

        <select class="bg-white text-black text-sm rounded-md py-2 px-4 focus:outline-none focus:ring-2 focus:ring-[#C9A84C] cursor-pointer appearance-none pr-8">
            <option>Metode: Semua</option>
            <option>QRIS</option>
            <option>Virtual Account</option>
        </select>

        <select class="bg-white text-black text-sm rounded-md py-2 px-4 focus:outline-none focus:ring-2 focus:ring-[#C9A84C] cursor-pointer appearance-none pr-8">
            <option>Urutan: -</option>
            <option>Terbaru</option>
        </select>
    </div>

        <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 overflow-x-auto mb-4">
        <table class="w-full text-left text-sm whitespace-nowrap min-w-max">
            <thead class="text-[#4A9FD4] border-b border-[#4A9FD4]/30 bg-[#020D1A]/50">
                <tr>
                    <th class="px-6 py-4 font-medium">Kode Booking</th>
                    <th class="px-6 py-4 font-medium">Nama Pembeli</th>
                    <th class="px-6 py-4 font-medium">Email</th>
                    <th class="px-6 py-4 font-medium">Konser</th>
                    <th class="px-6 py-4 font-medium">Tiket</th>
                    <th class="px-6 py-4 font-medium">Jumlah</th>
                    <th class="px-6 py-4 font-medium">Metode Bayar</th>
                    <th class="px-6 py-4 font-medium">Tanggal</th>
                    <th class="px-6 py-4 font-medium text-center">Status</th>
                    <th class="px-6 py-4 font-medium text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#202020]">
                                <tr class="hover:bg-white/5 transition">
                    <td class="px-6 py-4 text-[#C9A84C] font-semibold"><a href="{{ route('super.transactions.show', 1) }}" class="hover:underline">#07483648</a></td>
                    <td class="px-6 py-4 text-[#DADADA]"><a href="{{ route('super.transactions.show', 1) }}" class="hover:underline hover:text-white transition">Zara</a></td>
                    <td class="px-6 py-4 text-[#DADADA]">zara@gmail.com</td>
                    <td class="px-6 py-4 text-[#DADADA]">SZA SOS World Tour 2026</td>
                    <td class="px-6 py-4 text-[#DADADA]">VIP</td>
                    <td class="px-6 py-4 text-[#DADADA]">2 tiket</td>
                    <td class="px-6 py-4 text-[#DADADA]">QRIS</td>
                    <td class="px-6 py-4 text-[#DADADA]">15 Feb 2026</td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-[#4A9FD4] text-[#4A9FD4] text-[10px] font-bold bg-[#4A9FD4]/10 uppercase">LUNAS</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('super.transactions.show', 1) }}" class="w-8 h-8 rounded-full bg-white text-black flex items-center justify-center hover:bg-gray-200 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>
                            <button class="w-8 h-8 rounded-full bg-white text-red-600 flex items-center justify-center hover:bg-red-50 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                                <tr class="hover:bg-white/5 transition">
                    <td class="px-6 py-4 text-[#C9A84C] font-semibold"><a href="{{ route('super.transactions.show', 2) }}" class="hover:underline">#075192745</a></td>
                    <td class="px-6 py-4 text-[#DADADA]"><a href="{{ route('super.transactions.show', 2) }}" class="hover:underline hover:text-white transition">Mentari</a></td>
                    <td class="px-6 py-4 text-[#DADADA]">mentari@gmail.com</td>
                    <td class="px-6 py-4 text-[#DADADA]">SZA SOS World Tour 2026</td>
                    <td class="px-6 py-4 text-[#DADADA]">VIP</td>
                    <td class="px-6 py-4 text-[#DADADA]">1 tiket</td>
                    <td class="px-6 py-4 text-[#DADADA]">QRIS</td>
                    <td class="px-6 py-4 text-[#DADADA]">20 Feb 2026</td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-[#4A9FD4] text-[#4A9FD4] text-[10px] font-bold bg-[#4A9FD4]/10 uppercase">LUNAS</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button class="w-8 h-8 rounded-full bg-white text-black flex items-center justify-center hover:bg-gray-200 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                            <button class="w-8 h-8 rounded-full bg-white text-red-600 flex items-center justify-center hover:bg-red-50 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                        </div>
                    </td>
                </tr>
                                <tr class="hover:bg-white/5 transition">
                    <td class="px-6 py-4 text-[#C9A84C] font-semibold"><a href="{{ route('super.transactions.show', 3) }}" class="hover:underline">#07538254</a></td>
                    <td class="px-6 py-4 text-[#DADADA]"><a href="{{ route('super.transactions.show', 3) }}" class="hover:underline hover:text-white transition">Citra Dewi</a></td>
                    <td class="px-6 py-4 text-[#DADADA]">citra@email.com</td>
                    <td class="px-6 py-4 text-[#DADADA]">Maliq & D'Essentials</td>
                    <td class="px-6 py-4 text-[#DADADA]">Tribun A</td>
                    <td class="px-6 py-4 text-[#DADADA]">3 tiket</td>
                    <td class="px-6 py-4 text-[#DADADA]">QRIS</td>
                    <td class="px-6 py-4 text-[#DADADA]">18 Jan 2026</td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-red-500 text-red-500 text-[10px] font-bold bg-red-500/10 uppercase">GAGAL</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button class="w-8 h-8 rounded-full bg-white text-black flex items-center justify-center hover:bg-gray-200 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                            <button class="w-8 h-8 rounded-full bg-white text-red-600 flex items-center justify-center hover:bg-red-50 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                        </div>
                    </td>
                </tr>
                                <tr class="hover:bg-white/5 transition">
                    <td class="px-6 py-4 text-[#C9A84C] font-semibold"><a href="{{ route('super.transactions.show', 4) }}" class="hover:underline">#07482845</a></td>
                    <td class="px-6 py-4 text-[#DADADA]"><a href="{{ route('super.transactions.show', 4) }}" class="hover:underline hover:text-white transition">Dian Permata</a></td>
                    <td class="px-6 py-4 text-[#DADADA]">dian@email.com</td>
                    <td class="px-6 py-4 text-[#DADADA]">YUNG KAI World Tour 2026</td>
                    <td class="px-6 py-4 text-[#DADADA]">Festival</td>
                    <td class="px-6 py-4 text-[#DADADA]">2 tiket</td>
                    <td class="px-6 py-4 text-[#DADADA]">QRIS</td>
                    <td class="px-6 py-4 text-[#DADADA]">3 Jan 2026</td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-[#4A9FD4] text-[#4A9FD4] text-[10px] font-bold bg-[#4A9FD4]/10 uppercase">LUNAS</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button class="w-8 h-8 rounded-full bg-white text-black flex items-center justify-center hover:bg-gray-200 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                            <button class="w-8 h-8 rounded-full bg-white text-red-600 flex items-center justify-center hover:bg-red-50 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                        </div>
                    </td>
                </tr>
                                <tr class="hover:bg-white/5 transition">
                    <td class="px-6 py-4 text-[#C9A84C] font-semibold"><a href="{{ route('super.transactions.show', 5) }}" class="hover:underline">#07254835</a></td>
                    <td class="px-6 py-4 text-[#DADADA]"><a href="{{ route('super.transactions.show', 5) }}" class="hover:underline hover:text-white transition">Langit Galaska</a></td>
                    <td class="px-6 py-4 text-[#DADADA]">langit@gmail.com</td>
                    <td class="px-6 py-4 text-[#DADADA]">BTS Permission To Dance</td>
                    <td class="px-6 py-4 text-[#DADADA]">VIP</td>
                    <td class="px-6 py-4 text-[#DADADA]">4 tiket</td>
                    <td class="px-6 py-4 text-[#DADADA]">QRIS</td>
                    <td class="px-6 py-4 text-[#DADADA]">4 Jan 2026</td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-[#4A9FD4] text-[#4A9FD4] text-[10px] font-bold bg-[#4A9FD4]/10 uppercase">LUNAS</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button class="w-8 h-8 rounded-full bg-white text-black flex items-center justify-center hover:bg-gray-200 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                            <button class="w-8 h-8 rounded-full bg-white text-red-600 flex items-center justify-center hover:bg-red-50 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

        <div class="flex justify-between items-center text-sm text-[#DADADA]">
        <p>Menampilkan 1-5 dari 124,392 transaksi</p>
        <div class="flex items-center gap-4">
            <p class="font-bold text-white">Total: Rp 2,847,920,000</p>
            <div class="flex gap-1">
                <button class="w-8 h-8 rounded bg-[#C9A84C] text-[#020D1A] font-bold flex items-center justify-center">1</button>
                <button class="w-8 h-8 rounded border border-gray-600 hover:bg-white/10 flex items-center justify-center">2</button>
                <button class="w-8 h-8 rounded border border-gray-600 hover:bg-white/10 flex items-center justify-center">3</button>
                <button class="w-8 h-8 rounded border border-gray-600 hover:bg-white/10 flex items-center justify-center">4</button>
                <button class="w-8 h-8 rounded border border-gray-600 hover:bg-white/10 flex items-center justify-center">5</button>
                <button class="w-8 h-8 rounded border border-gray-600 hover:bg-white/10 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
