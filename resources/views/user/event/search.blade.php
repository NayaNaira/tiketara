<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Event - Tiketara</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logotiket.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,600,700|dm-sans:400,500,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css'])
</head>
<body class="antialiased min-h-screen flex flex-col font-['DM_Sans',_sans-serif] bg-[#020D1A] text-white">

    <!-- Header -->
    <header class="w-full flex items-center justify-between px-4 md:px-8 py-3 md:py-4 border-b border-[#202020] bg-[#020D1A]">
        <div class="flex items-center gap-2">
            <a href="{{ url('/') }}" class="flex items-center gap-2.5 group">
                <img src="{{ asset('images/logotiket.png') }}" alt="Tiketara Logo" class="h-8 md:h-10 w-auto object-contain hover:opacity-90 transition">
                <span class="text-lg md:text-xl font-bold tracking-wider text-white group-hover:text-[#C9A84C] transition">Tiketara</span>
            </a>
        </div>

        <!-- Header Search (Desktop) -->
        <form action="{{ route('events.search') }}" method="GET" class="hidden md:block flex-1 max-w-lg mx-2 md:mx-4">
            <!-- Menjaga parameter filter saat mencari kata kunci lewat header -->
            @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
            @if(request('city')) <input type="hidden" name="city" value="{{ request('city') }}"> @endif
            @if(request('date')) <input type="hidden" name="date" value="{{ request('date') }}"> @endif
            @if(request('price')) <input type="hidden" name="price" value="{{ request('price') }}"> @endif
            @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif

            <div class="relative">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari event" class="w-full bg-[#041830] border border-[#202020] text-xs md:text-sm rounded-full py-1.5 md:py-2 pl-4 md:pl-6 pr-8 md:pr-10 focus:outline-none focus:border-[#C9A84C] text-white placeholder-[#DADADA] opacity-90">
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
        @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
        @if(request('city')) <input type="hidden" name="city" value="{{ request('city') }}"> @endif
        @if(request('date')) <input type="hidden" name="date" value="{{ request('date') }}"> @endif
        @if(request('price')) <input type="hidden" name="price" value="{{ request('price') }}"> @endif
        @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif

        <div class="relative">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari event" class="w-full bg-[#041830] border border-[#202020] text-xs rounded-full py-2 pl-4 pr-10 focus:outline-none focus:border-[#C9A84C] text-white placeholder-[#DADADA] opacity-90">
            <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-[#DADADA] hover:text-white transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M16.5 10.5a6 6 0 11-12 0 6 6 0 0112 0z" />
                </svg>
            </button>
        </div>
    </form>

    <!-- Main Content Container with Single Unified Filter Form -->
    <main class="flex-1 px-4 md:px-8 py-6 max-w-[1500px] mx-auto w-full">
        
        <!-- Breadcrumb / Header Title -->
        <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-2">
            <div class="flex items-center gap-2 text-xs md:text-sm text-gray-400">
                <a href="{{ url('/') }}" class="hover:text-white transition">Home</a>
                <span><i class="fa-solid fa-chevron-right text-[10px]"></i></span>
                <span class="text-white font-medium">Jelajahi Event</span>
            </div>
        </div>

        <form id="filter-form" action="{{ route('events.search') }}" method="GET" class="w-full">
            <!-- Hidden text search parameter synced with forms -->
            <input type="hidden" name="q" id="hidden-q-input" value="{{ request('q') }}">

            <div class="flex flex-col md:flex-row gap-6 relative">
                
                <!-- Backdrop for mobile drawer -->
                <div id="filter-backdrop" onclick="toggleFilterDrawer()" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 hidden transition-opacity duration-300 opacity-0"></div>

                <!-- LEFT SIDEBAR: FILTERS -->
                <aside id="filter-sidebar" class="fixed inset-y-0 right-0 z-50 w-[300px] bg-[#031124] border-l border-[#202020] p-6 shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out md:relative md:translate-x-0 md:w-1/4 lg:w-1/5 md:bg-[#031124] md:border md:border-[#202020] md:rounded-2xl md:p-5 md:shadow-none md:z-auto md:block self-start overflow-y-auto max-h-[90vh] md:max-h-none">
                    
                    <!-- Mobile Sidebar Title & Close -->
                    <div class="flex items-center justify-between md:hidden mb-6">
                        <h3 class="text-base font-bold text-white uppercase tracking-wider">Filter</h3>
                        <button type="button" onclick="toggleFilterDrawer()" class="text-gray-400 hover:text-white p-2">
                            <i class="fa-solid fa-xmark text-lg"></i>
                        </button>
                    </div>

                    <div class="space-y-6">
                        
                        <!-- Search input within sidebar for convenience -->
                        <div>
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-[#C9A84C] mb-2.5">Pencarian</label>
                            <div class="relative">
                                <input type="text" id="sidebar-q-field" placeholder="Ketik kata kunci..." class="w-full bg-[#041830] border border-[#202020] text-xs rounded-lg py-2 pl-3 pr-8 focus:outline-none focus:border-[#C9A84C] text-white placeholder-gray-400" value="{{ request('q') }}">
                                <button type="button" onclick="applySidebarTextSearch()" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M16.5 10.5a6 6 0 11-12 0 6 6 0 0112 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-[#C9A84C] mb-2.5">Kategori</label>
                            <select name="category" class="filter-input w-full bg-[#041830] border border-[#202020] text-xs rounded-lg py-2 px-3 focus:outline-none focus:border-[#C9A84C] text-white">
                                <option value="all">Semua Kategori</option>
                                @foreach($categories as $value => $label)
                                    <option value="{{ $value }}" {{ request('category') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Kota / Lokasi -->
                        <div>
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-[#C9A84C] mb-2.5">Kota / Lokasi</label>
                            <select name="city" class="filter-input w-full bg-[#041830] border border-[#202020] text-xs rounded-lg py-2 px-3 focus:outline-none focus:border-[#C9A84C] text-white">
                                <option value="all">Semua Kota</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Waktu / Tanggal -->
                        <div>
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-[#C9A84C] mb-2.5">Waktu Acara</label>
                            <div class="space-y-2.5">
                                @php
                                    $dateOptions = [
                                        'all' => 'Semua Tanggal',
                                        'today' => 'Hari Ini',
                                        'tomorrow' => 'Besok',
                                        'this_week' => 'Minggu Ini',
                                        'this_month' => 'Bulan Ini'
                                    ];
                                @endphp
                                @foreach($dateOptions as $val => $lbl)
                                <label class="flex items-center gap-2 text-xs text-[#DADADA] cursor-pointer hover:text-white transition">
                                    <input type="radio" name="date" value="{{ $val }}" class="filter-input accent-[#C9A84C] h-4 w-4" {{ (request('date', 'all') == $val) ? 'checked' : '' }}>
                                    <span>{{ $lbl }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Harga -->
                        <div>
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-[#C9A84C] mb-2.5">Jenis Tiket</label>
                            <div class="space-y-2.5">
                                @php
                                    $priceOptions = [
                                        'all' => 'Semua Tiket',
                                        'free' => 'Gratis / Free',
                                        'paid' => 'Berbayar / Paid'
                                    ];
                                @endphp
                                @foreach($priceOptions as $val => $lbl)
                                <label class="flex items-center gap-2 text-xs text-[#DADADA] cursor-pointer hover:text-white transition">
                                    <input type="radio" name="price" value="{{ $val }}" class="filter-input accent-[#C9A84C] h-4 w-4" {{ (request('price', 'all') == $val) ? 'checked' : '' }}>
                                    <span>{{ $lbl }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Reset & Apply Actions -->
                        <div class="pt-4 border-t border-[#202020] flex gap-2">
                            <button type="submit" class="flex-1 bg-[#C9A84C] text-[#020D1A] font-bold text-xs py-2.5 rounded-lg hover:bg-[#b0923e] transition text-center uppercase tracking-wider">
                                Terapkan
                            </button>
                            <a href="{{ route('events.search') }}" class="flex-1 bg-[#041830] border border-[#202020] text-white hover:text-[#C9A84C] font-semibold text-xs py-2.5 rounded-lg transition text-center flex items-center justify-center uppercase tracking-wider">
                                Reset
                            </a>
                        </div>
                    </div>
                </aside>

                <!-- RIGHT CONTENT AREA: RESULTS & SORTING -->
                <section class="w-full md:w-3/4 lg:w-4/5 flex-1">
                    
                    <!-- Top Bar: Result count & Sort option -->
                    <div class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-4 mb-6 bg-[#031124] border border-[#202020] rounded-2xl p-4">
                        <div>
                            <h2 class="text-sm md:text-base font-bold text-white uppercase tracking-wider flex items-center gap-2">
                                @if(request('q'))
                                    <span>Hasil: "{{ request('q') }}"</span>
                                @else
                                    <span>Semua Event</span>
                                @endif
                            </h2>
                            <p class="text-xs text-gray-400 mt-1">Ditemukan {{ $events->count() }} acara untuk filter aktif</p>
                        </div>
                        
                        <!-- Sort and Filter Drawer Toggle -->
                        <div class="flex items-center justify-between sm:justify-end gap-3">
                            <!-- Mobile Filter Button (Drawer Trigger) -->
                            <button type="button" onclick="toggleFilterDrawer()" class="flex items-center gap-2 px-3.5 py-1.5 bg-[#041830] border border-[#202020] rounded-lg text-xs font-semibold text-[#DADADA] hover:text-white md:hidden transition">
                                <i class="fa-solid fa-sliders text-[#C9A84C]"></i>
                                <span>Filter</span>
                            </button>

                            <!-- Sorting Select -->
                            <div class="flex items-center gap-2">
                                <span class="text-xs text-gray-400 hidden sm:inline">Urutkan:</span>
                                <select name="sort" class="filter-input bg-[#041830] border border-[#202020] text-xs rounded-lg py-1.5 px-3 focus:outline-none focus:border-[#C9A84C] text-white cursor-pointer">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- RESULTS GRID -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($events as $event)
                        <a href="{{ route('event.show', $event->slug) }}" class="group bg-[#031124] border border-[#202020] rounded-2xl overflow-hidden hover:border-[#C9A84C] transition duration-300 flex flex-col h-full">
                            
                            @php
                                $endDateTime = \Carbon\Carbon::parse($event->event_date->format('Y-m-d') . ' ' . ($event->end_time ?? '23:59:59'));
                                $isEventEnded = $endDateTime->isPast();
                            @endphp

                            <!-- Poster Container -->
                            <div class="aspect-[16/10] w-full overflow-hidden relative bg-slate-900 border-b border-[#202020] flex items-center justify-center">
                                <img src="{{ $event->poster_url }}" alt="{{ $event->title }}" class="w-full h-full object-cover {{ $isEventEnded ? 'opacity-40 grayscale' : 'group-hover:scale-105 transition duration-500' }}" onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                                
                                @if($isEventEnded)
                                    <div class="absolute inset-0 flex flex-col items-center justify-center bg-black/60 z-10">
                                        <span class="text-white font-bold tracking-widest text-sm md:text-base uppercase">Event Berakhir</span>
                                    </div>
                                @else
                                    <div class="hidden absolute inset-0 flex flex-col items-center justify-center bg-gradient-to-br from-[#0c1e35] to-[#1a3a60] text-slate-400 p-3 text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mb-2 text-[#C9A84C]">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375 0 11-.75 0 .375 0 01.75 0z" />
                                        </svg>
                                        <span class="text-[10px] font-bold tracking-wider uppercase text-slate-300">TIKETARA</span>
                                    </div>
                                @endif

                                <div class="absolute top-2.5 left-2.5 z-20">
                                    <span class="bg-[#020D1A]/85 backdrop-blur-md text-[#C9A84C] text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider border border-[#C9A84C]/25">
                                        {{ $categories[$event->category] ?? str_replace('_', ' ', $event->category) }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Card Details -->
                            <div class="p-4 flex flex-col flex-1 relative z-20">
                                <h3 class="font-bold text-sm md:text-base mb-1 text-white group-hover:text-[#C9A84C] transition duration-300 line-clamp-1 uppercase tracking-wide">
                                    {{ $event->title }}
                                </h3>
                                
                                <p class="text-xs text-[#DADADA] opacity-80 mb-2 mt-1 flex items-center gap-1.5">
                                    <i class="fa-regular fa-calendar text-[#C9A84C] text-[10px] w-3"></i>
                                    <span>{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y') }}</span>
                                </p>
                                
                                <p class="text-xs text-[#DADADA] opacity-80 mb-4 flex items-center gap-1.5">
                                    <i class="fa-solid fa-location-dot text-[#4A9FD4] text-[10px] w-3"></i>
                                    <span class="line-clamp-1">{{ $event->venue_name ?? $event->venue ?? 'TBA' }} ({{ $event->city }})</span>
                                </p>
                                
                                <div class="h-[1px] w-full bg-[#1A2639] mb-4 mt-auto"></div>
                                
                                @if($isEventEnded)
                                    <div class="w-full">
                                        <div class="w-full bg-[#cca43b] hover:bg-[#b08b30] text-black font-bold py-2.5 rounded text-center text-xs tracking-widest uppercase transition shadow-[0_0_10px_rgba(201,168,76,0.3)]">
                                            LIHAT DETAIL
                                        </div>
                                    </div>
                                @else
                                    <div class="flex justify-between items-center pb-1">
                                        <div>
                                            <p class="text-[10px] text-gray-400 mb-0.5">Mulai dari</p>
                                            @php
                                                $minPrice = $event->ticketTypes ? $event->ticketTypes->min('price') : 0;
                                            @endphp
                                            <p class="text-[#C9A84C] font-bold text-sm md:text-base tracking-wide">
                                                @if($minPrice == 0)
                                                    Gratis
                                                @else
                                                    Rp {{ number_format($minPrice, 0, ',', '.') }}
                                                @endif
                                            </p>
                                        </div>
                                        <div class="bg-[#C9A84C] w-7 h-7 md:w-8 md:h-8 rounded-full flex items-center justify-center text-white group-hover:scale-105 transition shadow-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5 md:w-4 md:h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                            </svg>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </a>
                        @empty
                        <!-- Empty Grid Results -->
                        <div class="col-span-full py-16 px-4 flex flex-col items-center justify-center text-center">
                            <div class="w-16 h-16 rounded-full bg-[#041830] flex items-center justify-center mb-4 border border-[#202020]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                </svg>
                            </div>
                            <h3 class="text-base font-bold text-white mb-2">Tidak Ada Acara Ditemukan</h3>
                            <p class="text-xs text-gray-400 max-w-xs mb-6">
                                Silakan sesuaikan kata kunci pencarian Anda atau atur ulang opsi filter untuk menemukan acara.
                            </p>
                            <a href="{{ route('events.search') }}" class="bg-[#C9A84C] text-[#020D1A] font-bold text-xs px-5 py-2 rounded-full hover:bg-[#b0923e] transition uppercase tracking-wider">
                                Atur Ulang Semua Filter
                            </a>
                        </div>
                        @endforelse
                    </div>
                </section>
            </div>
        </form>
    </main>

    <!-- Footer -->
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
        // Toggle mobile search bar dropdown in header
        function toggleMobileSearch() {
            const dropdown = document.getElementById('mobileSearchDropdown');
            dropdown.classList.toggle('hidden');
        }

        // Toggle mobile sidebar drawer
        function toggleFilterDrawer() {
            const sidebar = document.getElementById('filter-sidebar');
            const backdrop = document.getElementById('filter-backdrop');
            
            if (sidebar.classList.contains('translate-x-full')) {
                // Open drawer
                sidebar.classList.remove('translate-x-full');
                backdrop.classList.remove('hidden');
                setTimeout(() => {
                    backdrop.classList.add('opacity-100');
                }, 10);
            } else {
                // Close drawer
                sidebar.classList.add('translate-x-full');
                backdrop.classList.remove('opacity-100');
                setTimeout(() => {
                    backdrop.classList.add('hidden');
                }, 300);
            }
        }

        // Sync and apply sidebar keyword search field
        function applySidebarTextSearch() {
            const sidebarQ = document.getElementById('sidebar-q-field').value;
            document.getElementById('hidden-q-input').value = sidebarQ;
            document.getElementById('filter-form').submit();
        }

        // Add event listeners for auto-submitting on filter input changes
        document.addEventListener('DOMContentLoaded', function() {
            const filterForm = document.getElementById('filter-form');
            const filterInputs = document.querySelectorAll('.filter-input');
            const sidebarQField = document.getElementById('sidebar-q-field');

            // Auto-submit form when any dropdown or radio button changes
            filterInputs.forEach(input => {
                input.addEventListener('change', function() {
                    // Sync the sidebar search input value to hidden input before submit
                    document.getElementById('hidden-q-input').value = sidebarQField.value;
                    filterForm.submit();
                });
            });

            // Also submit form if sidebar search text input triggers "Enter" key
            sidebarQField.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    applySidebarTextSearch();
                }
            });
        });
    </script>
</body>
</html>
