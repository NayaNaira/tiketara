@extends('layouts.admin')
@section('title', 'Daftar Acara')

@section('content')
<header class="p-8 pb-4">
    <h1 class="text-2xl font-bold text-[#C9A84C] mb-1">Daftar Acara</h1>
    <p class="text-sm text-[#4A9FD4]">Kelola semua acara yang terdaftar di platform</p>
</header>

<div class="flex-1 p-8 pt-0 overflow-y-auto">
    <div class="flex flex-wrap gap-4 mb-6 items-center">
        <div class="relative flex-1 min-w-[200px]">
            <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Cari nama acara atau kota..." class="w-full bg-white text-black text-sm rounded-md py-2 pl-9 pr-4 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]">
        </div>
        
        <select id="statusFilter" onchange="filterTable()" class="bg-white text-black text-sm rounded-md py-2 px-4 focus:outline-none focus:ring-2 focus:ring-[#C9A84C] cursor-pointer appearance-none pr-8">
            <option value="">Status: Semua</option>
            <option value="APPROVED">Approved</option>
            <option value="PENDING">Pending</option>
            <option value="REJECTED">Ditolak</option>
        </select>

        <select id="categoryFilter" onchange="filterTable()" class="bg-white text-black text-sm rounded-md py-2 px-4 focus:outline-none focus:ring-2 focus:ring-[#C9A84C] cursor-pointer appearance-none pr-8">
            <option value="">Kategori: Semua</option>
            @php 
                $categories = $events->pluck('category')->unique(); 
            @endphp
            @foreach($categories as $cat)
                <option value="{{ strtoupper($cat) }}">{{ $cat }}</option>
            @endforeach
        </select>

        <div class="bg-white text-black text-sm rounded-md py-2 px-4 flex items-center gap-2 cursor-pointer">
            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span>Periode Aktif: 2026</span>
        </div>
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
                @forelse ($events as $index => $event)
                    @php
                        $totalSold = $event->ticketTypes->sum('sold');
                        $totalQuota = $event->ticketTypes->sum('quota');
                        $totalRevenue = $event->ticketTypes->sum(fn($ticket) => $ticket->sold * $ticket->price);
                    @endphp

                    <tr class="event-row hover:bg-white/5 transition" 
                        data-title="{{ strtolower($event->title) }}" 
                        data-city="{{ strtolower($event->city) }}"
                        data-category="{{ strtoupper($event->category) }}" 
                        data-status="{{ strtoupper($event->status) }}">
                        
                        <td class="px-6 py-4 text-[#DADADA] row-number">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 font-medium text-white max-w-xs truncate">{{ $event->title }}</td>
                        <td class="px-6 py-4 text-[#DADADA]">
                            {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->translatedFormat('d M Y') : '-' }}
                            <br>
                            <span class="text-xs text-gray-400">
                                {{ $event->start_time ? date('H:i', strtotime($event->start_time)) : '' }} WIB
                            </span>
                        </td>
                        <td class="px-6 py-4 text-[#DADADA]">{{ $event->venue_name }}, {{ $event->city }}</td>
                        <td class="px-6 py-4 text-[#DADADA]">{{ $event->category }}</td>
                        <td class="px-6 py-4 text-[#DADADA]">{{ number_format($totalSold) }}/{{ number_format($totalQuota) }}</td>
                        <td class="px-6 py-4 text-[#DADADA]">
                            {{ $totalRevenue > 0 ? 'Rp ' . number_format($totalRevenue, 0, ',', '.') : '-' }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($event->status == 'approved')
                                <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-[#4A9FD4] text-[#4A9FD4] text-xs font-bold bg-[#4A9FD4]/10 uppercase">APPROVED</span>
                            @elseif($event->status == 'pending')
                                <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-[#C9A84C] text-[#C9A84C] text-xs font-bold bg-[#C9A84C]/10 uppercase">PENDING</span>
                            @else
                                <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-red-500 text-red-500 text-xs font-bold bg-red-500/10 uppercase">{{ strtoupper($event->status) }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('super.events.show', $event->id) }}"
                                class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition"
                                title="Detail Event">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor"viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                </path>
                                <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5
                                12 5c4.478 0 8.268 2.943
                                9.542 7-1.274 4.057-5.064
                                7-9.542 7-4.477 0-8.268-2.943
                                -9.542-7z">
                            </path>
                        </svg>
                    </a>
                                <button onclick="deleteEvent({{ $event->id }})" class="w-8 h-8 rounded-full bg-white text-red-600 flex items-center justify-center hover:bg-red-50 transition" title="Hapus Event">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr id="emptyRow">
                        <td colspan="9" class="px-6 py-8 text-center text-gray-400">Tidak ada data acara yang terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    function filterTable() {
        const searchVal = document.getElementById('searchInput').value.toLowerCase();
        const statusVal = document.getElementById('statusFilter').value;
        const categoryVal = document.getElementById('categoryFilter').value;
        const rows = document.querySelectorAll('.event-row');
        let activeIndex = 1;

        rows.forEach(row => {
            const title = row.getAttribute('data-title');
            const city = row.getAttribute('data-city');
            const status = row.getAttribute('data-status').trim();
            const category = row.getAttribute('data-category');

            const matchSearch = title.includes(searchVal) || city.includes(searchVal);
            const matchStatus = statusVal === "" || status === statusVal;
            const matchCategory = categoryVal === "" || category === categoryVal;

            if (matchSearch && matchStatus && matchCategory) {
                row.style.display = "";
                row.querySelector('.row-number').innerText = activeIndex++;
            } else {
                row.style.display = "none";
            }
        });
    }

    function updateStatus(id, action) {
        const confirmationMessage = action === 'approve' ? 'Apakah Anda yakin ingin menyetujui (Publish) event ini?' : 'Apakah Anda yakin ingin menolak event ini?';
        if (confirm(confirmationMessage)) {
            fetch(`/super/event/${id}/${action}`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    window.location.reload();
                } else {
                    alert(data.message || 'Gagal memperbarui status.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan sistem.');
            });
        }
    }

    function deleteEvent(id) {
        if (confirm('Apakah Anda yakin ingin menghapus acara ini secara permanen?')) {
            fetch(`/super/event/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    window.location.reload();
                } else {
                    alert(data.message || 'Gagal menghapus data.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan sistem.');
            });
        }
    }
</script>
@endsection