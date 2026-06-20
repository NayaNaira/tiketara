<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiketara</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,600,700|dm-sans:400,500,700" rel="stylesheet" />
    @vite(['resources/css/app.css'])
</head>
<body class="antialiased min-h-screen flex flex-col font-['DM_Sans',_sans-serif] bg-[#020D1A] text-white">

    <!-- Header -->
    <header class="w-full flex items-center justify-between px-4 md:px-8 py-3 md:py-4 border-b border-[#202020]">
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/logotiket.png') }}" alt="Tiketara Logo" class="h-8 md:h-10 w-auto object-contain">
        </div>

        <div class="flex-1 max-w-lg mx-2 md:mx-4">
            <div class="relative">
                <input type="text" placeholder="Cari event" class="w-full bg-[#041830] border border-[#202020] text-xs md:text-sm rounded-full py-1.5 md:py-2 pl-4 md:pl-6 pr-8 md:pr-10 focus:outline-none focus:border-[#C9A84C] text-white placeholder-[#DADADA] opacity-90">
                <button class="absolute right-3 top-1/2 -translate-y-1/2 text-[#DADADA]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 md:w-4 md:h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M16.5 10.5a6 6 0 11-12 0 6 6 0 0112 0z" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="flex items-center gap-2 md:gap-4">
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
                    <div class="h-40 md:h-48 rounded-2xl overflow-hidden relative mb-4">
                        <!-- Asumsi nama field gambarnya adalah 'image' atau 'poster' -->
                        <img src="{{ asset('storage/' . $event->poster_path) }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
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
                <button class="bg-[#041830] border border-[#202020] rounded-lg px-3 py-2 md:px-4 md:py-2.5 flex items-center gap-2 md:gap-4 hover:border-[#C9A84C] transition duration-300 group">
                    <span class="text-xs md:text-sm font-medium text-[#DADADA] group-hover:text-white opacity-90">{{ $city }}</span>
                    <div class="bg-[#C9A84C] w-4 h-4 md:w-5 md:h-5 rounded-full flex items-center justify-center text-[#020D1A] opacity-80 group-hover:opacity-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-2.5 h-2.5 md:w-3 md:h-3 transform -rotate-45">
                            <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
                @endforeach
            </div>
        </div>

    </main>
    
</body>
</html>