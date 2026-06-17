<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin - @yield('title', 'Dashboard')</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,600,700|dm-sans:400,500,700" rel="stylesheet" />
    @vite(['resources/css/app.css'])
</head>
<body class="antialiased min-h-screen bg-[#020D1A] text-white font-['DM_Sans',_sans-serif] flex">

        <aside class="w-64 bg-[#031124] border-r border-[#202020] flex flex-col h-screen sticky top-0 shrink-0">
                <div class="p-6 flex flex-col items-center border-b border-black mb-4">
            <img src="{{ asset('images/logotiket.png') }}" alt="Logo" class="h-12 mb-2 object-contain">
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

                <div class="p-6">
            <div class="bg-[#4A9FD4] rounded-2xl p-2.5 flex items-center gap-3">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'San') }}&background=222&color=fff" alt="User" class="w-10 h-10 rounded-full border-2 border-white/20">
                <div>
                    <p class="text-xs font-bold text-white leading-tight">{{ auth()->user()->name ?? 'San' }}</p>
                    <p class="text-[10px] text-white/90 font-medium">Super Admin</p>
                </div>
            </div>
        </div>
    </aside>

        <main class="flex-1 flex flex-col h-screen overflow-hidden">
        @yield('content')
    </main>

</body>
</html>
