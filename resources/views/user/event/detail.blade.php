<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $event->title }} - Tiketara</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-[#020b18] min-h-screen text-white flex flex-col">

    <header class="absolute top-0 left-0 w-full z-50">
        <div class="flex items-center justify-between px-6 lg:px-10 py-5">
            <!-- Tombol Kembali ke Welcome Page -->
            <div class="flex items-center gap-4">
                <a href="{{ url('/') }}" class="text-white hover:text-[#C9A84C] transition">
                    <i class="fa-solid fa-chevron-left text-lg"></i>
                </a>
            </div>

            <!-- Profile Avatar -->
            <div class="w-11 h-11 rounded-full overflow-hidden border-2 border-[#C9A84C]">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Guest') }}&background=C9A84C&color=fff" class="w-full h-full object-cover">
            </div>
        </div>
    </header>

    <section class="relative bg-gradient-to-r from-[#041830] to-[#2D4F78] pt-24 pb-6">
        <div class="max-w-6xl mx-auto px-8">
            <div class="flex flex-col lg:flex-row justify-between items-center gap-8">
                <!-- KIRI -->
                <div class="w-full lg:w-[55%]">
                    <!-- Kategori Event / Tag -->
                    <div class="flex gap-6 text-[11px] font-semibold uppercase tracking-[2px] mb-4">
                        <span class="text-[#C9A84C]">
                            {{ $event->category }}
                        </span>
                        <span class="text-[#4A9FD4]">
                            LIVE EVENT
                        </span>
                    </div>

                    <!-- Judul Dinamis -->
                    <h1 class="text-white text-4xl md:text-5xl font-bold leading-tight uppercase">
                        {{ $event->title }}
                    </h1>

                    <!-- Lokasi / Venue -->
                    <p class="mt-2 text-[#4A9FD4] text-sm uppercase tracking-[3px] font-semibold">
                        {{ $event->venue_name }} ({{ $event->city }})
                    </p>

                    <!-- Informasi Detail -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-8">
                        <div>
                            <p class="text-[#4A9FD4] text-[10px] uppercase tracking-wider">TANGGAL</p>
                            <p class="text-white text-sm mt-1">
                                {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-[#4A9FD4] text-[10px] uppercase tracking-wider">JAM MULAI</p>
                            <p class="text-white text-sm mt-1">
                                {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} WIB
                            </p>
                        </div>
                        <div>
                            <p class="text-[#4A9FD4] text-[10px] uppercase tracking-wider">JAM SELESAI</p>
                            <p class="text-white text-sm mt-1">
                                {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }} WIB
                            </p>
                        </div>
                        <div>
                            <p class="text-[#4A9FD4] text-[10px] uppercase tracking-wider">RATING USIA</p>
                            <p class="text-white text-sm mt-1">
                                {{ $event->age_rating }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- KANAN (Poster Event) -->
                <div class="lg:w-[40%] w-full">
                    <img src="{{ asset('storage/' . $event->poster_path) }}" class="w-full h-[320px] object-cover rounded-2xl shadow-2xl border border-[#1e3a5f]">
                </div>
            </div>
        </div>
    </section>

    <main class="w-full max-w-7xl mx-auto p-6 sm:p-10 grid grid-cols-1 lg:grid-cols-3 gap-10">
        
        <div class="lg:col-span-2 space-y-10">
            <!-- Deskripsi Event -->
            <div class="space-y-3">
                <h3 class="text-[#cca43b] text-sm font-bold tracking-wider uppercase">Tentang Event</h3>
                <p class="text-gray-300 text-sm leading-relaxed text-justify whitespace-pre-line">
                    {{ $event->description }}
                </p>
            </div>

            <!-- Gallery Dinamis -->
            @if($event->galleries && $event->galleries->count() > 0)
            <div class="space-y-3">
                <h3 class="text-[#cca43b] text-sm font-bold tracking-wider uppercase">Gallery</h3>
                <div class="grid grid-cols-3 sm:grid-cols-4 gap-4">
                    @foreach($event->galleries as $gallery)
                    <div class="aspect-square rounded-lg overflow-hidden bg-gray-900 border border-gray-800">
                        <img src="{{ asset('storage/' . $gallery->image_path) }}" class="w-full h-full object-cover hover:scale-110 transition duration-300" alt="Gallery">
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Syarat & Ketentuan Dinamis -->
            <div class="space-y-4">
                <h3 class="text-[#cca43b] text-sm font-bold tracking-wider uppercase">Syarat & Ketentuan</h3>
                <div class="text-xs text-gray-400 text-justify leading-relaxed space-y-2 whitespace-pre-line">
                    {{ $event->terms_and_conditions ?? 'Tidak ada syarat & ketentuan khusus untuk event ini.' }}
                </div>
            </div>
        </div>

        <!-- SIDEBAR TIKET -->
        <div class="space-y-8">
            <div class="bg-[#020b18] border border-[#1e3a5f] rounded-xl p-5 shadow-xl space-y-6">
                <h3 class="text-[#cca43b] text-sm font-bold tracking-wider uppercase">Kategori Tiket</h3>
                
                <div class="space-y-4">
                    @forelse($event->ticketTypes as $ticket)
                    <div class="flex justify-between items-center pb-3 border-b border-gray-900">
                        <div>
                            <p class="text-xs font-semibold text-gray-200">{{ $ticket->ticket_name }}</p>
                            <p class="text-sm font-bold text-[#cca43b] mt-0.5">Rp {{ number_format($ticket->price, 0, ',', '.') }}</p>
                        </div>
                        
                        <!-- Logika Stok Tiket -->
                        @if($ticket->quota <= 0)
                            <span class="text-[10px] text-white font-medium bg-red-600 px-2 py-0.5 rounded">Habis!</span>
                        @elseif($ticket->quota <= 5)
                            <span class="text-[10px] text-red-500 font-medium bg-red-500/10 px-2 py-0.5 rounded">Sisa {{ $ticket->quota }}!</span>
                        @else
                            <span class="text-[10px] text-gray-400 font-medium bg-gray-800 px-2 py-0.5 rounded">{{ $ticket->quota }} Tiket</span>
                        @endif
                    </div>
                    @empty
                    <p class="text-xs text-gray-500 italic">Tiket belum tersedia.</p>
                    @endforelse
                </div>

                <!-- Tombol Transaksi -->
                @if($event->ticketTypes->sum('quota') > 0)
                <a href="{{ route('buyer.ticket.select', $event->id) }}" class="w-full bg-[#cca43b] hover:bg-[#b08b30] text-black font-bold text-xs py-3 rounded-lg flex items-center justify-center space-x-2 transition shadow-md group uppercase tracking-wider">
                    <span>BELI TIKET SEKARANG</span>
                    <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                </a>
                @else
                <button disabled class="w-full bg-gray-800 text-gray-500 font-bold text-xs py-3 rounded-lg cursor-not-allowed uppercase tracking-wider">
                    TIKET HABIS TERJUAL
                </button>
                @endif
            </div>

            <!-- CS -->
            <div class="space-y-4 pt-4 text-center lg:text-left">
                <h3 class="text-[#cca43b] text-xs font-bold tracking-wider uppercase">Customer Service</h3>
                <p class="text-gray-400 text-xs leading-relaxed">
                    Untuk informasi lebih lanjut mengenai pembelian tiket dan bukti aksesibilitas bagi wheelchair accessible seating, silakan hubungi:
                </p>
                <div class="text-xs space-y-1 text-gray-300">
                    <p class="font-semibold">Support Center Tiketara</p>
                    <p>Email: <a href="mailto:support@tiketara.com" class="hover:text-[#cca43b] underline">support@tiketara.com</a></p>
                </div>
            </div>
        </div>

    </main>

    <footer class="w-full mt-auto py-6 border-t border-gray-950 bg-[#010710] text-center">
        <p class="text-xxs text-[#cca43b] font-bold tracking-widest uppercase">Copyright</p>
        <p class="text-gray-500 text-xxs tracking-wider mt-1">© 2026 {{ strtoupper($event->venue_name) }}. ALL RIGHTS RESERVED.</p>
    </footer>

</body>
</html>