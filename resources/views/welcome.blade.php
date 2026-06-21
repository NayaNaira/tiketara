<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiketara</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logotiket.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,600,700|dm-sans:400,500,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css'])
</head>
<body class="antialiased min-h-screen flex flex-col font-['DM_Sans',_sans-serif] bg-[#020D1A] text-white">

    <!-- Header -->
    <header class="w-full flex items-center justify-between px-4 md:px-8 py-3 md:py-4 border-b border-[#202020]">
        <div class="flex items-center gap-2">
            <a href="{{ url('/') }}" class="flex items-center gap-2.5 group">
                <img src="{{ asset('images/logotiket.png') }}" alt="Tiketara Logo" class="h-8 md:h-10 w-auto object-contain hover:opacity-90 transition">
                <span class="text-lg md:text-xl font-bold tracking-wider text-white group-hover:text-[#C9A84C] transition">Tiketara</span>
            </a>
        </div>

        <form action="{{ route('events.search') }}" method="GET" class="hidden md:block flex-1 max-w-lg mx-2 md:mx-4">
            <div class="relative">
                <input type="text" name="q" placeholder="Cari event" class="w-full bg-[#041830] border border-[#202020] text-xs md:text-sm rounded-full py-1.5 md:py-2 pl-4 md:pl-6 pr-8 md:pr-10 focus:outline-none focus:border-[#C9A84C] text-white placeholder-[#DADADA] opacity-90">
                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-[#DADADA] hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 md:w-4 md:h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M16.5 10.5a6 6 0 11-12 0 6 6 0 0112 0z" />
                    </svg>
                </button>
            </div>
        </form>

        <div class="flex items-center gap-2 md:gap-4">
            <!-- Tombol Cari Mobile -->
            <button onclick="toggleMobileSearch()" class="block md:hidden text-[#DADADA] hover:text-white p-2 transition focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M16.5 10.5a6 6 0 11-12 0 6 6 0 0112 0z" />
                </svg>
            </button>

            @auth
                <!-- LINK MENUJU HALAMAN PROFILE -->
                <a href="{{ url('/profile') }}" class="w-7 h-7 md:w-9 md:h-9 rounded-full overflow-hidden border-2 border-transparent hover:border-[#C9A84C] transition block">
                    @if(auth()->user()->avatar)
                        <img src="{{ auth()->user()->avatar }}" alt="Profile" class="w-full h-full object-cover" referrerpolicy="no-referrer">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=C9A84C&color=fff" alt="Profile" class="w-full h-full object-cover">
                    @endif
                </a>
            @else
                <a href="{{ route('login') }}" class="text-xs md:text-sm font-medium hover:text-[#C9A84C] transition text-white">Log in</a>
                <a href="{{ route('register') }}" class="hidden md:block text-sm font-medium border border-[#C9A84C] text-[#C9A84C] px-4 py-1.5 rounded-full hover:bg-[#C9A84C] hover:text-[#020D1A] transition">Register</a>
            @endauth
        </div>
    </header>

    <!-- Mobile Search Dropdown -->
    <form id="mobileSearchDropdown" action="{{ route('events.search') }}" method="GET" class="hidden w-full bg-[#031124] border-b border-[#202020] px-4 py-3 md:hidden">
        <div class="relative">
            <input type="text" name="q" placeholder="Cari event" class="w-full bg-[#041830] border border-[#202020] text-xs rounded-full py-2 pl-4 pr-10 focus:outline-none focus:border-[#C9A84C] text-white placeholder-[#DADADA] opacity-90">
            <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-[#DADADA] hover:text-white transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M16.5 10.5a6 6 0 11-12 0 6 6 0 0112 0z" />
                </svg>
            </button>
        </div>
    </form>

    <main class="flex-1 px-4 md:px-8 py-6 max-w-[1500px] mx-auto w-full">
        
        <!-- Hero -->
        <div class="w-full">
            <img src="{{ asset('images/banner.png') }}" alt="Orchestra Experience Banner" class="hidden md:block w-full h-auto object-cover">
            <img src="{{ asset('images/banner_mobile.png') }}" alt="Orchestra Experience Mobile Banner" class="md:hidden w-full h-auto object-cover rounded-xl">
        </div>

        <!-- Acara Langsung -->
        <div class="mt-8 md:mt-12">
            <h2 class="text-lg md:text-xl font-['Playfair_Display',_serif] text-white mb-4 md:mb-6 tracking-widest font-bold">ACARA TRENDING</h2>
            
            <div class="flex overflow-x-auto gap-3 md:gap-5 pb-6 snap-x [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
                
                <!-- LOOPING DATA EVENT DINAMIS DARI DATABASE -->
                @forelse ($events as $event)
                <a href="{{ route('event.show', $event->id) }}" class="min-w-[240px] w-[240px] md:min-w-[280px] md:w-[280px] snap-start group cursor-pointer flex flex-col block">
                    <div class="h-40 md:h-48 rounded-2xl overflow-hidden relative mb-4 bg-slate-900 border border-slate-800 flex items-center justify-center">
                        <!-- Asumsi nama field gambarnya adalah 'image' atau 'poster' -->
                        <img src="{{ $event->poster_url }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                        <div class="hidden absolute inset-0 flex flex-col items-center justify-center bg-gradient-to-br from-[#0c1e35] to-[#1a3a60] text-slate-400 p-3 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 mb-2 text-[#C9A84C]">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375 0 11-.75 0 .375 0 01.75 0z" />
                            </svg>
                            <span class="text-xs font-bold tracking-wider uppercase text-slate-300">TIKETARA EVENT</span>
                        </div>
                    </div>
                    
                    <h3 class="font-bold text-base md:text-lg mb-1 text-white">{{ $event->title }}</h3>
                    
                    <!-- Format Tanggal dan Lokasi -->
                    <p class="text-xs md:text-sm text-[#DADADA] mb-4 opacity-90">
                        {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y') }} • {{ $event->venue ?? 'TBA' }}
                    </p>
                    
                    <div class="h-[1px] w-full bg-[#1A2639] mb-4"></div>
                    
                    <div class="flex justify-between items-center mt-auto pb-2">
                        <div>
                            <p class="text-[11px] md:text-xs text-[#DADADA] mb-1 opacity-90">Mulai dari</p>
                            <!-- Mengambil harga termurah dari relasi ticketTypes -->
                            @php
                                $minPrice = $event->ticketTypes ? $event->ticketTypes->min('price') : 0;
                            @endphp
                            <p class="text-[#C9A84C] font-bold text-base md:text-lg tracking-wide">
                                Rp {{ number_format($minPrice, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="bg-[#C9A84C] w-8 h-8 md:w-9 md:h-9 rounded-full flex items-center justify-center text-white group-hover:scale-110 transition shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 md:w-5 md:h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                            </svg>
                        </div>
                    </div>
                </a>
                @empty
                <div class="w-full text-center py-8">
                    <p class="text-gray-500 italic">Belum ada acara yang tersedia saat ini.</p>
                </div>
                @endforelse
                
            </div>
        </div>

        <!-- Jelajahi Event -->
        <div class="mt-6 md:mt-8">
            <h2 class="text-lg md:text-xl font-['Playfair_Display',_serif] text-white mb-4 md:mb-6 tracking-widest font-bold">JELAJAHI EVENT DI KOTAMU</h2>
            
            <div class="flex flex-wrap gap-2 md:gap-4">
                @php
                    $cities = ['DKI Jakarta', 'Bandung', 'Solo', 'Bali', 'Yogyakarta', 'Pontianak', 'Palembang', 'Semarang', 'Batam', 'Surabaya'];
                @endphp
                
                @foreach ($cities as $city)
                <a href="{{ route('events.search') }}?city={{ urlencode($city) }}" class="bg-[#041830] border border-[#202020] rounded-lg px-3 py-2 md:px-4 md:py-2.5 flex items-center gap-2 md:gap-4 hover:border-[#C9A84C] transition duration-300 group">
                    <span class="text-xs md:text-sm font-medium text-[#DADADA] group-hover:text-white opacity-90">{{ $city }}</span>
                    <div class="bg-[#C9A84C] w-4 h-4 md:w-5 md:h-5 rounded-full flex items-center justify-center text-[#020D1A] opacity-80 group-hover:opacity-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-2.5 h-2.5 md:w-3 md:h-3 transform -rotate-45">
                            <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </a>
                @endforeach
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
    
    <script>
        function toggleMobileSearch() {
            const dropdown = document.getElementById('mobileSearchDropdown');
            dropdown.classList.toggle('hidden');
        }
    </script>
</body>
</html>