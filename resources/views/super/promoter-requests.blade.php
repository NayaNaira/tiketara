<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengajuan Promoter - Admin Tiketara</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-[#020D1A] min-h-screen text-white p-6 sm:p-12">

    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-semibold text-[#C9A84C] mb-2">Persetujuan Promoter</h1>
        <p class="text-[#4A9FD4] text-sm mb-8">Berikut daftar pengguna yang mengajukan hak akses sebagai penyelenggara event.</p>

        @if(session('success'))
            <div class="bg-green-500/10 border border-green-500/30 text-green-400 p-3 rounded-xl mb-5 text-sm text-center">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500/10 border border-red-500/30 text-red-400 p-3 rounded-xl mb-5 text-sm text-center">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tabel Request -->
        <div class="bg-[#0d1726]/60 border border-gray-800 rounded-xl overflow-hidden shadow-lg">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-800 text-gray-400 text-xs tracking-wider uppercase bg-[#111c2e]/50">
                        <th class="p-4">Promoter</th>
                        <th class="p-4">Kontak / NIK</th>
                        <th class="p-4">Alamat</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800/60 text-sm">
                    @forelse($requests as $req)
                        <tr class="hover:bg-gray-800/20 transition">
                            <td class="p-4 flex items-center gap-3">
                                @if($req->avatar)
                                    <img src="{{ asset('storage/' . $req->avatar) }}" class="w-10 h-10 rounded-lg object-cover border border-[#C9A84C]/50">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($req->name) }}&background=C9A84C&color=fff" class="w-10 h-10 rounded-lg object-cover">
                                @endif
                                <div>
                                    <div class="font-medium text-white">{{ $req->name }}</div>
                                    <div class="text-xs text-gray-400">{{ $req->email }}</div>
                                </div>
                            </td>
                            <td class="p-4">
                                <div class="text-white text-xs">{{ $req->phone_number ?? '-' }}</div>
                                <div class="text-xs text-gray-400 mt-0.5">NIK: {{ $req->nik ?? '-' }}</div>
                            </td>
                            <td class="p-4 text-gray-300 text-xs max-w-xs truncate">
                                {{ $req->address ?? '-' }}
                            </td>
                            <td class="p-4">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Tombol Approve -->
                                    <form action="{{ route('super.promoter.action', $req->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="action" value="approve">
                                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium text-xs px-3 py-1.5 rounded-lg transition cursor-pointer">
                                            Approve
                                        </button>
                                    </form>

                                    <!-- Tombol Reject -->
                                    <form action="{{ route('super.promoter.action', $req->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="action" value="reject">
                                        <button type="submit" class="bg-red-600/20 border border-red-600/40 hover:bg-red-600 text-red-400 hover:text-white font-medium text-xs px-3 py-1.5 rounded-lg transition cursor-pointer">
                                            Reject
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-8 text-center text-gray-500 text-xs">
                                Tidak ada pengajuan promoter baru saat ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>