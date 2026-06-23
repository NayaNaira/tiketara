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
        <div class="w-full relative group rounded-xl overflow-hidden shadow-2xl h-[250px] md:h-[450px] bg-[#041830]">
            @php 
                // Ambil maksimal 4 event terbaru sebagai Hero yang memiliki hero banner kustom
                $heroEvents = isset($events) ? $events->filter(function($event) {
                    return !empty($event->hero_banner_path);
                })->take(4) : collect();
            @endphp
            @if($heroEvents->isNotEmpty())
                @foreach($heroEvents as $index => $heroEvent)
                    <div class="hero-slide absolute inset-0 w-full h-full transition-opacity duration-700 ease-in-out opacity-0 pointer-events-none" data-slide-index="{{ $index }}">
                        <a href="{{ route('event.show', $heroEvent->slug) }}" class="block w-full h-full relative overflow-hidden">
                            <!-- Background Cover (Sharp Hero Banner if available, otherwise blurred poster fallback) -->
                            @if($heroEvent->hero_banner_path)
                                <div class="absolute inset-0 bg-cover bg-center opacity-60" style="background-image: url('{{ $heroEvent->hero_banner_url }}');"></div>
                            @else
                                <div class="absolute inset-0 bg-cover bg-center blur-2xl scale-110 opacity-40" style="background-image: url('{{ $heroEvent->poster_url }}');"></div>
                            @endif
                            
                            <!-- Gradient Overlays -->
                            <div class="absolute inset-0 bg-gradient-to-r from-[#020D1A]/80 to-transparent z-10"></div>
                            <div class="absolute inset-0 bg-gradient-to-t from-[#020D1A] via-transparent to-transparent z-10"></div>

                            <!-- Layout: Content on Left, Poster on Right (Desktop), Stacked (Mobile) -->
                            <div class="absolute inset-0 z-20 flex flex-col md:flex-row items-center md:justify-between px-6 md:px-16 py-8">
                                
                                <!-- Text Content -->
                                <div class="w-full md:w-2/3 flex flex-col justify-end md:justify-center h-full">
                                    <div>
                                        <h1 class="text-2xl md:text-5xl font-bold text-white drop-shadow-xl mb-2 leading-tight font-['Playfair_Display',_serif]">
                                            {{ $heroEvent->title }}
                                        </h1>
                                        <p class="text-xs md:text-sm text-gray-300 drop-shadow-md mb-4 flex items-center gap-2">
                                            <i class="fa-regular fa-calendar text-[#4A9FD4]"></i> {{ \Carbon\Carbon::parse($heroEvent->event_date)->translatedFormat('d F Y') }}
                                            <span class="mx-1 text-gray-600">|</span>
                                            <i class="fa-solid fa-location-dot text-[#4A9FD4]"></i> {{ $heroEvent->venue_name ?? $heroEvent->city ?? 'TBA' }}
                                        </p>
                                        
                                        <div class="hidden md:inline-flex bg-[#C9A84C] hover:bg-white text-[#020D1A] font-bold py-2.5 px-6 rounded-lg transition duration-300 items-center gap-2 shadow-[0_0_20px_rgba(201,168,76,0.4)]">
                                            Dapatkan Tiket <i class="fa-solid fa-arrow-right text-sm"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

                @if($heroEvents->count() > 1)
                    <!-- Navigation Buttons -->
                    <button id="hero-prev" class="absolute left-4 top-1/2 -translate-y-1/2 z-30 bg-black/40 hover:bg-[#C9A84C] hover:text-[#020D1A] text-white w-10 h-10 md:w-12 md:h-12 rounded-full flex items-center justify-center transition duration-300 focus:outline-none border border-white/10 hover:border-[#C9A84C]">
                        <i class="fa-solid fa-chevron-left text-sm md:text-base"></i>
                    </button>
                    <button id="hero-next" class="absolute right-4 top-1/2 -translate-y-1/2 z-30 bg-black/40 hover:bg-[#C9A84C] hover:text-[#020D1A] text-white w-10 h-10 md:w-12 md:h-12 rounded-full flex items-center justify-center transition duration-300 focus:outline-none border border-white/10 hover:border-[#C9A84C]">
                        <i class="fa-solid fa-chevron-right text-sm md:text-base"></i>
                    </button>

                    <!-- Indicators (Dots) -->
                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 z-30 flex gap-2">
                        @foreach($heroEvents as $index => $event)
                            <button class="hero-dot w-2 h-2 md:w-2.5 md:h-2.5 rounded-full bg-white/40 hover:bg-white transition duration-300" data-slide-index="{{ $index }}"></button>
                        @endforeach
                    </div>
                @endif
            @else
                <!-- Fallback Banner if no events exist -->
                <div class="w-full h-full relative">
                    <img src="{{ asset('images/banner.png') }}" alt="Banner" class="hidden md:block w-full h-full object-cover">
                    <img src="{{ asset('images/banner_mobile.png') }}" alt="Mobile Banner" class="md:hidden w-full h-full object-cover rounded-xl">
                </div>
            @endif
        </div>

        <!-- Acara Langsung -->
        <div class="mt-8 md:mt-12">
            <h2 class="text-lg md:text-xl font-['Playfair_Display',_serif] text-white mb-4 md:mb-6 tracking-widest font-bold">ACARA TRENDING</h2>
            
            <div class="flex overflow-x-auto gap-3 md:gap-5 pb-6 snap-x [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
                
                <!-- LOOPING DATA EVENT DINAMIS DARI DATABASE -->
                @forelse ($events as $event)
                <a href="{{ route('event.show', $event->slug) }}" class="min-w-[240px] w-[240px] md:min-w-[280px] md:w-[280px] snap-start group cursor-pointer flex flex-col block">
                    
                    @php
                        $endDateTime = \Carbon\Carbon::parse($event->event_date->format('Y-m-d') . ' ' . ($event->end_time ?? '23:59:59'));
                        $isEventEnded = $endDateTime->isPast();
                    @endphp

                    <div class="h-40 md:h-48 rounded-2xl overflow-hidden relative mb-4 bg-slate-900 border border-slate-800 flex items-center justify-center">
                        <img src="{{ $event->poster_url }}" alt="{{ $event->title }}" class="w-full h-full object-cover {{ $isEventEnded ? 'opacity-40 grayscale' : 'transition duration-500' }}" onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                        
                        @if($isEventEnded)
                            <div class="absolute inset-0 flex flex-col items-center justify-center bg-black/60 z-10">
                                <span class="text-white font-bold tracking-widest text-sm md:text-base uppercase">Event Berakhir</span>
                            </div>
                        @else
                            <div class="hidden absolute inset-0 flex flex-col items-center justify-center bg-gradient-to-br from-[#0c1e35] to-[#1a3a60] text-slate-400 p-3 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 mb-2 text-[#C9A84C]">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375 0 11-.75 0 .375 0 01.75 0z" />
                                </svg>
                                <span class="text-xs font-bold tracking-wider uppercase text-slate-300">TIKETARA EVENT</span>
                            </div>
                        @endif
                    </div>
                    
                    <h3 class="font-bold text-base md:text-lg mb-1 text-white">{{ $event->title }}</h3>
                    
                    <!-- Format Tanggal dan Lokasi -->
                    <p class="text-xs md:text-sm text-[#DADADA] mb-4 opacity-90">
                        {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y') }} • {{ $event->venue ?? 'TBA' }}
                    </p>
                    
                    <div class="h-[1px] w-full bg-[#1A2639] mb-4"></div>
                    
                    @if($isEventEnded)
                        <div class="w-full">
                            <div class="w-full bg-[#cca43b] hover:bg-[#b08b30] text-black font-bold py-2.5 rounded text-center text-xs tracking-widest uppercase transition shadow-[0_0_10px_rgba(201,168,76,0.3)]">
                                LIHAT DETAIL
                            </div>
                        </div>
                    @else
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
                    @endif
                </a>
                @empty
                <div class="w-full text-center py-8">
                    <p class="text-gray-500 italic">Belum ada acara yang tersedia saat ini.</p>
                </div>
                @endforelse
                
            </div>
        </div>

        <style>
            @keyframes marquee {
                0% { transform: translateX(0); }
                100% { transform: translateX(-50%); }
            }
            .animate-marquee {
                animation: marquee 25s linear infinite;
            }
            .animate-marquee:hover {
                animation-play-state: paused;
            }
        </style>

        <!-- Jelajahi Event -->
        <div class="mt-6 md:mt-8 w-full relative">
            <h2 class="text-lg md:text-xl font-['Playfair_Display',_serif] text-white mb-4 md:mb-6 tracking-widest font-bold">JELAJAHI EVENT DI KOTAMU</h2>
            
            <div class="w-full overflow-hidden relative flex">
                <!-- Fading edges for premium look -->
                <div class="absolute left-0 top-0 bottom-0 w-8 md:w-24 bg-gradient-to-r from-[#020D1A] to-transparent z-10"></div>
                <div class="absolute right-0 top-0 bottom-0 w-8 md:w-24 bg-gradient-to-l from-[#020D1A] to-transparent z-10"></div>

                <div class="flex w-max animate-marquee gap-2 md:gap-4">
                    @php
                        $cities = ['Jakarta', 'Bandung', 'Solo', 'Bali', 'Yogyakarta', 'Pontianak', 'Palembang', 'Semarang', 'Batam', 'Surabaya'];
                        // Duplicate array to make it a seamless loop
                        $marqueeCities = array_merge($cities, $cities);
                    @endphp
                    
                    @foreach ($marqueeCities as $city)
                    <a href="{{ route('events.search') }}?city={{ urlencode($city) }}" class="bg-[#041830] border border-[#202020] rounded-lg px-3 py-2 md:px-4 md:py-2.5 flex items-center gap-2 md:gap-4 hover:border-[#C9A84C] transition duration-300 group shrink-0">
                        <span class="text-xs md:text-sm font-medium text-[#DADADA] group-hover:text-white opacity-90 whitespace-nowrap">{{ $city }}</span>
                        <div class="bg-[#C9A84C] w-4 h-4 md:w-5 md:h-5 rounded-full flex items-center justify-center text-[#020D1A] opacity-80 group-hover:opacity-100 transition shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-2.5 h-2.5 md:w-3 md:h-3 transform -rotate-45">
                                <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </a>
                    @endforeach
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
    
    <script>
        function toggleMobileSearch() {
            const dropdown = document.getElementById('mobileSearchDropdown');
            dropdown.classList.toggle('hidden');
        }

        document.addEventListener('DOMContentLoaded', function () {
            const slides = document.querySelectorAll('.hero-slide');
            const dots = document.querySelectorAll('.hero-dot');
            const prevBtn = document.getElementById('hero-prev');
            const nextBtn = document.getElementById('hero-next');
            
            if (slides.length === 0) return;

            let currentIndex = 0;
            let slideInterval;

            function showSlide(index) {
                if (index >= slides.length) {
                    currentIndex = 0;
                } else if (index < 0) {
                    currentIndex = slides.length - 1;
                } else {
                    currentIndex = index;
                }

                slides.forEach((slide, i) => {
                    if (i === currentIndex) {
                        slide.classList.remove('opacity-0', 'pointer-events-none');
                        slide.classList.add('opacity-100', 'pointer-events-auto');
                    } else {
                        slide.classList.remove('opacity-100', 'pointer-events-auto');
                        slide.classList.add('opacity-0', 'pointer-events-none');
                    }
                });

                dots.forEach((dot, i) => {
                    if (i === currentIndex) {
                        dot.classList.remove('bg-white/40');
                        dot.classList.add('bg-[#C9A84C]');
                    } else {
                        dot.classList.remove('bg-[#C9A84C]');
                        dot.classList.add('bg-white/40');
                    }
                });
            }

            function nextSlide() {
                showSlide(currentIndex + 1);
            }

            function prevSlide() {
                showSlide(currentIndex - 1);
            }

            function startAutoPlay() {
                stopAutoPlay();
                if (slides.length > 1) {
                    slideInterval = setInterval(nextSlide, 5000);
                }
            }

            function stopAutoPlay() {
                if (slideInterval) {
                    clearInterval(slideInterval);
                }
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    nextSlide();
                    startAutoPlay();
                });
            }

            if (prevBtn) {
                prevBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    prevSlide();
                    startAutoPlay();
                });
            }

            dots.forEach(dot => {
                dot.addEventListener('click', function (e) {
                    e.preventDefault();
                    const index = parseInt(this.getAttribute('data-slide-index'));
                    showSlide(index);
                    startAutoPlay();
                });
            });

            // Initialize first slide and start autoplay
            showSlide(0);
            startAutoPlay();
        });
    </script>
</body>
</html>