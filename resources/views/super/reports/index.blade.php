@extends('layouts.admin')
@section('title', 'Laporan')

@section('content')
<header class="p-8 pb-4">
    <h1 class="text-2xl font-bold text-[#C9A84C] mb-1">Laporan</h1>
    <p class="text-sm text-[#4A9FD4]">Kelola semua acara yang terdaftar di platform</p>
</header>

<div class="flex-1 p-8 pt-0 overflow-y-auto">
    
    <div class="flex flex-wrap gap-4 mb-6 items-center">
        <div class="relative flex-1 min-w-[200px]">
            <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <input type="text" id="searchInput" onkeyup="filterData()" placeholder="Cari nama acara atau kota..." class="w-full bg-white text-black text-sm rounded-md py-2 pl-9 pr-4 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]">
        </div>
        
        <select id="statusFilter" onchange="filterData()" class="bg-white text-black text-sm rounded-md py-2 px-4 focus:outline-none focus:ring-2 focus:ring-[#C9A84C] cursor-pointer appearance-none pr-8 relative">
            <option value="">Status: Semua</option>
            <option value="UPCOMING">Upcoming</option>
            <option value="ONGOING">Ongoing</option>
            <option value="SELESAI">Selesai</option>
        </select>

        <select id="categoryFilter" onchange="filterData()" class="bg-white text-black text-sm rounded-md py-2 px-4 focus:outline-none focus:ring-2 focus:ring-[#C9A84C] cursor-pointer appearance-none pr-8">
            <option value="">Kategori: Semua</option>
            @php 
                $categories = $events->pluck('category')->unique(); 
            @endphp
            @foreach($categories as $cat)
                <option value="{{ strtoupper($cat) }}">{{ $cat }}</option>
            @endforeach
        </select>

        <select id="yearFilter" onchange="filterData()" class="bg-white text-black text-sm rounded-md py-2 px-4 focus:outline-none focus:ring-2 focus:ring-[#C9A84C] cursor-pointer appearance-none pr-8">
            <option value="">Tahun: Semua</option>
            @php
                $years = $events->map(function($e) {
                    return \Carbon\Carbon::parse($e->event_date)->format('Y');
                })->unique()->sortDesc();
            @endphp
            @foreach($years as $year)
                <option value="{{ $year }}">{{ $year }}</option>
            @endforeach
        </select>

        <select id="sortFilter" onchange="filterData()" class="bg-white text-black text-sm rounded-md py-2 px-4 focus:outline-none focus:ring-2 focus:ring-[#C9A84C] cursor-pointer appearance-none pr-8">
            <option value="latest">Urutkan: Terbaru</option>
            <option value="oldest">Terlama</option>
        </select>
    </div>

    <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 overflow-x-auto">
        <table class="w-full text-left text-sm whitespace-nowrap min-w-max" id="eventTable">
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
                @php $activeIndex = 1; @endphp
                @forelse($events as $event)
                    @if(strtoupper($event->status) !== 'DRAFT')
                        @php
                            $ticketPaidCount = $event->orders ? $event->orders->where('status', 'paid')->sum('quantity') : 0;
                            $totalRevenue = $event->orders ? $event->orders->where('status', 'paid')->sum('total_amount') : 0;
                            $maxCapacity = $event->ticketTypes ? $event->ticketTypes->sum('capacity') : 0;

                            $eventDate = \Carbon\Carbon::parse($event->event_date);
                            if ($eventDate->isToday()) {
                                $liveStatus = 'ONGOING';
                            } elseif ($eventDate->isPast()) {
                                $liveStatus = 'SELESAI';
                            } else {
                                $liveStatus = 'UPCOMING';
                            }
                        @endphp
                        {{-- Ditambahkan data-year di bawah ini --}}
                        <tr class="event-row hover:bg-white/5 transition"
                            data-title="{{ strtolower($event->title) }}" 
                            data-city="{{ strtolower($event->city) }}"
                            data-venue="{{ strtolower($event->venue) }}"
                            data-category="{{ strtoupper($event->category) }}" 
                            data-status="{{ $liveStatus }}"
                            data-year="{{ $eventDate->format('Y') }}"
                            data-timestamp="{{ strtotime($event->event_date) }}">
                            
                            <td class="px-6 py-4 text-[#DADADA] row-number">{{ $activeIndex++ }}</td>
                            <td class="px-6 py-4 font-medium text-white max-w-xs truncate">{{ $event->title }}</td>
                            <td class="px-6 py-4 text-[#DADADA]">
                                {{ $eventDate->format('d M Y') }}<br>
                                <span class="text-xs text-gray-400">{{ $eventDate->format('H:i') }} WIB</span>
                            </td>
                            <td class="px-6 py-4 text-[#DADADA]">{{ $event->venue }}, {{ $event->city }}</td>
                            <td class="px-6 py-4 text-[#DADADA]">{{ $event->category }}</td>
                            <td class="px-6 py-4 text-[#DADADA]">{{ number_format($ticketPaidCount) }}/{{ number_format($maxCapacity) }}</td>
                            <td class="px-6 py-4 text-[#DADADA]">
                                {{ $totalRevenue > 0 ? 'Rp ' . number_format($totalRevenue, 0, ',', '.') : '-' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($liveStatus === 'UPCOMING')
                                    <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-[#C9A84C] text-[#C9A84C] text-xs font-bold bg-[#C9A84C]/10 uppercase">UPCOMING</span>
                                @elseif($liveStatus === 'ONGOING')
                                    <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-[#4A9FD4] text-[#4A9FD4] text-xs font-bold bg-[#4A9FD4]/10 uppercase">ONGOING</span>
                                @else
                                    <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-green-500 text-green-500 text-xs font-bold bg-green-500/10 uppercase">SELESAI</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('super.reports.detail', $event->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium transition" title="Lihat Detail Laporan">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <span>Detail Laporan</span>
                                </a>
                            </td>
                        </tr>
                    @endif
                @empty
                    <tr id="emptyPlaceholder">
                        <td colspan="9" class="px-6 py-8 text-center text-gray-400">Tidak ada data acara yang terdaftar.</td>
                    </tr>
                @endforelse
                
                <tr id="noMatchMessage" class="hidden">
                    <td colspan="9" class="px-6 py-8 text-center text-gray-400">Tidak ada data laporan acara yang cocok dengan filter pencarian Anda.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    function filterData() {
        const searchVal = document.getElementById('searchInput').value.toLowerCase();
        const statusVal = document.getElementById('statusFilter').value;
        const categoryVal = document.getElementById('categoryFilter').value;
        const yearVal = document.getElementById('yearFilter').value; // Ambil nilai filter tahun
        const sortVal = document.getElementById('sortFilter').value;
        
        const rows = Array.from(document.querySelectorAll('.event-row'));
        let visibleCount = 0;
        let activeIndex = 1;

        rows.forEach(row => {
            const title = row.getAttribute('data-title');
            const city = row.getAttribute('data-city');
            const venue = row.getAttribute('data-venue');
            const status = row.getAttribute('data-status');
            const category = row.getAttribute('data-category');
            const year = row.getAttribute('data-year'); // Ambil nilai tahun dari baris tabel

            const matchSearch = title.includes(searchVal) || city.includes(searchVal) || venue.includes(searchVal);
            const matchStatus = statusVal === "" || status === statusVal;
            const matchCategory = categoryVal === "" || category === categoryVal;
            const matchYear = yearVal === "" || year === yearVal; // Cek kecocokan tahun

            if (matchSearch && matchStatus && matchCategory && matchYear) {
                row.style.display = "table-row";
                row.querySelector('.row-number').innerText = activeIndex++;
                visibleCount++;
            } else {
                row.style.display = "none";
            }
        });

        // Tampilkan pesan kosong jika tidak ada yang cocok
        const msgEmpty = document.getElementById('noMatchMessage');
        if (visibleCount === 0 && rows.length > 0) {
            msgEmpty.classList.remove('hidden');
            msgEmpty.style.display = "table-row";
        } else {
            msgEmpty.classList.add('hidden');
            msgEmpty.style.display = "none";
        }

        // Jalankan Sorter DOM Table Row
        const tbody = document.querySelector('#eventTable tbody');
        rows.sort((a, b) => {
            const timeA = parseInt(a.getAttribute('data-timestamp'));
            const timeB = parseInt(b.getAttribute('data-timestamp'));
            return sortVal === 'oldest' ? timeA - timeB : timeB - timeA;
        }).forEach(sortedRow => tbody.appendChild(sortedRow));
    }
</script>
@endsection