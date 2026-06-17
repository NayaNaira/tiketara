@extends('layouts.admin')
@section('title', 'Detail Acara')

@section('content')
<header class="p-8 pb-4 flex justify-between items-center border-b border-[#202020] bg-[#020D1A] sticky top-0 z-10">
    <div class="flex items-center gap-4">
        <a href="{{ url()->previous() }}" class="w-10 h-10 rounded-full bg-[#041830] border border-[#202020] flex items-center justify-center text-[#DADADA] hover:bg-white/10 transition shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-[#C9A84C] mb-1">Detail Acara - {{ $event->title }}</h1>
            <p class="text-sm text-[#4A9FD4]">Kelola semua acara yang terdaftar di platform</p>
        </div>
    </div>
    <div class="flex gap-3">
        <button class="bg-white border border-gray-300 text-red-500 hover:bg-red-50 text-sm font-semibold py-2 px-6 rounded-md transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            Tolak
        </button>
        <button class="bg-white border border-gray-300 text-green-600 hover:bg-green-50 text-sm font-semibold py-2 px-6 rounded-md transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            Setujui
        </button>
        <button class="bg-[#4A9FD4] text-white hover:bg-[#3b85b5] text-sm font-semibold py-2 px-6 rounded-md transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
            Edit
        </button>
    </div>
</header>

<div class="flex-1 p-8 overflow-y-auto space-y-6">

        <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6 flex justify-between">
        <div>
            <div class="flex items-center gap-2 text-[#4A9FD4] text-xs font-bold mb-2 uppercase tracking-wide">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
                {{ $event->title }}
            </div>
            <h2 class="text-3xl font-bold text-[#C9A84C] mb-4 font-['Playfair_Display']">Save Or Ship World Tour</h2>
            
            <div class="space-y-2 text-sm text-[#DADADA] mb-6">
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span>14 Juli 2026 • 19:30 WIB</span>
                </div>
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span>{{ $event->venue_name }}, {{ $event->city }}</span>
                </div>
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <span>Organizer: MyMusic Entertainment</span>
                </div>
            </div>

            <div class="flex gap-2">
                <span class="px-4 py-1 rounded-full border border-[#4A9FD4] text-[#4A9FD4] text-xs font-bold bg-[#4A9FD4]/10 uppercase">PUBLISH</span>
                <span class="px-4 py-1 rounded-full border border-gray-400 text-gray-300 text-xs font-bold bg-white/5 uppercase">{{ $event->category }}</span>
                <span class="px-4 py-1 rounded-full border border-gray-400 text-gray-300 text-xs font-bold bg-white/5 uppercase">12+</span>
            </div>
        </div>
        
        <div class="w-64 h-40 rounded-xl overflow-hidden hidden lg:block">
                        <img src="https://images.unsplash.com/photo-1516280440502-120042784eb4?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover">
        </div>
    </div>

        <div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-2">
            <div class="bg-[#041830] rounded-xl p-4 border border-[#4A9FD4]/30">
                <div class="flex gap-3 mb-1">
                    <svg class="w-5 h-5 text-[#C9A84C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    <p class="text-[#DADADA] text-sm font-medium">Tiket Terjual</p>
                </div>
                <h3 class="text-2xl font-bold text-[#C9A84C]">18,420</h3>
                <p class="text-[10px] text-gray-400">dari 25,000 kapasitas</p>
            </div>
            <div class="bg-[#041830] rounded-xl p-4 border border-[#4A9FD4]/30">
                <div class="flex gap-3 mb-1">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    <p class="text-[#DADADA] text-sm font-medium">Sisa Tiket</p>
                </div>
                <h3 class="text-2xl font-bold text-[#C9A84C]">6,580</h3>
                <p class="text-[10px] text-gray-400">26.3% masih tersedia</p>
            </div>
            <div class="bg-[#041830] rounded-xl p-4 border border-[#4A9FD4]/30">
                <div class="flex gap-3 mb-1">
                    <svg class="w-5 h-5 text-[#C9A84C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-[#DADADA] text-sm font-medium">Total Pendapatan</p>
                </div>
                <h3 class="text-2xl font-bold text-[#C9A84C]">Rp 10.5M</h3>
                <p class="text-[10px] text-gray-400">Estimasi: Rp 11M</p>
            </div>
            <div class="bg-[#041830] rounded-xl p-4 border border-[#4A9FD4]/30">
                <div class="flex gap-3 mb-1">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    <p class="text-[#DADADA] text-sm font-medium">Konversi Tiket</p>
                </div>
                <h3 class="text-2xl font-bold text-white">73.7%</h3>
                <p class="text-[10px] text-gray-400">Lebih tinggi rata-rata</p>
            </div>
        </div>
                <div class="w-full bg-[#020D1A] rounded-full h-1.5 flex items-center pr-4">
            <div class="bg-[#4A9FD4] h-1.5 rounded-full" style="width: 73.7%"></div>
            <span class="text-[10px] text-white ml-2">73.7%</span>
        </div>
    </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
                <div class="lg:col-span-7 space-y-6">
            
                        <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6">
                <h3 class="text-white font-bold mb-4 border-b border-[#202020] pb-2">Informasi Konser</h3>
                
                <table class="w-full text-sm text-[#DADADA]">
                    <tbody class="divide-y divide-[#202020]">
                        <tr>
                            <td class="py-3 w-1/3">Nama Konser</td>
                            <td class="py-3 font-medium text-white">{{ $event->title }}</td>
                        </tr>
                        <tr>
                            <td class="py-3">Penyelenggara</td>
                            <td class="py-3 text-white">MyMusic Entertainment Sdn. Bhd.</td>
                        </tr>
                        <tr>
                            <td class="py-3">Kategori</td>
                            <td class="py-3 text-white">{{ $event->category }}</td>
                        </tr>
                        <tr>
                            <td class="py-3">Tanggal</td>
                            <td class="py-3 text-white">14 Juli 2026</td>
                        </tr>
                        <tr>
                            <td class="py-3">Waktu Mulai</td>
                            <td class="py-3 text-white">19:30 WIB (Gates open 17:00)</td>
                        </tr>
                        <tr>
                            <td class="py-3">Venue</td>
                            <td class="py-3 text-white">Indonesia Arena Gelora Bung Karno</td>
                        </tr>
                        <tr>
                            <td class="py-3">Kota</td>
                            <td class="py-3 text-white">Jakarta Selatan, DKI Jakarta</td>
                        </tr>
                        <tr>
                            <td class="py-3">Kapasitas</td>
                            <td class="py-3 text-white">25,000 penonton</td>
                        </tr>
                        <tr>
                            <td class="py-3">Batas Usia</td>
                            <td class="py-3 text-white">12+</td>
                        </tr>
                        <tr>
                            <td class="py-3 border-b-0">Website</td>
                            <td class="py-3 border-b-0 text-white hover:text-[#4A9FD4] cursor-pointer">www.myliveasia.com/sza-jakarta</td>
                        </tr>
                    </tbody>
                </table>
            </div>

                        <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6">
                <h3 class="text-white font-bold mb-6">Status Approval</h3>
                
                <div class="relative flex justify-between">
                                        <div class="absolute top-1/2 left-0 w-full h-1 bg-[#202020] -translate-y-1/2"></div>
                    <div class="absolute top-1/2 left-0 w-[100%] h-1 bg-[#4A9FD4] -translate-y-1/2"></div>
                    
                                        <div class="relative z-10 flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full bg-[#4A9FD4] text-white flex items-center justify-center font-bold text-sm mb-2">1</div>
                        <span class="text-[10px] text-[#DADADA]">Diajukan Organizer</span>
                    </div>
                    
                                        <div class="relative z-10 flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full bg-[#4A9FD4] text-white flex items-center justify-center font-bold text-sm mb-2">2</div>
                        <span class="text-[10px] text-[#DADADA]">Review Admin</span>
                    </div>
                    
                                        <div class="relative z-10 flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full bg-[#4A9FD4] text-white flex items-center justify-center font-bold text-sm mb-2">3</div>
                        <span class="text-[10px] text-[#DADADA]">Disetujui</span>
                    </div>

                                        <div class="relative z-10 flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full bg-white text-[#041830] flex items-center justify-center font-bold text-sm mb-2">4</div>
                        <span class="text-[10px] text-white font-medium">Dipublikasi</span>
                    </div>
                </div>
            </div>

        </div>

                <div class="lg:col-span-5 space-y-6">
            
                        <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6">
                <h3 class="text-white font-bold mb-4 border-b border-[#202020] pb-2">Kategori Tiket</h3>
                
                <div class="space-y-4">
                                        <div class="flex items-center gap-4 text-sm">
                        <div class="w-1.5 h-10 bg-[#4A9FD4] rounded-full"></div>
                        <div class="flex-1">
                            <p class="text-white">Festival</p>
                        </div>
                        <div class="text-[#DADADA]">Rp 850,000</div>
                        <div class="text-white font-medium text-right w-24">1,200/2,000</div>
                        <div class="w-16">
                            <div class="w-full bg-[#020D1A] rounded-full h-1.5">
                                <div class="bg-[#4A9FD4] h-1.5 rounded-full" style="width: 60%"></div>
                            </div>
                        </div>
                        <div class="text-[10px] text-gray-400 w-6">60%</div>
                    </div>

                                        <div class="flex items-center gap-4 text-sm">
                        <div class="w-1.5 h-10 bg-[#C9A84C] rounded-full"></div>
                        <div class="flex-1">
                            <p class="text-white">VIP</p>
                        </div>
                        <div class="text-[#DADADA]">Rp 1,500,000</div>
                        <div class="text-white font-medium text-right w-24">3,800/9,000</div>
                        <div class="w-16">
                            <div class="w-full bg-[#020D1A] rounded-full h-1.5">
                                <div class="bg-[#4A9FD4] h-1.5 rounded-full" style="width: 42%"></div>
                            </div>
                        </div>
                        <div class="text-[10px] text-gray-400 w-6">42%</div>
                    </div>

                                        <div class="flex items-center gap-4 text-sm">
                        <div class="w-1.5 h-10 bg-[#4A9FD4] rounded-full"></div>
                        <div class="flex-1">
                            <p class="text-white">VVIP</p>
                        </div>
                        <div class="text-[#DADADA]">Rp 2,500,000</div>
                        <div class="text-white font-medium text-right w-24">4,000/4,000</div>
                        <div class="w-16">
                            <div class="w-full bg-[#020D1A] rounded-full h-1.5">
                                <div class="bg-[#4A9FD4] h-1.5 rounded-full" style="width: 100%"></div>
                            </div>
                        </div>
                        <div class="text-[10px] text-gray-400 w-6">100%</div>
                    </div>
                </div>
            </div>

                        <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6 h-64 flex flex-col">
                <h3 class="text-white font-bold mb-1 border-b border-[#202020] pb-2">Statistik Penjualan</h3>
                <p class="text-[10px] text-gray-400 mb-4">Penjualan Harian (Minggu Terakhir)</p>
                
                <div class="flex-1 flex items-end justify-between gap-2">
                    <div class="flex flex-col items-center w-full">
                        <div class="w-full bg-white rounded-t-sm" style="height: 20%"></div>
                        <span class="text-[10px] text-[#DADADA] mt-2">Sen</span>
                    </div>
                    <div class="flex flex-col items-center w-full">
                        <div class="w-full bg-white rounded-t-sm" style="height: 40%"></div>
                        <span class="text-[10px] text-[#DADADA] mt-2">Sel</span>
                    </div>
                    <div class="flex flex-col items-center w-full">
                        <div class="w-full bg-white rounded-t-sm" style="height: 30%"></div>
                        <span class="text-[10px] text-[#DADADA] mt-2">Rab</span>
                    </div>
                    <div class="flex flex-col items-center w-full">
                        <div class="w-full bg-white rounded-t-sm" style="height: 55%"></div>
                        <span class="text-[10px] text-[#DADADA] mt-2">Kam</span>
                    </div>
                    <div class="flex flex-col items-center w-full">
                        <div class="w-full bg-white rounded-t-sm" style="height: 35%"></div>
                        <span class="text-[10px] text-[#DADADA] mt-2">Jum</span>
                    </div>
                    <div class="flex flex-col items-center w-full">
                        <div class="w-full bg-white rounded-t-sm" style="height: 85%"></div>
                        <span class="text-[10px] text-[#DADADA] mt-2">Sab</span>
                    </div>
                    <div class="flex flex-col items-center w-full">
                        <div class="w-full bg-white rounded-t-sm" style="height: 55%"></div>
                        <span class="text-[10px] text-[#DADADA] mt-2">Min</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
