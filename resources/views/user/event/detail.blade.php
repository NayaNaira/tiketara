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

            <!-- Profile Avatar / Login Button -->
            @auth
                <a href="{{ url('/profile') }}" class="w-11 h-11 rounded-full overflow-hidden border-2 border-[#C9A84C] hover:border-white transition block">
                    @if(auth()->user()->avatar)
                        <img src="{{ auth()->user()->avatar }}" alt="Profile" class="w-full h-full object-cover" referrerpolicy="no-referrer">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=C9A84C&color=fff" alt="Profile" class="w-full h-full object-cover">
                    @endif
                </a>
            @else
                <a href="{{ route('login') }}" class="text-xs md:text-sm font-semibold text-white bg-[#C9A84C] hover:bg-[#b0923e] px-4 py-1.5 md:py-2 rounded-full transition">Masuk</a>
            @endauth
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
                <div class="lg:w-[40%] w-full aspect-[4/3] lg:h-[320px] rounded-2xl overflow-hidden relative shadow-2xl border border-[#1e3a5f] bg-slate-900 flex items-center justify-center">
                    <img src="{{ $event->poster_url }}" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                    <div class="hidden absolute inset-0 flex flex-col items-center justify-center bg-gradient-to-br from-[#0c1e35] to-[#1a3a60] text-slate-400 p-4 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mb-2 text-[#C9A84C]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375 0 11-.75 0 .375 0 01.75 0z" />
                        </svg>
                        <span class="text-xs font-bold tracking-wider uppercase text-slate-300">TIKETARA EVENT</span>
                    </div>
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
                    <div class="aspect-square rounded-lg overflow-hidden bg-gray-900 border border-gray-800 relative flex items-center justify-center">
                        <img src="{{ $gallery->image_url }}" class="w-full h-full object-cover hover:scale-110 transition duration-300" alt="Gallery" onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                        <div class="hidden absolute inset-0 flex flex-col items-center justify-center bg-gradient-to-br from-[#041020] to-[#0c1e35] text-slate-500 text-center">
                            <i class="fa-regular fa-image text-xl mb-1 text-[#cca43b]/70"></i>
                            <span class="text-[9px] uppercase tracking-wider font-semibold text-slate-400">Gallery</span>
                        </div>
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

    <footer class="w-full bg-[#031124] border-t border-[#202020] mt-16">
        <div class="max-w-[1500px] mx-auto px-4 md:px-8 pt-16 md:pt-20 pb-12 md:pb-16 grid grid-cols-1 md:grid-cols-4 gap-8 md:gap-12 text-left" style="padding-top: clamp(20px, 3vw, 36px); padding-bottom: clamp(20px, 3vw, 36px);">
            <!-- Col 1: Logo & Deskripsi -->
            <div class="space-y-4">
                <a href="{{ url('/') }}" class="inline-block hover:opacity-90 transition">
                    <img src="{{ asset('images/logotiket.png') }}" alt="Tiketara Logo" class="h-10 w-auto object-contain">
                </a>
                <p class="text-xs md:text-sm text-[#DADADA] leading-relaxed opacity-85 font-light">
                    Tiketara adalah platform pemesanan tiket konser, festival, olahraga, dan seminar terpercaya di Indonesia. Dapatkan akses mudah menuju event kreatif dan seru di kota Anda.
                </p>
            </div>
            
            <!-- Col 2: Jelajahi -->
            <div class="space-y-4">
                <h4 class="text-sm font-bold text-[#C9A84C] uppercase tracking-wider font-semibold">JELAJAHI</h4>
                <ul class="space-y-2 text-xs md:text-sm text-[#DADADA] opacity-90 font-medium">
                    <li><a href="{{ route('events.search') }}" class="hover:text-[#C9A84C] transition">Semua Event</a></li>
                    <li><a href="{{ route('events.search') }}?category=music_festival" class="hover:text-[#C9A84C] transition">Konser Musik</a></li>
                    <li><a href="{{ route('events.search') }}?category=sports" class="hover:text-[#C9A84C] transition">Olahraga & Sports</a></li>
                    <li><a href="{{ route('events.search') }}?category=arts_theater_culture" class="hover:text-[#C9A84C] transition">Seni & Teater</a></li>
                </ul>
            </div>
            
            <!-- Col 3: Penyelenggara -->
            <div class="space-y-4">
                <h4 class="text-sm font-bold text-[#C9A84C] uppercase tracking-wider font-semibold">UNTUK PROMOTER</h4>
                <ul class="space-y-2 text-xs md:text-sm text-[#DADADA] opacity-90 font-medium">
                    <li><a href="{{ route('promoter.apply') }}" class="hover:text-[#C9A84C] transition">Daftar Jadi Promoter</a></li>
                    <li><a href="{{ route('ticket.guide') }}" class="hover:text-[#C9A84C] transition">Panduan Penjualan Tiket</a></li>
                    <li><a href="#" class="hover:text-[#C9A84C] transition">Pusat Bantuan</a></li>
                </ul>
            </div>
            
            <!-- Col 4: Kontak & Socials -->
            <div class="space-y-4">
                <h4 class="text-sm font-bold text-[#C9A84C] uppercase tracking-wider font-semibold">HUBUNGI KAMI</h4>
                <p class="text-xs md:text-sm text-[#DADADA] opacity-85 font-light">
                    Gedung Creative Hub Jakarta<br>
                    Email: <a href="mailto:support@tiketara.com" class="hover:text-[#C9A84C] underline">support@tiketara.com</a>
                </p>
                <div class="flex items-center gap-4 text-gray-400 mt-2">
                    <a href="#" class="hover:text-white transition"><i class="fa-brands fa-instagram text-lg"></i></a>
                    <a href="#" class="hover:text-white transition"><i class="fa-brands fa-facebook text-lg"></i></a>
                    <a href="#" class="hover:text-white transition"><i class="fa-brands fa-x-twitter text-lg"></i></a>
                    <a href="#" class="hover:text-white transition"><i class="fa-brands fa-youtube text-lg"></i></a>
                </div>
            </div>
        </div>
        
        <!-- Bottom Footer -->
        <div class="w-full border-t border-[#202020] bg-[#020B18] py-6 text-center text-xs text-[#DADADA] px-4 md:px-8">
            <div class="max-w-[1500px] mx-auto flex flex-col sm:flex-row justify-between items-center gap-4">
                <p>© 2026 Tiketara. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="{{ route('privacy.policy') }}" class="hover:text-[#C9A84C] transition">Privacy Policy</a>
                    <a href="{{ route('terms.service') }}" class="hover:text-[#C9A84C] transition">Terms of Service</a>
                    <a href="#" class="hover:text-[#C9A84C] transition">Support</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>