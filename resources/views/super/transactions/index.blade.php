@extends('layouts.admin')
@section('title', 'Daftar Transaksi')

@section('content')
<header class="p-8 pb-4">
    <h1 class="text-2xl font-bold text-[#C9A84C] mb-1">Daftar Transaksi</h1>
    <p class="text-sm text-[#4A9FD4]">Pilih acara untuk melihat daftar transaksi</p>
</header>

<div class="flex-1 p-8 pt-0 overflow-y-auto">
    
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
        
        <div class="flex bg-white rounded-md overflow-hidden">
            <button class="px-3 py-2 bg-gray-100 text-black border-r border-gray-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            </button>
            <button class="px-3 py-2 text-gray-500 hover:bg-gray-50">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>
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
                                <tr class="hover:bg-white/5 transition">
                    <td class="px-6 py-4 text-[#DADADA]">1</td>
                    <td class="px-6 py-4 font-medium text-white">SZA SOS World Tour 2026</td>
                    <td class="px-6 py-4 text-[#DADADA]">14 JULI 2026<br><span class="text-xs">19:30 WIB</span></td>
                    <td class="px-6 py-4 text-[#DADADA]">GBK, Jakarta</td>
                    <td class="px-6 py-4 text-[#DADADA]">R&B</td>
                    <td class="px-6 py-4 text-[#DADADA]">18,420/25,000</td>
                    <td class="px-6 py-4 text-[#DADADA]">Rp 10.5M</td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-[#4A9FD4] text-[#4A9FD4] text-xs font-bold bg-[#4A9FD4]/10 uppercase">PUBLISH</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('super.transactions.list', 1) }}" class="px-4 py-2 bg-[#4A9FD4]/10 text-[#4A9FD4] border border-[#4A9FD4] rounded-md hover:bg-[#4A9FD4] hover:text-white transition text-xs font-semibold whitespace-nowrap">Lihat Transaksi</a>
                        </div>
                    </td>
                </tr>
                                <tr class="hover:bg-white/5 transition">
                    <td class="px-6 py-4 text-[#DADADA]">2</td>
                    <td class="px-6 py-4 font-medium text-white">YUNG KAI World Tour 2026</td>
                    <td class="px-6 py-4 text-[#DADADA]">21 JULI 2026<br><span class="text-xs">20:30 WIB</span></td>
                    <td class="px-6 py-4 text-[#DADADA]">Senayan, Jakarta</td>
                    <td class="px-6 py-4 text-[#DADADA]">Indie POP</td>
                    <td class="px-6 py-4 text-[#DADADA]">10,400/15,000</td>
                    <td class="px-6 py-4 text-[#DADADA]">Rp 8M</td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-[#4A9FD4] text-[#4A9FD4] text-xs font-bold bg-[#4A9FD4]/10 uppercase">PUBLISH</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('super.transactions.list', 2) }}" class="px-4 py-2 bg-[#4A9FD4]/10 text-[#4A9FD4] border border-[#4A9FD4] rounded-md hover:bg-[#4A9FD4] hover:text-white transition text-xs font-semibold whitespace-nowrap">Lihat Transaksi</a>
                        </div>
                    </td>
                </tr>
                                <tr class="hover:bg-white/5 transition">
                    <td class="px-6 py-4 text-[#DADADA]">3</td>
                    <td class="px-6 py-4 font-medium text-white">Dewa 19 Reunion Concert</td>
                    <td class="px-6 py-4 text-[#DADADA]">18 AGUST 2026<br><span class="text-xs">14:00 WIB</span></td>
                    <td class="px-6 py-4 text-[#DADADA]">JIEXPO, Jakarta</td>
                    <td class="px-6 py-4 text-[#DADADA]">POP/ROCK</td>
                    <td class="px-6 py-4 text-[#DADADA]">0/12,000</td>
                    <td class="px-6 py-4 text-[#DADADA]">-</td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-[#C9A84C] text-[#C9A84C] text-xs font-bold bg-[#C9A84C]/10 uppercase">DRAFT</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('super.transactions.list', 3) }}" class="px-4 py-2 bg-[#4A9FD4]/10 text-[#4A9FD4] border border-[#4A9FD4] rounded-md hover:bg-[#4A9FD4] hover:text-white transition text-xs font-semibold whitespace-nowrap">Lihat Transaksi</a>
                        </div>
                    </td>
                </tr>
                                <tr class="hover:bg-white/5 transition">
                    <td class="px-6 py-4 text-[#DADADA]">4</td>
                    <td class="px-6 py-4 font-medium text-white">BTS Permission To Dance</td>
                    <td class="px-6 py-4 text-[#DADADA]">10 MAR 2026<br><span class="text-xs">18:30 WIB</span></td>
                    <td class="px-6 py-4 text-[#DADADA]">GBK, Jakarta</td>
                    <td class="px-6 py-4 text-[#DADADA]">K-POP</td>
                    <td class="px-6 py-4 text-[#DADADA]">50,000/50,000</td>
                    <td class="px-6 py-4 text-[#DADADA]">Rp 300M</td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-green-500 text-green-500 text-xs font-bold bg-green-500/10 uppercase">SELESAI</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('super.transactions.list', 4) }}" class="px-4 py-2 bg-[#4A9FD4]/10 text-[#4A9FD4] border border-[#4A9FD4] rounded-md hover:bg-[#4A9FD4] hover:text-white transition text-xs font-semibold whitespace-nowrap">Lihat Transaksi</a>
                        </div>
                    </td>
                </tr>
                                <tr class="hover:bg-white/5 transition">
                    <td class="px-6 py-4 text-[#DADADA]">5</td>
                    <td class="px-6 py-4 font-medium text-white">Maliq & D'Essentials</td>
                    <td class="px-6 py-4 text-[#DADADA]">8 FEB 2026<br><span class="text-xs">16:00 WIB</span></td>
                    <td class="px-6 py-4 text-[#DADADA]">Senayan, Jakarta</td>
                    <td class="px-6 py-4 text-[#DADADA]">Jazz/Soul</td>
                    <td class="px-6 py-4 text-[#DADADA]">24,000/25,000</td>
                    <td class="px-6 py-4 text-[#DADADA]">Rp 5M</td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-green-500 text-green-500 text-xs font-bold bg-green-500/10 uppercase">SELESAI</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('super.transactions.list', 5) }}" class="px-4 py-2 bg-[#4A9FD4]/10 text-[#4A9FD4] border border-[#4A9FD4] rounded-md hover:bg-[#4A9FD4] hover:text-white transition text-xs font-semibold whitespace-nowrap">Lihat Transaksi</a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
