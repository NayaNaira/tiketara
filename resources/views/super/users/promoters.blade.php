@extends('layouts.admin')
@section('title', 'Kelola Promoter')

@section('content')
<header class="p-4 lg:p-8 pb-2 lg:pb-4">
    <h1 class="text-2xl font-bold text-[#C9A84C] mb-1">Kelola Promoter</h1>
    <p class="text-sm text-[#4A9FD4]">Manajemen akun promoter, penangguhan, pemblokiran, dan penghapusan akun.</p>
</header>

<div class="flex-1 p-4 lg:p-8 lg:pt-0 pt-0 overflow-y-auto">
    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/30 text-green-400 p-4 rounded-xl mb-6 text-sm flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 overflow-x-auto">
        <table class="w-full text-left text-sm whitespace-nowrap min-w-max">
            <thead class="text-[#4A9FD4] border-b border-[#4A9FD4]/30">
                <tr>
                    <th class="px-6 py-4 font-medium">No</th>
                    <th class="px-6 py-4 font-medium">Promoter</th>
                    <th class="px-6 py-4 font-medium">Kontak & NIK</th>
                    <th class="px-6 py-4 font-medium">Alamat</th>
                    <th class="px-6 py-4 font-medium text-center">Event Dibuat</th>
                    <th class="px-6 py-4 font-medium text-center">Status</th>
                    <th class="px-6 py-4 font-medium text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#202020]">
                @forelse($promoters as $index => $promoter)
                    <tr class="hover:bg-white/5 transition">
                        <td class="px-6 py-4 text-[#DADADA]">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($promoter->avatar)
                                    <img src="{{ $promoter->avatar }}" class="w-10 h-10 rounded-full object-cover border border-[#C9A84C]/50">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($promoter->name) }}&background=C9A84C&color=fff" class="w-10 h-10 rounded-full object-cover">
                                @endif
                                <div>
                                    <div class="font-medium text-white">{{ $promoter->name }}</div>
                                    <div class="text-xs text-gray-400">{{ $promoter->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-[#DADADA]">
                            <div class="text-xs">Telp: {{ $promoter->phone_number ?? '-' }}</div>
                            <div class="text-xs text-gray-400 mt-0.5">NIK: {{ $promoter->nik ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4 text-[#DADADA] max-w-xs truncate" title="{{ $promoter->address }}">
                            {{ $promoter->address ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-center text-[#DADADA]">
                            <span class="bg-[#4A9FD4]/10 text-[#4A9FD4] px-2.5 py-1 rounded-full text-xs font-bold border border-[#4A9FD4]/20">
                                {{ $promoter->events_count }} Event
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($promoter->status === 'active')
                                <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-green-500 text-green-500 text-xs font-bold bg-green-500/10 uppercase tracking-wide">
                                    Active
                                </span>
                            @elseif($promoter->status === 'suspended')
                                <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-yellow-500 text-yellow-500 text-xs font-bold bg-yellow-500/10 uppercase tracking-wide">
                                    Suspended
                                </span>
                            @elseif($promoter->status === 'banned')
                                <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-red-500 text-red-500 text-xs font-bold bg-red-500/10 uppercase tracking-wide">
                                    Banned
                                </span>
                            @else
                                <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-gray-500 text-gray-400 text-xs font-bold bg-gray-500/10 uppercase tracking-wide">
                                    {{ $promoter->status }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <!-- Action Suspend -->
                                <form action="{{ route('super.promoters.suspend', $promoter->id) }}" method="POST" class="inline m-0">
                                    @csrf
                                    @if($promoter->status === 'suspended')
                                        <button type="submit" class="px-3 py-1.5 bg-yellow-600/10 text-yellow-500 border border-yellow-500/30 rounded hover:bg-yellow-500 hover:text-black transition text-xs font-semibold cursor-pointer">
                                            Aktifkan
                                        </button>
                                    @else
                                        <button type="submit" class="px-3 py-1.5 bg-yellow-600/10 text-yellow-500 border border-yellow-500/30 rounded hover:bg-yellow-500 hover:text-black transition text-xs font-semibold cursor-pointer" onclick="return confirm('Apakah Anda yakin ingin menangguhkan akun {{ $promoter->name }}?')">
                                            Suspend
                                        </button>
                                    @endif
                                </form>

                                <!-- Action Ban -->
                                <form action="{{ route('super.promoters.ban', $promoter->id) }}" method="POST" class="inline m-0">
                                    @csrf
                                    @if($promoter->status === 'banned')
                                        <button type="submit" class="px-3 py-1.5 bg-red-600/10 text-red-500 border border-red-500/30 rounded hover:bg-red-500 hover:text-white transition text-xs font-semibold cursor-pointer">
                                            Unban
                                        </button>
                                    @else
                                        <button type="submit" class="px-3 py-1.5 bg-red-600/10 text-red-500 border border-red-500/30 rounded hover:bg-red-500 hover:text-white transition text-xs font-semibold cursor-pointer" onclick="return confirm('Apakah Anda yakin ingin memblokir (Ban) akun {{ $promoter->name }}?')">
                                            Ban
                                        </button>
                                    @endif
                                </form>

                                <!-- Action Delete -->
                                <form action="{{ route('super.promoters.destroy', $promoter->id) }}" method="POST" class="inline m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 bg-red-600 text-white rounded hover:bg-red-700 transition text-xs font-semibold cursor-pointer" onclick="return confirm('PERINGATAN: Menghapus akun {{ $promoter->name }} akan menghapus seluruh data event yang dibuat serta seluruh data transaksi yang terkait secara permanen! Apakah Anda yakin?')">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-gray-500 text-sm">
                            Tidak ada data promoter yang terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
