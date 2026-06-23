<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Akun - Tiketara</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logotiket.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,600,700|dm-sans:400,500,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css'])
</head>
<body class="antialiased min-h-screen flex flex-col font-['DM_Sans',_sans-serif] bg-[#020D1A] text-white">

    <!-- Header (Same as Welcome/Search for navigation consistency) -->
    <header class="w-full flex items-center justify-between px-4 md:px-8 py-3 md:py-4 border-b border-[#202020] bg-[#020D1A] z-30">
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
            <button onclick="toggleMobileSearch()" class="block md:hidden text-[#DADADA] hover:text-white p-2 transition focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M16.5 10.5a6 6 0 11-12 0 6 6 0 0112 0z" />
                </svg>
            </button>

            @auth
                <!-- Active Profile state -->
                <div class="w-8 h-8 rounded-full overflow-hidden border-2 border-[#C9A84C] block">
                    @if(auth()->user()->avatar)
                        <img src="{{ auth()->user()->avatar }}" alt="Profile" class="w-full h-full object-cover" referrerpolicy="no-referrer">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=C9A84C&color=fff" alt="Profile" class="w-full h-full object-cover">
                    @endif
                </div>
            @else
                <a href="{{ route('login') }}" class="text-xs md:text-sm font-medium hover:text-[#C9A84C] transition text-white">Log in</a>
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

    <!-- MAIN BODY SECTION -->
    <main class="flex-1 px-4 md:px-8 py-8 max-w-[1500px] mx-auto w-full">
        
        <!-- Breadcrumb & Title -->
        <div class="mb-8 flex justify-between items-center">
            <div class="flex items-center gap-2 text-xs md:text-sm text-gray-400">
                <a href="{{ url('/') }}" class="hover:text-white transition">Home</a>
                <span><i class="fa-solid fa-chevron-right text-[10px]"></i></span>
                <span class="text-white font-medium">Dashboard Akun</span>
            </div>
            
            <a href="{{ url()->previous() }}" class="text-xs text-[#C9A84C] hover:underline flex items-center gap-1">
                <i class="fa-solid fa-arrow-left-long"></i>
                <span>Kembali</span>
            </a>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- LEFT COLUMN: USER CARD & INFORMATION -->
            <section class="w-full lg:w-1/3 space-y-6">
                
                <!-- Glass Profile Card -->
                <div class="bg-[#031124] border border-[#1e3a5f]/30 rounded-3xl p-6 relative overflow-hidden shadow-xl flex flex-col items-center">
                    
                    <!-- Aesthetic card background light -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-[#C9A84C]/5 rounded-full blur-3xl -z-10"></div>
                    <div class="absolute bottom-0 left-0 w-32 h-32 bg-blue-500/5 rounded-full blur-3xl -z-10"></div>

                    <!-- Avatar -->
                    <div class="w-24 h-24 rounded-full overflow-hidden mb-4 border-2 border-[#C9A84C]/50 shadow-md">
                        @if($user->avatar)
                            @if(str_starts_with($user->avatar, 'http'))
                                <img src="{{ $user->avatar }}" class="w-full h-full object-cover" referrerpolicy="no-referrer" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=C9A84C&color=020D1A&size=128';">
                            @else
                                <img src="{{ asset('storage/'.$user->avatar) }}" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=C9A84C&color=020D1A&size=128';">
                            @endif
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=C9A84C&color=020D1A&size=128" class="w-full h-full object-cover">
                        @endif
                    </div>
                    
                    <!-- Username & Badge -->
                    <h2 class="text-lg font-bold text-white text-center">{{ $user->name }}</h2>
                    <p class="text-xs text-gray-400 text-center mt-0.5">{{ $user->email }}</p>
                    
                    <div class="mt-3">
                        @if($user->role === 'super_admin')
                            <span class="bg-[#C9A84C]/10 text-[#C9A84C] border border-[#C9A84C]/35 text-[9px] font-bold tracking-widest uppercase px-3 py-1 rounded-full">
                                <i class="fa-solid fa-shield-halved text-[8px] mr-1"></i>Super Admin
                            </span>
                        @elseif($user->role === 'promoter')
                            <span class="bg-blue-500/10 text-blue-400 border border-blue-500/35 text-[9px] font-bold tracking-widest uppercase px-3 py-1 rounded-full">
                                <i class="fa-solid fa-building-user text-[8px] mr-1"></i>Promoter
                            </span>
                        @else
                            <span class="bg-gray-800 text-gray-400 border border-gray-700 text-[9px] font-bold tracking-widest uppercase px-3 py-1 rounded-full">
                                <i class="fa-solid fa-user text-[8px] mr-1"></i>Buyer / Pembeli
                            </span>
                        @endif
                    </div>

                    <!-- Divider -->
                    <div class="w-full h-[1px] bg-[#1e3a5f]/20 my-6"></div>

                    <!-- Info list details -->
                    <div class="w-full space-y-3.5 text-xs text-left">
                        <div class="flex justify-between items-center py-1">
                            <span class="text-gray-400 flex items-center gap-2">
                                <i class="fa-solid fa-envelope-circle-check text-gray-500 w-4"></i>Status Email
                            </span>
                            @if($user->email_verified_at)
                                <span class="font-semibold text-green-400 flex items-center gap-1"><i class="fa-solid fa-check text-[10px]"></i>Terverifikasi</span>
                            @else
                                <span class="font-semibold text-red-400 flex items-center gap-1"><i class="fa-solid fa-xmark text-[10px]"></i>Belum Verifikasi</span>
                            @endif
                        </div>

                        <div class="flex justify-between items-center py-1">
                            <span class="text-gray-400 flex items-center gap-2">
                                <i class="fa-regular fa-id-card text-gray-500 w-4"></i>NIK KTP
                            </span>
                            <span class="font-semibold text-gray-200">{{ $user->nik ?? '-' }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center py-1">
                            <span class="text-gray-400 flex items-center gap-2">
                                <i class="fa-solid fa-phone text-gray-500 w-4"></i>No. Telepon
                            </span>
                            <span class="font-semibold text-gray-200">{{ $user->phone_number ?? '-' }}</span>
                        </div>

                        <div class="flex justify-between items-start py-1">
                            <span class="text-gray-400 flex items-center gap-2 shrink-0">
                                <i class="fa-solid fa-location-dot text-gray-500 w-4"></i>Alamat
                            </span>
                            <span class="font-semibold text-gray-200 text-right max-w-[180px] break-words">{{ $user->address ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Account Actions Card -->
                <div class="bg-[#031124] border border-[#1e3a5f]/30 rounded-3xl p-5 shadow-xl space-y-3">
                    <h3 class="text-[10px] font-bold text-gray-500 uppercase tracking-widest px-1">Menu Tindakan</h3>
                    
                    @if($user->role === 'super_admin')
                    <a href="{{ route('super.dashboard') }}" class="w-full flex items-center justify-between py-2.5 px-3 hover:bg-white/5 rounded-xl transition group text-sm font-semibold text-[#C9A84C]">
                        <span class="flex items-center gap-2.5"><i class="fa-solid fa-gauge-high"></i> Dashboard Admin</span>
                        <i class="fa-solid fa-arrow-right text-xs transform group-hover:translate-x-1 transition duration-300"></i>
                    </a>
                    @endif

                    @if($user->role === 'promoter')
                    <a href="{{ route('promoter.dashboard') }}" class="w-full flex items-center justify-between py-2.5 px-3 hover:bg-white/5 rounded-xl transition group text-sm font-semibold text-[#4A9FD4]">
                        <span class="flex items-center gap-2.5"><i class="fa-solid fa-gauge-high"></i> Dashboard Promoter</span>
                        <i class="fa-solid fa-arrow-right text-xs transform group-hover:translate-x-1 transition duration-300"></i>
                    </a>
                    @endif

                    <a href="{{ route('profile.edit') }}" class="w-full flex items-center justify-between py-2.5 px-3 hover:bg-white/5 rounded-xl transition group text-sm font-semibold text-gray-200">
                        <span class="flex items-center gap-2.5"><i class="fa-solid fa-user-pen text-gray-400"></i> Edit Profile</span>
                        <i class="fa-solid fa-arrow-right text-xs transform group-hover:translate-x-1 transition duration-300"></i>
                    </a>

                    <button type="button" onclick="openLogoutModal()" class="w-full flex items-center justify-between py-2.5 px-3 hover:bg-red-500/10 rounded-xl transition group text-sm font-semibold text-red-500 cursor-pointer">
                        <span class="flex items-center gap-2.5"><i class="fa-solid fa-right-from-bracket"></i> Keluar Akun</span>
                        <i class="fa-solid fa-chevron-right text-[10px] opacity-0 group-hover:opacity-100 transition duration-300"></i>
                    </button>
                </div>
            </section>

            <!-- RIGHT COLUMN: MAIN CONTENT (TICKETS & STATUS) -->
            <section class="w-full lg:w-2/3 space-y-6 flex-1">
                
                <!-- Promoter Apply Info Callout (Only for Buyers) -->
                @if($user->role !== 'super_admin' && $user->role !== 'promoter')
                    @if(is_null($user->email_verified_at))
                        <!-- Warning Verifikasi Email -->
                        <div class="relative bg-gradient-to-r from-[#1A0B12] to-[#2D0D16] border border-red-500/35 rounded-3xl p-6 shadow-md flex flex-col sm:flex-row justify-between items-center gap-4">
                            <div class="space-y-1 text-center sm:text-left">
                                <span class="bg-red-500/15 text-red-400 text-[9px] font-bold px-2 py-0.5 rounded border border-red-500/25 uppercase tracking-wider flex items-center w-max mx-auto sm:mx-0 gap-1.5">
                                    <i class="fa-solid fa-triangle-exclamation"></i> Menunggu Verifikasi
                                </span>
                                <h3 class="text-sm font-bold text-white mt-1.5">Verifikasi Email Anda</h3>
                                <p class="text-xs text-gray-400 max-w-md">
                                    Untuk dapat mengajukan diri sebagai Promoter atau melakukan aksi penting lainnya, Anda wajib memverifikasi alamat email Anda terlebih dahulu.
                                </p>
                            </div>
                            <form action="{{ route('verification.send') }}" method="POST" class="shrink-0 m-0">
                                @csrf
                                <button type="submit" class="bg-red-500 text-white text-xs font-bold px-5 py-2.5 rounded-full hover:bg-red-600 transition uppercase tracking-wider shadow-md flex items-center gap-2 cursor-pointer">
                                    <i class="fa-regular fa-envelope"></i> Kirim Ulang Email
                                </button>
                            </form>
                        </div>
                    @elseif($user->promoter_status == 'none' || $user->promoter_status == 'rejected')
                        <div class="relative bg-gradient-to-r from-[#031124] to-[#0d1e33] border border-[#C9A84C]/35 rounded-3xl p-6 shadow-md flex flex-col sm:flex-row justify-between items-center gap-4">
                            <div class="space-y-1 text-center sm:text-left">
                                <span class="bg-[#C9A84C]/15 text-[#C9A84C] text-[9px] font-bold px-2 py-0.5 rounded border border-[#C9A84C]/25 uppercase tracking-wider">
                                    Promoter Tiketara
                                </span>
                                <h3 class="text-sm font-bold text-white mt-1.5">Mulai Jual Tiket Acaramu Sendiri</h3>
                                <p class="text-xs text-gray-400 max-w-md">
                                    {{ $user->promoter_status == 'rejected' ? 'Pengajuan Promoter Anda sebelumnya ditolak. Silakan edit dan kirim ulang berkas Anda.' : 'Ajukan permohonan promoter untuk mulai membuat dan menjual tiket acara di platform kami.' }}
                                </p>
                            </div>
                            <a href="{{ route('promoter.apply') }}" class="bg-[#C9A84C] text-[#020D1A] text-xs font-bold px-5 py-2.5 rounded-full hover:bg-[#b0923e] transition uppercase tracking-wider shrink-0 shadow-md">
                                {{ $user->promoter_status == 'rejected' ? 'Ajukan Ulang' : 'Daftar Sekarang' }}
                            </a>
                        </div>
                    @elseif($user->promoter_status == 'pending')
                        <div class="bg-[#031124] border border-yellow-500/20 rounded-3xl p-5 shadow-sm flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-yellow-500/10 flex items-center justify-center text-yellow-500 text-base shrink-0 animate-pulse">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                </div>
                                <div>
                                    <h3 class="text-xs font-bold text-yellow-500 uppercase tracking-wider">Pengajuan Promoter Diproses</h3>
                                    <p class="text-[11px] text-gray-400 mt-0.5">Identitas & berkas organisasi Anda sedang diperiksa oleh Super Admin.</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif

                <!-- TIKET SAYA / TRANSACTION BOARD -->
                @if($user->role === 'buyer')
                <div class="bg-[#031124] border border-[#1e3a5f]/20 rounded-3xl p-6 shadow-xl space-y-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h2 class="text-base font-bold text-white uppercase tracking-wider flex items-center gap-2">
                                <i class="fa-solid fa-ticket text-[#C9A84C]"></i>
                                <span>Tiket Saya</span>
                            </h2>
                            <p class="text-xs text-gray-400 mt-1">Daftar transaksi dan tiket aktif Anda</p>
                        </div>
                    </div>

                    <!-- Client-Side Tabs Filter Buttons -->
                    <div class="flex gap-2 border-b border-[#202020] pb-3.5 overflow-x-auto [&::-webkit-scrollbar]:hidden">
                        <button type="button" onclick="filterTickets('all', event)" class="tab-btn px-4 py-1.5 rounded-full text-xs font-semibold bg-[#C9A84C] text-[#020D1A] transition">
                            Semua
                        </button>
                        <button type="button" onclick="filterTickets('success', event)" class="tab-btn px-4 py-1.5 rounded-full text-xs font-semibold bg-[#041830] text-[#DADADA] hover:text-white transition">
                            Lunas
                        </button>
                        <button type="button" onclick="filterTickets('pending', event)" class="tab-btn px-4 py-1.5 rounded-full text-xs font-semibold bg-[#041830] text-[#DADADA] hover:text-white transition">
                            Pending
                        </button>
                        <button type="button" onclick="filterTickets('failed', event)" class="tab-btn px-4 py-1.5 rounded-full text-xs font-semibold bg-[#041830] text-[#DADADA] hover:text-white transition">
                            Batal
                        </button>
                    </div>

                    @if(isset($orders) && count($orders) > 0)
                        <!-- Cards Container -->
                        <div class="space-y-4">
                            @foreach($orders as $order)
                                <div class="ticket-card w-full bg-[#041830]/50 border border-[#202020] rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row items-stretch sm:items-center gap-4 hover:border-[#C9A84C]/45 transition duration-300" data-status="{{ $order->status }}">
                                    
                                    <!-- Event Poster Thumbnail -->
                                    <div class="aspect-[16/10] w-full sm:w-24 rounded-xl overflow-hidden bg-slate-900 shrink-0 border border-gray-800 flex items-center justify-center">
                                        <img src="{{ $order->event->poster_url }}" alt="{{ $order->event->title }}" class="w-full h-full object-cover">
                                    </div>

                                    <!-- Event Ticket Details -->
                                    <div class="flex-1 min-w-0 space-y-1.5">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <h4 class="text-sm font-bold text-white uppercase tracking-wide truncate max-w-[280px]">
                                                {{ $order->event->title }}
                                            </h4>
                                            
                                            <!-- Ticket status badge -->
                                            @if($order->status === 'paid')
                                                <span class="bg-green-500/10 text-green-400 text-[8px] font-bold px-2 py-0.5 rounded border border-green-500/20 uppercase tracking-wider">
                                                    Lunas
                                                </span>
                                            @elseif($order->status === 'pending')
                                                <span class="bg-yellow-500/10 text-yellow-400 text-[8px] font-bold px-2 py-0.5 rounded border border-yellow-500/20 uppercase tracking-wider animate-pulse">
                                                    Pending
                                                </span>
                                            @else
                                                <span class="bg-red-500/10 text-red-400 text-[8px] font-bold px-2 py-0.5 rounded border border-red-500/20 uppercase tracking-wider">
                                                    Batal
                                                </span>
                                            @endif
                                        </div>

                                        <p class="text-xs text-gray-400 font-medium">
                                            Kategori: <span class="text-gray-200">{{ $order->ticketType->name }}</span> • {{ $order->quantity }} Tiket
                                        </p>
                                        
                                        <!-- Datetime & Venue Icons -->
                                        <div class="flex flex-col sm:flex-row sm:items-center gap-x-4 gap-y-1 text-[11px] text-gray-400 font-medium pt-1">
                                            <span class="flex items-center gap-1.5">
                                                <i class="fa-regular fa-calendar text-[#C9A84C] text-[10px]"></i>
                                                {{ \Carbon\Carbon::parse($order->event->event_date)->translatedFormat('d M Y') }}
                                            </span>
                                            <span class="flex items-center gap-1.5 truncate">
                                                <i class="fa-solid fa-location-dot text-[#4A9FD4] text-[10px]"></i>
                                                {{ $order->event->venue_name ?? $order->event->venue ?? 'TBA' }} ({{ $order->event->city }})
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Price & Action Trigger -->
                                    <div class="flex flex-row sm:flex-col justify-between sm:justify-center items-center sm:items-end gap-3 sm:border-l sm:border-[#202020] sm:pl-5 shrink-0 pt-3 sm:pt-0 border-t border-[#202020]/40 sm:border-t-0">
                                        <div class="text-left sm:text-right">
                                            <span class="text-[9px] text-gray-500 block">Total Bayar</span>
                                            <span class="text-xs sm:text-sm font-bold text-[#C9A84C]">
                                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                            </span>
                                        </div>

                                        <!-- Render Action based on status -->
                                        @if($order->status === 'paid')
                                            <a href="{{ route('buyer.order.ticket', $order->id) }}" class="bg-[#C9A84C] text-[#020D1A] text-[10px] font-bold px-4 py-1.5 rounded-full hover:bg-[#b0923e] transition shadow flex items-center gap-1 cursor-pointer">
                                                <i class="fa-solid fa-qrcode text-[9px]"></i>
                                                <span>E-Tiket</span>
                                            </a>
                                        @elseif($order->status === 'pending')
                                            <a href="{{ route('buyer.order.payment', $order->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-black text-[10px] font-black px-4 py-1.5 rounded-full transition shadow uppercase tracking-wider">
                                                Bayar
                                            </a>
                                        @else
                                            <span class="text-[10px] text-gray-500 italic font-medium px-2 py-1">Transaksi Batal</span>
                                        @endif
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- No Tickets Placeholder state -->
                        <div class="py-16 px-4 flex flex-col items-center justify-center text-center">
                            <div class="w-16 h-16 rounded-full bg-[#041830] flex items-center justify-center mb-4 border border-[#202020]">
                                <i class="fa-solid fa-ticket-simple text-2xl text-gray-500"></i>
                            </div>
                            <h3 class="text-sm font-bold text-white mb-1.5">Belum Ada Transaksi</h3>
                            <p class="text-xs text-gray-400 max-w-xs mb-6">
                                Anda belum melakukan pembelian tiket apapun. Silakan telusuri acara terbaru kami di Tiketara.
                            </p>
                            <a href="{{ url('/') }}" class="bg-[#C9A84C] text-[#020D1A] font-bold text-xs px-5 py-2 rounded-full hover:bg-[#b0923e] transition uppercase tracking-wider">
                                Cari Event Seru
                            </a>
                        </div>
                    @endif
                </div>
                @elseif($user->role === 'promoter')
                    <div class="w-full mt-2 mb-6 space-y-6">
                        
                        <!-- Section Header with Create Action -->
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-[#031124] border border-[#202020] rounded-3xl p-5 shadow-md">
                            <div>
                                <h2 class="text-sm md:text-base font-bold text-white uppercase tracking-wider flex items-center gap-2">
                                    <i class="fa-solid fa-calendar-days text-[#C9A84C]"></i>
                                    <span>Event Saya</span>
                                </h2>
                                <p class="text-xs text-gray-400 mt-1">Kelola dan pantau event yang Anda selenggarakan</p>
                            </div>
                            <a href="{{ route('promoter.event.create') }}" class="bg-[#C9A84C] text-[#020D1A] text-xs font-bold px-5 py-2.5 rounded-full hover:bg-[#b0923e] transition uppercase tracking-wider flex items-center gap-2 shadow-md">
                                <i class="fa-solid fa-plus text-xs"></i>
                                <span>Buat Event</span>
                            </a>
                        </div>

                        <!-- Event list cards -->
                        @if(isset($promoterEvents) && count($promoterEvents) > 0)
                            <!-- Client-Side Tabs Filter Buttons for Promoter Events -->
                            <div class="flex gap-2 border-b border-[#202020] pb-3.5 overflow-x-auto [&::-webkit-scrollbar]:hidden">
                                <button type="button" onclick="filterEvents('all', event)" class="event-tab-btn px-4 py-1.5 rounded-full text-xs font-semibold bg-[#C9A84C] text-[#020D1A] transition">
                                    Semua
                                </button>
                                <button type="button" onclick="filterEvents('approved', event)" class="event-tab-btn px-4 py-1.5 rounded-full text-xs font-semibold bg-[#041830] text-[#DADADA] hover:text-white transition">
                                    Aktif
                                </button>
                                <button type="button" onclick="filterEvents('pending', event)" class="event-tab-btn px-4 py-1.5 rounded-full text-xs font-semibold bg-[#041830] text-[#DADADA] hover:text-white transition">
                                    Pending
                                </button>
                                <button type="button" onclick="filterEvents('rejected', event)" class="event-tab-btn px-4 py-1.5 rounded-full text-xs font-semibold bg-[#041830] text-[#DADADA] hover:text-white transition">
                                    Ditolak
                                </button>
                            </div>

                            <div class="space-y-4">
                                @foreach($promoterEvents as $event)
                                    <div class="promoter-event-card w-full bg-[#041830]/50 border border-[#202020] rounded-2xl p-4 flex flex-col sm:flex-row items-stretch sm:items-center gap-4 hover:border-[#C9A84C]/45 transition duration-300" data-status="{{ $event->status }}">
                                        <!-- Thumbnail -->
                                        <div class="aspect-[16/10] w-full sm:w-24 rounded-xl overflow-hidden bg-slate-900 shrink-0 border border-gray-800 flex items-center justify-center">
                                            <img src="{{ $event->poster_url }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                                        </div>

                                        <!-- Details -->
                                        <div class="flex-1 min-w-0 space-y-1.5">
                                            <div class="flex items-center gap-2 flex-wrap">
                                                <h4 class="text-sm font-bold text-white uppercase tracking-wide truncate max-w-[280px]">
                                                    {{ $event->title }}
                                                </h4>
                                                
                                                <!-- Status Badge -->
                                                @if($event->status === 'approved')
                                                    <span class="bg-green-500/10 text-green-400 text-[8px] font-bold px-2 py-0.5 rounded border border-green-500/20 uppercase tracking-wider">
                                                        Aktif
                                                    </span>
                                                @elseif($event->status === 'pending')
                                                    <span class="bg-yellow-500/10 text-yellow-400 text-[8px] font-bold px-2 py-0.5 rounded border border-yellow-500/20 uppercase tracking-wider animate-pulse">
                                                        Pending
                                                    </span>
                                                @elseif($event->status === 'rejected')
                                                    <span class="bg-red-500/10 text-red-400 text-[8px] font-bold px-2 py-0.5 rounded border border-red-500/20 uppercase tracking-wider">
                                                        Ditolak
                                                    </span>
                                                @else
                                                    <span class="bg-gray-800 text-gray-400 text-[8px] font-bold px-2 py-0.5 rounded border border-gray-700 uppercase tracking-wider">
                                                        Draft
                                                    </span>
                                                @endif
                                            </div>
                                            
                                            <div class="flex flex-col sm:flex-row sm:items-center gap-x-4 gap-y-1 text-[11px] text-gray-400 font-medium">
                                                <span class="flex items-center gap-1.5">
                                                    <i class="fa-regular fa-calendar text-[#C9A84C] text-[10px]"></i>
                                                    {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d M Y') }}
                                                </span>
                                                <span class="flex items-center gap-1.5 truncate">
                                                    <i class="fa-solid fa-location-dot text-[#4A9FD4] text-[10px]"></i>
                                                    {{ $event->venue_name }} ({{ $event->city }})
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Action buttons -->
                                        <div class="flex items-center justify-end gap-2 shrink-0 border-t border-[#202020]/40 sm:border-t-0 pt-3 sm:pt-0">
                                            <a href="{{ route('promoter.event.edit', $event->id) }}" class="border border-[#4A9FD4] hover:bg-[#4A9FD4]/10 text-[#4A9FD4] text-[10px] font-bold px-4 py-1.5 rounded-full transition flex items-center gap-1">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                                <span>Kelola</span>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <!-- Empty promoter placeholder -->
                            <div class="py-16 px-4 flex flex-col items-center justify-center text-center bg-[#031124] border border-[#202020] rounded-3xl">
                                <div class="w-16 h-16 rounded-full bg-[#041830] flex items-center justify-center mb-4 border border-[#202020]">
                                    <i class="fa-solid fa-calendar-plus text-2xl text-gray-500"></i>
                                </div>
                                <h3 class="text-sm font-bold text-white mb-1.5">Belum Ada Event</h3>
                                <p class="text-xs text-gray-400 max-w-xs mb-6">
                                    Anda belum mendaftarkan event apapun. Buat event pertama Anda sekarang!
                                </p>
                                <a href="{{ route('promoter.event.create') }}" class="bg-[#C9A84C] text-[#020D1A] font-bold text-xs px-5 py-2 rounded-full hover:bg-[#b0923e] transition uppercase tracking-wider">
                                    Buat Event Baru
                                </a>
                            </div>
                        @endif
                    </div>
                @elseif($user->role === 'super_admin')
                    <div class="w-full mt-2 mb-6 space-y-6">
                        
                        <!-- Title block -->
                        <div class="bg-[#031124] border border-[#202020] rounded-3xl p-5 shadow-md">
                            <h2 class="text-sm md:text-base font-bold text-white uppercase tracking-wider flex items-center gap-2">
                                <i class="fa-solid fa-shield-halved text-[#C9A84C]"></i>
                                <span>Persetujuan Tertunda (Super Admin)</span>
                            </h2>
                            <p class="text-xs text-gray-400 mt-1">Daftar berkas & event yang memerlukan persetujuan Anda</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <!-- Box A: Pending Events -->
                            <div class="bg-[#031124] border border-[#202020] rounded-3xl p-5 space-y-4 shadow-md">
                                <div class="flex justify-between items-center pb-2 border-b border-[#202020]">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-gray-300 flex items-center gap-1.5">
                                        <i class="fa-regular fa-calendar-check text-[#C9A84C]"></i>
                                        <span>Persetujuan Event</span>
                                    </h3>
                                    <span class="bg-yellow-500/10 text-yellow-400 text-[9px] font-bold px-2.5 py-0.5 rounded-full border border-yellow-500/25">
                                        {{ count($pendingEvents) }} Pending
                                    </span>
                                </div>
                                
                                @if(count($pendingEvents) > 0)
                                    <div class="space-y-3">
                                        @foreach($pendingEvents as $event)
                                            <div class="p-3 bg-[#041830]/50 border border-[#202020] rounded-xl flex justify-between items-center gap-3">
                                                <div class="min-w-0">
                                                    <h4 class="text-xs font-bold text-white truncate max-w-[160px] uppercase">
                                                        {{ $event->title }}
                                                    </h4>
                                                    <p class="text-[9px] text-gray-400 truncate max-w-[160px] mt-0.5">
                                                        Promoter: {{ $event->promoter->name ?? '-' }}
                                                    </p>
                                                </div>
                                                <a href="{{ route('super.events.show', $event->id) }}" class="bg-[#C9A84C] text-[#020D1A] text-[9px] font-bold px-3 py-1 rounded hover:bg-[#b0923e] transition uppercase tracking-wider shadow">
                                                    Tinjau
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="py-8 text-center text-xs text-gray-500">
                                        <i class="fa-solid fa-circle-check text-green-500 text-lg mb-2 block"></i>
                                        Semua event telah diperiksa.
                                    </div>
                                @endif
                            </div>

                            <!-- Box B: Pending Promoters -->
                            <div class="bg-[#031124] border border-[#202020] rounded-3xl p-5 space-y-4 shadow-md">
                                <div class="flex justify-between items-center pb-2 border-b border-[#202020]">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-gray-300 flex items-center gap-1.5">
                                        <i class="fa-solid fa-user-gear text-[#4A9FD4]"></i>
                                        <span>Pengajuan Promoter</span>
                                    </h3>
                                    <span class="bg-yellow-500/10 text-yellow-400 text-[9px] font-bold px-2.5 py-0.5 rounded-full border border-yellow-500/25">
                                        {{ count($pendingPromoters) }} Pending
                                    </span>
                                </div>
                                
                                @if(count($pendingPromoters) > 0)
                                    <div class="space-y-3">
                                        @foreach($pendingPromoters as $pUser)
                                            <div class="p-3 bg-[#041830]/50 border border-[#202020] rounded-xl flex justify-between items-center gap-3">
                                                <div class="min-w-0">
                                                    <h4 class="text-xs font-bold text-white truncate max-w-[160px]">
                                                        {{ $pUser->name }}
                                                    </h4>
                                                    <p class="text-[9px] text-gray-400 truncate max-w-[160px] mt-0.5">
                                                        NIK: {{ $pUser->nik ?? '-' }}
                                                    </p>
                                                </div>
                                                <a href="{{ route('super.promoter.requests') }}" class="bg-[#4A9FD4] text-[#020D1A] text-[9px] font-bold px-3 py-1 rounded hover:bg-[#398bc0] transition uppercase tracking-wider shadow">
                                                    Tinjau
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="py-8 text-center text-xs text-gray-500">
                                        <i class="fa-solid fa-circle-check text-green-500 text-lg mb-2 block"></i>
                                        Semua berkas promoter telah diperiksa.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </section>
        </div>
    </main>

    <!-- Logout Confirmation Modal (Same style as previous modal) -->
    <div id="logoutModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm transition-opacity duration-200">
        <div class="bg-[#031124] border border-[#1e3a5f]/40 w-full max-w-sm rounded-2xl p-6 shadow-2xl transform scale-95 transition-transform duration-200">
            <h3 class="text-sm font-bold text-white mb-3 flex items-center gap-2">
                <i class="fa-solid fa-circle-exclamation text-red-500"></i>
                <span>Konfirmasi Keluar</span>
            </h3>
            <p class="text-xs text-gray-400 leading-relaxed mb-6">
                Apakah Anda yakin ingin keluar dari akun Tiketara Anda sekarang?
            </p>
            
            <div class="flex justify-end space-x-3 items-center">
                <button type="button" onclick="closeLogoutModal()" class="px-4 py-2 text-gray-400 hover:text-white font-semibold text-xs transition focus:outline-none cursor-pointer uppercase tracking-wider">
                    Batal
                </button>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-bold text-xs rounded-lg transition focus:outline-none cursor-pointer uppercase tracking-wider shadow-md">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Script for mobile toggle and tabs filter -->
    <script>
        function toggleMobileSearch() {
            const dropdown = document.getElementById('mobileSearchDropdown');
            dropdown.classList.toggle('hidden');
        }

        // Logout Modal controls
        const logoutModal = document.getElementById('logoutModal');
        function openLogoutModal() {
            logoutModal.classList.remove('hidden');
            setTimeout(() => {
                logoutModal.querySelector('.transform').classList.remove('scale-95');
                logoutModal.querySelector('.transform').classList.add('scale-100');
            }, 10);
        }
        function closeLogoutModal() {
            logoutModal.querySelector('.transform').classList.remove('scale-100');
            logoutModal.querySelector('.transform').classList.add('scale-95');
            setTimeout(() => {
                logoutModal.classList.add('hidden');
            }, 150);
        }
        logoutModal.addEventListener('click', function(e) {
            if (e.target === logoutModal) closeLogoutModal();
        });

        // Client-side ticket filtering
        function filterTickets(status, event) {
            // Update active tab styling
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('bg-[#C9A84C]', 'text-[#020D1A]');
                btn.classList.add('bg-[#041830]', 'text-[#DADADA]');
            });
            event.currentTarget.classList.remove('bg-[#041830]', 'text-[#DADADA]');
            event.currentTarget.classList.add('bg-[#C9A84C]', 'text-[#020D1A]');

            // Show or hide ticket cards based on status
            const cards = document.querySelectorAll('.ticket-card');
            cards.forEach(card => {
                const cardStatus = card.getAttribute('data-status');
                if (status === 'all' || cardStatus === status) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Client-side promoter events filtering
        function filterEvents(status, event) {
            // Update active tab styling
            document.querySelectorAll('.event-tab-btn').forEach(btn => {
                btn.classList.remove('bg-[#C9A84C]', 'text-[#020D1A]');
                btn.classList.add('bg-[#041830]', 'text-[#DADADA]');
            });
            event.currentTarget.classList.remove('bg-[#041830]', 'text-[#DADADA]');
            event.currentTarget.classList.add('bg-[#C9A84C]', 'text-[#020D1A]');

            // Show or hide promoter event cards
            const cards = document.querySelectorAll('.promoter-event-card');
            cards.forEach(card => {
                const cardStatus = card.getAttribute('data-status');
                if (status === 'all' || cardStatus === status) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>