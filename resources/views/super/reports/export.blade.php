@extends('layouts.admin')
@section('title', 'Export Laporan')

@section('content')
<header class="p-8 pb-4">
    <h1 class="text-2xl font-bold text-[#C9A84C] mb-1">Export Laporan</h1>
    <p class="text-sm text-[#4A9FD4]">Kelola semua acara yang terdaftar di platform</p>
</header>

<div class="flex-1 p-8 pt-0 overflow-y-auto">
    
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
                <div class="lg:col-span-5 bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6 flex flex-col h-[calc(100vh-140px)] min-h-[600px]">
            <h3 class="text-white font-bold mb-1">Konfigurasi Laporan</h3>
            <p class="text-[10px] text-gray-400 mb-6">Atur isi dan format laporan PDF yang akan digenerate</p>
            
            <div class="space-y-6 flex-1">
                                <div>
                    <label class="block text-[#DADADA] text-xs font-medium mb-2">Jenis Laporan</label>
                    <div class="bg-[#020D1A] border border-[#C9A84C] rounded-lg p-3 flex items-start gap-3 cursor-pointer relative overflow-hidden">
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#C9A84C]"></div>
                        <svg class="w-5 h-5 text-[#C9A84C] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <div>
                            <p class="text-white text-sm font-medium">Rekap Keseluruhan</p>
                            <p class="text-[10px] text-gray-500">Semua konser semua periode</p>
                        </div>
                    </div>
                </div>

                                <div>
                    <label class="block text-[#DADADA] text-xs font-medium mb-2">Periode</label>
                    <div class="bg-[#020D1A] border border-[#4A9FD4]/50 rounded-lg py-2 px-3 flex items-center gap-2 cursor-pointer w-full max-w-[250px]">
                        <svg class="w-4 h-4 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span class="text-[#DADADA] text-sm">Jan 2026 - Des 2026</span>
                    </div>
                </div>

                                <div>
                    <label class="block text-[#DADADA] text-xs font-medium mb-3">Konten yang Disertakan</label>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <div class="w-4 h-4 rounded-sm border border-[#C9A84C] bg-[#C9A84C] flex items-center justify-center">
                                <svg class="w-3 h-3 text-[#020D1A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-sm text-white">Rekap total pendapatan</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <div class="w-4 h-4 rounded-sm border border-[#C9A84C] bg-[#C9A84C] flex items-center justify-center">
                                <svg class="w-3 h-3 text-[#020D1A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-sm text-white">Detail per kategori tiket</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <div class="w-4 h-4 rounded-sm border border-[#C9A84C] bg-[#C9A84C] flex items-center justify-center">
                                <svg class="w-3 h-3 text-[#020D1A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-sm text-white">Grafik penjualan harian</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer mt-4">
                            <div class="w-4 h-4 rounded-sm border border-gray-500 bg-[#020D1A]"></div>
                            <span class="text-sm text-gray-400">Data mentah (raw CSV)</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <div class="w-4 h-4 rounded-sm border border-gray-500 bg-[#020D1A]"></div>
                            <span class="text-sm text-gray-400">Daftar nama pembeli</span>
                        </label>
                    </div>
                </div>

                                <div>
                    <label class="block text-[#DADADA] text-xs font-medium mb-3">Format Output</label>
                    <div class="flex gap-3">
                        <button class="bg-[#C9A84C] text-[#020D1A] font-bold py-2 px-6 rounded-md flex items-center gap-2 text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            PDF ✓
                        </button>
                        <button class="bg-gray-600/30 text-gray-400 hover:text-white border border-gray-600 hover:border-gray-400 font-medium py-2 px-6 rounded-md flex items-center gap-2 text-sm transition">
                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            CSV
                        </button>
                        <button class="bg-gray-600/30 text-gray-400 hover:text-white border border-gray-600 hover:border-gray-400 font-medium py-2 px-6 rounded-md flex items-center gap-2 text-sm transition">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            XLS
                        </button>
                    </div>
                </div>
            </div>

                        <button class="w-full bg-[#C9A84C] hover:bg-[#b09141] text-[#020D1A] font-bold py-3 px-6 rounded-md flex items-center justify-center gap-2 transition mt-6">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Generate & Unduh Laporan PDF
            </button>
        </div>

                <div class="lg:col-span-7 space-y-6">
                        <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6 relative overflow-hidden h-[500px]">
                <h3 class="text-white font-bold mb-6">Preview Laporan</h3>
                
                                <div class="absolute left-6 right-6 bottom-6 top-16 bg-[#020D1A] border border-[#202020] rounded-lg p-6 overflow-hidden">
                    
                                        <div class="grid grid-cols-3 gap-4 mb-6">
                        <div class="bg-[#041830] p-3 rounded-lg border border-[#202020]">
                            <p class="text-[8px] text-gray-400 mb-1">Total Pendapatan</p>
                            <p class="text-[#C9A84C] text-sm font-bold">Rp 10,500,000,000</p>
                        </div>
                        <div class="bg-[#041830] p-3 rounded-lg border border-[#202020]">
                            <p class="text-[8px] text-gray-400 mb-1">Total Terjual</p>
                            <p class="text-white text-sm font-bold">18,420 tiket</p>
                        </div>
                        <div class="bg-[#041830] p-3 rounded-lg border border-[#202020]">
                            <p class="text-[8px] text-gray-400 mb-1">Konversi</p>
                            <p class="text-white text-sm font-bold">73%</p>
                        </div>
                    </div>

                                        <div class="mb-6">
                        <p class="text-[8px] text-gray-400 font-bold tracking-widest uppercase mb-2">PENJUALAN HARIAN</p>
                        <div class="flex items-end justify-between gap-1.5 h-20 border-b border-[#202020] pb-1">
                            <div class="w-full bg-[#C9A84C]" style="height: 20%"></div>
                            <div class="w-full bg-[#C9A84C]" style="height: 40%"></div>
                            <div class="w-full bg-[#C9A84C]" style="height: 15%"></div>
                            <div class="w-full bg-[#C9A84C]" style="height: 60%"></div>
                            <div class="w-full bg-[#C9A84C]" style="height: 30%"></div>
                            <div class="w-full bg-[#C9A84C]" style="height: 80%"></div>
                            <div class="w-full bg-[#C9A84C]" style="height: 45%"></div>
                            <div class="w-full bg-[#C9A84C]" style="height: 65%"></div>
                            <div class="w-full bg-[#C9A84C]" style="height: 25%"></div>
                            <div class="w-full bg-[#C9A84C]" style="height: 50%"></div>
                            <div class="w-full bg-[#C9A84C]" style="height: 70%"></div>
                            <div class="w-full bg-[#C9A84C]" style="height: 40%"></div>
                            <div class="w-full bg-[#C9A84C]" style="height: 85%"></div>
                            <div class="w-full bg-[#C9A84C]" style="height: 55%"></div>
                        </div>
                    </div>

                                        <div>
                        <p class="text-[8px] text-gray-400 font-bold tracking-widest uppercase mb-2">DETAIL PER KATEGORI TIKET</p>
                        <table class="w-full text-[10px] text-left">
                            <thead class="bg-[#041830] text-[#4A9FD4]">
                                <tr>
                                    <th class="py-1 px-2 font-medium rounded-l-md">Kategori</th>
                                    <th class="py-1 px-2 font-medium">Harga</th>
                                    <th class="py-1 px-2 font-medium">Kapasitas</th>
                                    <th class="py-1 px-2 font-medium">Terjual</th>
                                    <th class="py-1 px-2 font-medium rounded-r-md">%</th>
                                </tr>
                            </thead>
                            <tbody class="text-[#DADADA] divide-y divide-[#202020]">
                                <tr>
                                    <td class="py-1.5 px-2">Festival</td>
                                    <td class="py-1.5 px-2">Rp 850,000</td>
                                    <td class="py-1.5 px-2">12,000</td>
                                    <td class="py-1.5 px-2">11,200</td>
                                    <td class="py-1.5 px-2 text-[#C9A84C]">80%</td>
                                </tr>
                                <tr>
                                    <td class="py-1.5 px-2">VIP</td>
                                    <td class="py-1.5 px-2">Rp 1,500,000</td>
                                    <td class="py-1.5 px-2">9,000</td>
                                    <td class="py-1.5 px-2">8,600</td>
                                    <td class="py-1.5 px-2 text-[#C9A84C]">45%</td>
                                </tr>
                                <tr>
                                    <td class="py-1.5 px-2 border-b-0">VVIP</td>
                                    <td class="py-1.5 px-2 border-b-0">Rp 2,500,000</td>
                                    <td class="py-1.5 px-2 border-b-0">4,000</td>
                                    <td class="py-1.5 px-2 border-b-0">4,000</td>
                                    <td class="py-1.5 px-2 border-b-0 text-[#C9A84C]">100%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                                        <div class="absolute bottom-4 left-6 right-6 flex justify-between items-end">
                        <div class="text-[7px] text-gray-500">
                            Dokumen ini dibuat otomatis oleh sistem TIKETARA.com<br>
                            Halaman 1 dari 4 • Confidential
                        </div>
                    </div>
                </div>
            </div>

                        <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6 flex flex-col justify-center h-[120px]">
                <h3 class="text-white font-bold mb-4">Riwayat Unduhan</h3>
                
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded bg-gray-800 flex items-center justify-center text-red-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm text-red-400 font-medium cursor-pointer hover:underline">Rekap.pdf</p>
                        <p class="text-[10px] text-gray-400">3 hari lalu • 2.4 MB</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
