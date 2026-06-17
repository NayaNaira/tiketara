@extends('layouts.admin')
@section('title', 'Ringkasan')

@section('content')
<header class="p-8 pb-4">
    <h1 class="text-2xl font-bold text-[#C9A84C] mb-1">Ringkasan Acara</h1>
    <p class="text-sm text-[#4A9FD4]">Kelola semua acara yang terdaftar di platform</p>
</header>

<div class="flex-1 p-8 pt-0 overflow-y-auto">
        <div class="flex flex-wrap gap-2 mb-6 items-center bg-[#041830] p-3 rounded-xl border border-[#4A9FD4]/30">
        <span class="text-[#DADADA] text-sm mr-2 font-medium">Periode:</span>
        <button class="px-4 py-1.5 rounded-full text-xs font-semibold bg-[#C9A84C] text-[#020D1A]">Hari ini</button>
        <button class="px-4 py-1.5 rounded-full text-xs font-medium border border-[#4A9FD4] text-[#4A9FD4] hover:bg-[#4A9FD4]/10 transition">7 Hari</button>
        <button class="px-4 py-1.5 rounded-full text-xs font-medium border border-[#4A9FD4] text-[#4A9FD4] hover:bg-[#4A9FD4]/10 transition">30 Hari</button>
        <button class="px-4 py-1.5 rounded-full text-xs font-medium border border-[#4A9FD4] text-[#4A9FD4] hover:bg-[#4A9FD4]/10 transition">3 Bulan</button>
        <button class="px-4 py-1.5 rounded-full text-xs font-medium bg-white text-black transition">1 Tahun</button>
        
        <div class="ml-auto flex items-center gap-2 bg-white text-black text-xs font-medium rounded-md py-1.5 px-3 cursor-pointer">
            <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <span>Jan 2026 - Des 2026</span>
        </div>
    </div>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
        <div class="col-span-1 md:col-span-1 bg-[#041830] rounded-xl p-4 border border-[#4A9FD4]/30">
            <p class="text-[#DADADA] text-xs font-medium mb-2">Total Pendapatan</p>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-[#C9A84C]/10 flex items-center justify-center text-[#C9A84C]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-[#C9A84C] whitespace-nowrap">Rp 323.5M</h3>
            </div>
        </div>
        <div class="col-span-1 md:col-span-1 bg-[#041830] rounded-xl p-4 border border-[#4A9FD4]/30">
            <p class="text-[#DADADA] text-xs font-medium mb-2">Total Tiket Terjual</p>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-[#C9A84C]/10 flex items-center justify-center text-[#C9A84C]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-[#C9A84C]">102,450 <span class="text-sm font-normal">tiket</span></h3>
            </div>
        </div>
        <div class="col-span-1 md:col-span-1 bg-[#041830] rounded-xl p-4 border border-[#4A9FD4]/30">
            <p class="text-[#DADADA] text-xs font-medium mb-2">Jumlah Konser Aktif</p>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-gray-500/10 flex items-center justify-center text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-[#C9A84C]">2 <span class="text-sm font-normal">konser</span></h3>
            </div>
        </div>
        <div class="col-span-1 md:col-span-1 bg-[#041830] rounded-xl p-4 border border-[#4A9FD4]/30">
            <p class="text-[#DADADA] text-xs font-medium mb-2">Draft</p>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-yellow-500/10 flex items-center justify-center text-yellow-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-[#C9A84C]">1 <span class="text-sm font-normal">konser</span></h3>
            </div>
        </div>
        <div class="col-span-1 md:col-span-1 bg-[#041830] rounded-xl p-4 border border-[#4A9FD4]/30">
            <p class="text-[#DADADA] text-xs font-medium mb-2">Konser Selesai (Reblock)</p>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-green-500/10 flex items-center justify-center text-green-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-[#C9A84C]">2 <span class="text-sm font-normal">konser</span></h3>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6">
            <h3 class="text-white font-bold mb-6">Tiket Terjual per Konser</h3>
            
            <div class="space-y-6">
                                <div>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-[#DADADA]">SZA SOS World Tour 2026</span>
                        <span class="text-[#C9A84C] font-semibold">18,420</span>
                    </div>
                    <div class="w-full bg-[#020D1A] rounded-full h-2">
                        <div class="bg-[#4A9FD4] h-2 rounded-full" style="width: 73%"></div>
                    </div>
                    <div class="text-right text-[10px] text-gray-500 mt-1">73%</div>
                </div>

                                <div>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-[#DADADA]">YUNG KAI World Tour 2026</span>
                        <span class="text-[#C9A84C] font-semibold">10,400</span>
                    </div>
                    <div class="w-full bg-[#020D1A] rounded-full h-2">
                        <div class="bg-[#4A9FD4] h-2 rounded-full" style="width: 69%"></div>
                    </div>
                    <div class="text-right text-[10px] text-gray-500 mt-1">69%</div>
                </div>

                                <div>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-[#DADADA]">Dewa 19 Reunion Concert</span>
                        <span class="text-[#C9A84C] font-semibold">0</span>
                    </div>
                    <div class="w-full bg-[#020D1A] rounded-full h-2">
                        <div class="bg-[#4A9FD4] h-2 rounded-full" style="width: 0%"></div>
                    </div>
                    <div class="text-right text-[10px] text-gray-500 mt-1">0%</div>
                </div>

                                <div>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-[#DADADA]">BTS Permission To Dance</span>
                        <span class="text-[#C9A84C] font-semibold">50,000</span>
                    </div>
                    <div class="w-full bg-[#020D1A] rounded-full h-2">
                        <div class="bg-[#4A9FD4] h-2 rounded-full" style="width: 100%"></div>
                    </div>
                    <div class="text-right text-[10px] text-gray-500 mt-1">100%</div>
                </div>

                                <div>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-[#DADADA]">Maliq & D'Essentials</span>
                        <span class="text-[#C9A84C] font-semibold">24,000</span>
                    </div>
                    <div class="w-full bg-[#020D1A] rounded-full h-2">
                        <div class="bg-[#4A9FD4] h-2 rounded-full" style="width: 96%"></div>
                    </div>
                    <div class="text-right text-[10px] text-gray-500 mt-1">96%</div>
                </div>
            </div>
        </div>

                <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6">
            <h3 class="text-white font-bold mb-6">Daftar Konser Aktif</h3>
            
            <div class="space-y-4">
                                <div class="flex items-center justify-between pb-4 border-b border-[#202020]">
                    <div>
                        <p class="text-[#DADADA] text-sm font-medium">SZA SOS World Tour 2026</p>
                        <p class="text-[10px] text-gray-500">14 Jul - GBK Jakarta</p>
                    </div>
                    <div class="text-[#C9A84C] text-sm font-medium">18,420/25,000</div>
                    <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-[#4A9FD4] text-[#4A9FD4] text-[10px] font-bold bg-[#4A9FD4]/10 uppercase">PUBLISH</span>
                </div>

                                <div class="flex items-center justify-between pb-4 border-b border-[#202020]">
                    <div>
                        <p class="text-[#DADADA] text-sm font-medium">YUNG KAI World Tour 2026</p>
                        <p class="text-[10px] text-gray-500">21 Jul - Senayan Jakarta</p>
                    </div>
                    <div class="text-[#C9A84C] text-sm font-medium">10,400/15,000</div>
                    <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-[#4A9FD4] text-[#4A9FD4] text-[10px] font-bold bg-[#4A9FD4]/10 uppercase">PUBLISH</span>
                </div>

                                <div class="flex items-center justify-between pb-4 border-b border-[#202020]">
                    <div>
                        <p class="text-[#DADADA] text-sm font-medium">Dewa 19 Reunion Concert</p>
                        <p class="text-[10px] text-gray-500">18 Agust - JIEXPO Jakarta</p>
                    </div>
                    <div class="text-[#C9A84C] text-sm font-medium">0/12,000</div>
                    <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-[#C9A84C] text-[#C9A84C] text-[10px] font-bold bg-[#C9A84C]/10 uppercase">DRAFT</span>
                </div>

                                <div class="flex items-center justify-between pb-4 border-b border-[#202020]">
                    <div>
                        <p class="text-[#DADADA] text-sm font-medium">BTS Permission To Dance</p>
                        <p class="text-[10px] text-gray-500">10 Mar - GBK Jakarta</p>
                    </div>
                    <div class="text-[#C9A84C] text-sm font-medium">50,000/50,000</div>
                    <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-green-500 text-green-500 text-[10px] font-bold bg-green-500/10 uppercase">SELESAI</span>
                </div>

                                <div class="flex items-center justify-between pb-4">
                    <div>
                        <p class="text-[#DADADA] text-sm font-medium">Maliq & D'Essentials</p>
                        <p class="text-[10px] text-gray-500">8 Feb - Senayan Jakarta</p>
                    </div>
                    <div class="text-[#C9A84C] text-sm font-medium">24,000/25,000</div>
                    <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-green-500 text-green-500 text-[10px] font-bold bg-green-500/10 uppercase">SELESAI</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
