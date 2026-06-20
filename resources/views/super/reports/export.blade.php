@extends('layouts.admin')
@section('title', 'Export Laporan')

@section('content')
<header class="p-8 pb-4">
    <h1 class="text-2xl font-bold text-[#C9A84C] mb-1">Export Laporan</h1>
    <p class="text-sm text-[#4A9FD4]">Konfigurasi dan unduh berkas rekapitulasi performa platform</p>
</header>

<div class="flex-1 p-8 pt-0 overflow-y-auto">
    {{-- Hitungan data agregat asli dari data event untuk keperluan preview --}}
    @php
        $ticketPaidCount = $event->orders ? $event->orders->where('status', 'paid')->sum('quantity') : 0;
        $totalRevenue = $event->orders ? $event->orders->where('status', 'paid')->sum('total_amount') : 0;
        $maxCapacity = $event->ticketTypes ? $event->ticketTypes->sum('capacity') : 0;
        
        // Menghitung rasio sukses penjualan tiket asli
        $successRatio = $maxCapacity > 0 ? round(($ticketPaidCount / $maxCapacity) * 100, 1) : 0;
    @endphp

    <form action="{{ route('super.export') }}" method="GET" class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <input type="hidden" name="event_id" value="{{ $event->id }}">
        
        <div class="lg:col-span-5 bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6 flex flex-col justify-between min-h-[500px]">
            <div>
                <h3 class="text-white font-bold mb-1">Konfigurasi Laporan</h3>
                <p class="text-[10px] text-gray-400 mb-6">Atur isi dan format laporan berkas yang akan digenerate</p>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-[#DADADA] text-xs font-medium mb-2">Nama Acara Terpilih</label>
                        <input type="text" readonly value="{{ $event->title }}" class="w-full bg-[#020D1A]/50 border border-[#4A9FD4]/30 rounded-lg p-2.5 text-sm text-gray-400 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-[#DADADA] text-xs font-medium mb-2">Periode Tahun</label>
                        <div class="relative max-w-[250px]">
                            <select name="period_year" class="w-full bg-[#020D1A] border border-[#4A9FD4]/50 rounded-lg py-2 pl-8 pr-3 text-sm text-[#DADADA] appearance-none focus:outline-none focus:border-[#4A9FD4]">
                                <option value="{{ \Carbon\Carbon::parse($event->event_date)->format('Y') }}">{{ \Carbon\Carbon::parse($event->event_date)->format('Y') }}</option>
                            </select>
                            <div class="absolute left-3 top-3 pointer-events-none">
                                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[#DADADA] text-xs font-medium mb-3">Konten yang Disertakan</label>
                        <div class="space-y-3">
                            <label class="flex items-center gap-3 cursor-pointer select-none text-sm text-white">
                                <input type="checkbox" name="include[]" value="revenue" checked class="accent-[#C9A84C] w-4 h-4 rounded">
                                <span>Rekap total pendapatan</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer select-none text-sm text-white">
                                <input type="checkbox" name="include[]" value="categories" checked class="accent-[#C9A84C] w-4 h-4 rounded">
                                <span>Detail per kategori tiket</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer select-none text-sm text-white">
                                <input type="checkbox" name="include[]" value="charts" checked class="accent-[#C9A84C] w-4 h-4 rounded">
                                <span>Grafik akumulasi penjualan</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer select-none text-sm text-gray-400">
                                <input type="checkbox" name="include[]" value="raw_buyers" class="accent-[#C9A84C] w-4 h-4 rounded">
                                <span>Daftar nama manifestasi pembeli</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[#DADADA] text-xs font-medium mb-3">Format Output</label>
                        <div class="flex gap-3">
                            <label class="flex-1">
                                <input type="radio" name="format" value="pdf" checked class="sr-only peer">
                                <div class="text-center bg-gray-600/20 text-gray-400 border border-gray-600 py-2 px-4 rounded-md text-sm font-bold cursor-pointer peer-checked:bg-[#C9A84C] peer-checked:text-[#020D1A] peer-checked:border-[#C9A84C] transition">
                                    PDF
                                </div>
                            </label>
                            <label class="flex-1">
                                <input type="radio" name="format" value="xlsx" class="sr-only peer">
                                <div class="text-center bg-gray-600/20 text-gray-400 border border-gray-600 py-2 px-4 rounded-md text-sm font-bold cursor-pointer peer-checked:bg-green-700 peer-checked:text-white peer-checked:border-green-700 transition">
                                    XLSX
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full bg-[#C9A84C] hover:bg-[#b09141] text-[#020D1A] font-bold py-3 px-6 rounded-md flex items-center justify-center gap-2 transition mt-6 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Generate & Ekspor Dokumen
            </button>
        </div>

        <div class="lg:col-span-7 space-y-6">
            <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6 relative overflow-hidden h-[500px]">
                <h3 class="text-white font-bold mb-6">Preview Laporan</h3>
                
                <div class="absolute left-6 right-6 bottom-6 top-16 bg-[#020D1A] border border-[#202020] rounded-lg p-6 overflow-hidden select-none opacity-85">
                    
                    {{-- STATISTIK ASLI DARI EVENT --}}
                    <div class="grid grid-cols-3 gap-4 mb-6">
                        <div class="bg-[#041830] p-3 rounded-lg border border-[#202020]">
                            <p class="text-[8px] text-gray-400 mb-1">Total Pendapatan Riil</p>
                            <p class="text-[#C9A84C] text-sm font-bold">
                                {{ $totalRevenue > 0 ? 'Rp ' . number_format($totalRevenue, 0, ',', '.') : 'Rp 0' }}
                            </p>
                        </div>
                        <div class="bg-[#041830] p-3 rounded-lg border border-[#202020]">
                            <p class="text-[8px] text-gray-400 mb-1">Tiket Terjual</p>
                            <p class="text-white text-sm font-bold">{{ number_format($ticketPaidCount) }} / {{ number_format($maxCapacity) }}</p>
                        </div>
                        <div class="bg-[#041830] p-3 rounded-lg border border-[#202020]">
                            <p class="text-[8px] text-gray-400 mb-1">Target Terpenuhi</p>
                            <p class="text-white text-sm font-bold">{{ $successRatio }}%</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <p class="text-[8px] text-gray-400 font-bold tracking-widest uppercase mb-2">PROGRESIVITAS GRAFIK PENJUALAN EVENT</p>
                        <div class="flex items-end justify-between gap-2 h-20 border-b border-[#202020] pb-1">
                            {{-- Visualisasi bar grafik buatan mengikuti skala persentase rasio keberhasilan penjualan --}}
                            @for($i = 1; $i <= 12; $i++)
                                @php 
                                    $simulatedHeight = $successRatio > 0 ? ($successRatio / 12) * $i : 5;
                                    if($simulatedHeight > 100) $simulatedHeight = 100;
                                @endphp
                                <div class="w-full bg-[#C9A84C]/80 hover:bg-[#C9A84C] transition-all rounded-t-sm" style="height: {{ $simulatedHeight }}%"></div>
                            @endfor
                        </div>
                    </div>

                    <div>
                        <p class="text-[8px] text-gray-400 font-bold tracking-widest uppercase mb-2">RINGKASAN TIKET PER KATEGORI (TICKET TYPES)</p>
                        <div class="max-h-[160px] overflow-y-auto custom-scrollbar">
                            <table class="w-full text-[10px] text-left">
                                <thead class="bg-[#041830] text-[#4A9FD4] sticky top-0">
                                    <tr>
                                        <th class="py-1 px-2 font-medium rounded-l-md">Nama Kelas</th>
                                        <th class="py-1 px-2 font-medium">Harga Tiket</th>
                                        <th class="py-1 px-2 font-medium">Kapasitas Sisa</th>
                                    </tr>
                                </thead>
                                <tbody class="text-[#DADADA] divide-y divide-[#202020]">
                                    {{-- LOOPING DATA TICKET TYPES ASLI DARI EVENT --}}
                                    @forelse($event->ticketTypes ?? [] as $type)
                                        @php
                                            // Menghitung tiket terjual khusus kategori/type ini
                                            $typeSold = $event->orders ? $event->orders->where('status', 'paid')->flatMap->ticketDetails->where('ticket_type_id', $type->id)->count() : 0;
                                            $availableStock = $type->capacity - $typeSold;
                                        @endphp
                                        <tr>
                                            <td class="py-1.5 px-2 font-medium text-white">{{ $type->name }}</td>
                                            <td class="py-1.5 px-2">Rp {{ number_format($type->price, 0, ',', '.') }}</td>
                                            <td class="py-1.5 px-2">
                                                <span class="{{ $availableStock < 10 ? 'text-red-400 font-bold' : 'text-gray-300' }}">
                                                    {{ number_format($availableStock) }} Sisa / {{ number_format($type->capacity) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="py-3 text-center text-gray-500 italic">Tidak ada kategori jenis tiket terdaftar.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="absolute bottom-4 left-6 right-6 flex justify-between items-end">
                        <div class="text-[7px] text-gray-500 italic">
                            Dokumen ringkasan ini dimuat otomatis oleh sistem inti TIKETARA<br>
                            Periode berjalan 2026 • Hak Akses Manajemen Super Admin
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6 flex flex-col justify-center h-[120px]">
                <h3 class="text-white font-bold mb-3 text-sm">Target Manajemen Berkas</h3>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded bg-red-500/10 border border-red-500/20 flex items-center justify-center text-red-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-300 font-medium">Laporan_Eksklusif_{{ Str::slug($event->title, '_') }}_2026.pdf</p>
                        <p class="text-[10px] text-gray-500">Berkas dikunci otomatis berdasarkan target ID data: #{{ $event->id }}</p>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection