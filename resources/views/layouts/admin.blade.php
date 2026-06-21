<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin - @yield('title', 'Dashboard')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logotiket.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,600,700|dm-sans:400,500,700" rel="stylesheet" />
    @vite(['resources/css/app.css'])
</head>
<body class="antialiased min-h-screen bg-[#020D1A] text-white font-['DM_Sans',_sans-serif] flex">

    <!-- Sidebar Backdrop for Mobile -->
    <div id="sidebar-backdrop" class="fixed inset-0 bg-black/60 z-40 lg:hidden hidden transition-opacity duration-300" onclick="toggleSidebar()"></div>

    <aside id="admin-sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-[#031124] border-r border-[#202020] flex flex-col h-screen transition-transform duration-300 ease-in-out -translate-x-full lg:translate-x-0 lg:static lg:transform-none shrink-0">
        <div class="p-6 flex flex-col items-center border-b border-black mb-4 relative">
            <!-- Close button for mobile -->
            <button onclick="toggleSidebar()" class="absolute right-4 top-4 text-gray-400 hover:text-white lg:hidden" aria-label="Tutup Sidebar">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <a href="{{ url('/') }}" class="block hover:opacity-90 transition">
                <img src="{{ asset('images/logotiket.png') }}" alt="Logo" class="h-12 mb-2 object-contain">
            </a>
            <span class="text-white text-sm font-medium tracking-wide">Super Admin</span>
        </div>

        <nav class="flex-1 px-4 py-2 space-y-3 overflow-y-auto">
            @php
                $currentRoute = request()->route()->getName();
                
                $navItems = [
                    ['route' => 'super.events.index', 'label' => 'Daftar Acara', 'active' => str_starts_with($currentRoute, 'super.events')],
                    ['route' => 'super.transactions.index', 'label' => 'Daftar Transaksi', 'active' => str_starts_with($currentRoute, 'super.transactions')],
                    ['route' => 'super.summary', 'label' => 'Ringkasan', 'active' => $currentRoute == 'super.summary'],
                    ['route' => 'super.reports.index', 'label' => 'Laporan', 'active' => str_starts_with($currentRoute, 'super.reports') && $currentRoute != 'super.export'],
                    ['route' => 'super.export', 'label' => 'Export Laporan', 'active' => $currentRoute == 'super.export'],
                ];
            @endphp

            @foreach ($navItems as $item)
                @php
                    $url = isset($item['params']) ? route($item['route'], $item['params']) : route($item['route']);
                    $isActive = $item['active'];
                @endphp
                <a href="{{ $url }}" 
                   class="block px-4 py-3 text-sm transition text-[#DADADA] hover:text-white border border-[#C9A84C] border-l-[6px] 
                          {{ $isActive ? 'bg-[#3D473B]' : 'bg-[#0F1E33] hover:bg-[#1A2D45]' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="p-6 relative">
            <!-- Dropdown Menu -->
            <div id="user-dropdown" class="hidden absolute bottom-20 left-6 right-6 bg-[#041830] border border-[#4A9FD4]/30 rounded-xl shadow-xl overflow-hidden z-50">
                <a href="/" class="flex items-center gap-2 px-4 py-3 text-xs text-[#DADADA] hover:bg-[#1A2D45] hover:text-white transition border-b border-[#202020]">
                    <svg class="w-4 h-4 text-[#C9A84C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span>Ke Homepage</span>
                </a>
                <form action="{{ route('logout') }}" method="POST" id="logout-form-sidebar" class="block m-0">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-2 px-4 py-3 text-xs text-red-400 hover:bg-[#1A2D45] hover:text-red-300 transition text-left cursor-pointer border-0 bg-transparent">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>

            <!-- Profile Card -->
            <button onclick="toggleUserDropdown(event)" class="w-full bg-[#4A9FD4] rounded-2xl p-2.5 flex items-center gap-3 hover:opacity-95 transition text-left cursor-pointer border-0 focus:outline-none">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'San') }}&background=222&color=fff" alt="User" class="w-10 h-10 rounded-full border-2 border-white/20">
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-bold text-white leading-tight truncate">{{ auth()->user()->name ?? 'San' }}</p>
                    <p class="text-[10px] text-white/90 font-medium truncate">Super Admin</p>
                </div>
                <!-- Dropdown Arrow -->
                <svg class="w-3.5 h-3.5 text-white/80 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden">
        <!-- Mobile Header Navbar -->
        <header class="bg-[#031124] border-b border-[#202020] px-4 py-3 flex items-center justify-between lg:hidden shrink-0">
            <button onclick="toggleSidebar()" class="text-white hover:text-[#C9A84C] focus:outline-none p-1" aria-label="Buka Sidebar">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <a href="{{ url('/') }}" class="flex items-center gap-2 hover:opacity-90 transition">
                <img src="{{ asset('images/logotiket.png') }}" alt="Logo" class="h-8 object-contain">
                <span class="text-xs font-semibold tracking-wide">Admin</span>
            </a>
            <div class="w-8"></div>
        </header>

        <div class="flex-1 flex flex-col overflow-hidden relative">
            @yield('content')
        </div>
    </main>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                backdrop.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('translate-x-0');
                backdrop.classList.add('hidden');
            }
        }
        
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                const sidebar = document.getElementById('admin-sidebar');
                const backdrop = document.getElementById('sidebar-backdrop');
                if (sidebar.classList.contains('translate-x-0')) {
                    sidebar.classList.remove('translate-x-0');
                    sidebar.classList.add('-translate-x-full');
                    backdrop.classList.add('hidden');
                }
            }
        });

        function toggleUserDropdown(event) {
            event.stopPropagation();
            const dropdown = document.getElementById('user-dropdown');
            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
            } else {
                dropdown.classList.add('hidden');
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('user-dropdown');
            if (dropdown && !dropdown.classList.contains('hidden')) {
                dropdown.classList.add('hidden');
            }
        });
    </script>

</body>
</html>
