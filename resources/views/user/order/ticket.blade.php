<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Tiket #{{ strtoupper(substr($order->id, 0, 8)) }} - Tiketara</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logotiket.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,600,700|dm-sans:400,500,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css'])

    <style>
        /* Print Styles */
        @media print {
            body {
                background: #020D1A !important;
                color: white !important;
                font-family: sans-serif !important;
            }
            .no-print {
                display: none !important;
            }
            
            body, html {
                margin: 0 !important;
                padding: 0 !important;
                height: 100% !important;
            }
            main {
                margin: 0 !important;
                padding: 0 !important;
            }
            .print-card {
                page-break-inside: avoid !important;
                break-inside: avoid !important;
                margin: 0 auto !important;
                transform: scale(0.9);
                transform-origin: top center;
            }
            
            /* Print rules for First Ticket only */
            .print-second-ticket-container {
                display: none !important;
            }
            .print-card {
                border: 2px solid #000000 !important;
                background: white !important;
                color: black !important;
                box-shadow: none !important;
                margin: 0 auto !important;
                border-radius: 0 !important;
            }
            .print-text-dark {
                color: black !important;
            }
            .print-border {
                border-color: #000000 !important;
            }
            .print-badge {
                background: #f3f4f6 !important;
                color: black !important;
                border: 1px solid black !important;
            }
            .print-cutout {
                display: none !important;
            }
            @page {
                size: portrait;
                margin: 5mm;
            }
            
            /* Print rules for Second (Offline) Ticket only */
            body.print-second-only {
                background: #020D1A !important;
            }
            body.print-second-only .print-first-ticket-container {
                display: none !important;
            }
            body.print-second-only .print-second-ticket-container {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            body.print-second-only .print-second-ticket {
                border: none !important;
                box-shadow: none !important;
                width: 100% !important;
                margin: 0 auto !important;
                background: linear-gradient(135deg, #031d3a 0%, #0a3562 100%) !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body class="antialiased min-h-screen flex flex-col font-['DM_Sans',_sans-serif] bg-[#020D1A] text-white p-4 md:p-8">

    <!-- Header / Navigation (No print) -->
    <header class="no-print w-full max-w-2xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4 mb-8">
        <a href="{{ route('profile.index') }}" class="flex items-center gap-2 text-xs md:text-sm font-semibold text-gray-400 hover:text-white transition">
            <i class="fa-solid fa-chevron-left"></i>
            <span>Kembali ke Profil</span>
        </a>
        <div class="flex items-center gap-3">
            <button onclick="window.print()" class="bg-[#C9A84C] text-[#020D1A] font-bold text-xs px-4 py-2 rounded-full hover:bg-[#b0923e] transition flex items-center gap-2 cursor-pointer shadow-md uppercase tracking-wider">
                <i class="fa-solid fa-print"></i>
                <span>Cetak E-Tiket</span>
            </button>
            <a href="{{ route('buyer.order.ticket.offline', $order->id) }}" class="bg-blue-600 text-white font-bold text-xs px-4 py-2 rounded-full hover:bg-blue-700 transition flex items-center gap-2 shadow-md uppercase tracking-wider">
                <i class="fa-solid fa-ticket"></i>
                <span>Tiket Cetak Offline</span>
            </a>
        </div>
    </header>

    <!-- MAIN TICKET WRAPPER -->
    <main class="flex-1 flex flex-col items-center justify-center space-y-12 my-4">
        
        <!-- FIRST TICKET BLOCK (Standard Portrait E-Ticket) -->
        <div class="print-first-ticket-container w-full flex justify-center">
            
            <!-- Ticket Stub Card -->
            <div class="print-card w-full max-w-md bg-[#031124] border border-[#202020] rounded-[2.5rem] overflow-hidden shadow-2xl relative flex flex-col">
                
                <!-- Cutout Punch Holes (No print) -->
                <div class="print-cutout absolute top-[68%] -left-4 w-8 h-8 rounded-full bg-[#020D1A] border-r border-[#202020] z-20"></div>
                <div class="print-cutout absolute top-[68%] -right-4 w-8 h-8 rounded-full bg-[#020D1A] border-l border-[#202020] z-20"></div>

                <!-- Top Event Cover & Details -->
                <div class="relative aspect-[16/9] w-full bg-slate-900 overflow-hidden flex items-center justify-center print-border border-b border-[#202020]">
                    <img src="{{ $order->event->poster_url }}" alt="{{ $order->event->title }}" class="w-full h-full object-cover opacity-90">
                    <div class="no-print absolute inset-0 bg-gradient-to-t from-[#031124] via-transparent to-black/50"></div>
                    <div class="absolute top-4 left-4">
                        <span class="print-badge bg-[#020D1A]/80 backdrop-blur-md text-[#C9A84C] text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider border border-[#C9A84C]/35">
                            E-Ticket
                        </span>
                    </div>
                </div>

                <!-- Ticket Core Details -->
                <div class="p-6 md:p-8 flex-1 flex flex-col">
                    <div class="mb-5 text-center">
                        <h1 class="print-text-dark text-white text-xl font-bold uppercase tracking-wide leading-tight mb-2">
                            {{ $order->event->title }}
                        </h1>
                        <p class="print-text-dark text-[#C9A84C] text-xs font-semibold uppercase tracking-widest">
                            {{ $order->ticketType->name }} ({{ $order->quantity }} Tiket)
                        </p>
                    </div>

                    <!-- Event Details Grid -->
                    <div class="print-border grid grid-cols-2 gap-4 border-b border-[#1A2639] pb-5 mb-5 text-xs">
                        <div>
                            <span class="text-gray-400 font-medium block mb-1">TANGGAL</span>
                            <span class="print-text-dark text-white font-bold">
                                {{ \Carbon\Carbon::parse($order->event->event_date)->translatedFormat('d F Y') }}
                            </span>
                        </div>
                        <div>
                            <span class="text-gray-400 font-medium block mb-1">WAKTU</span>
                            <span class="print-text-dark text-white font-bold">
                                {{ \Carbon\Carbon::parse($order->event->start_time)->format('H:i') }} WIB
                            </span>
                        </div>
                        <div class="col-span-2">
                            <span class="text-gray-400 font-medium block mb-1">LOKASI / VENUE</span>
                            <span class="print-text-dark text-white font-bold">
                                {{ $order->event->venue_name ?? $order->event->venue ?? 'TBA' }} ({{ $order->event->city }})
                            </span>
                        </div>
                    </div>

                    <!-- Buyer Info Grid -->
                    <div class="print-border border-b border-[#1A2639] pb-5 mb-5 text-xs space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Nama Pemegang:</span>
                            <span class="print-text-dark text-white font-bold text-right">{{ $order->user->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Nomor NIK KTP:</span>
                            <span class="print-text-dark text-white font-bold text-right">{{ $order->user->nik ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Email Pembeli:</span>
                            <span class="print-text-dark text-white font-bold text-right">{{ $order->user->email }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Nomor Telepon:</span>
                            <span class="print-text-dark text-white font-bold text-right">{{ $order->user->phone_number ?? '-' }}</span>
                        </div>
                    </div>

                    <!-- Price and Payment Method Details -->
                    <div class="text-xs space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Metode Bayar:</span>
                            <span class="print-text-dark text-white font-semibold uppercase">MIDTRANS SNAP</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Status Pembayaran:</span>
                            <span class="print-badge bg-green-500/20 text-green-400 text-[10px] font-bold px-2 py-0.5 rounded border border-green-500/30 uppercase tracking-wider">
                                {{ $order->status === 'paid' ? 'LUNAS / PAID' : strtoupper($order->status) }}
                            </span>
                        </div>
                        <div class="flex justify-between items-baseline pt-2">
                            <span class="text-gray-400">Total Dibayar:</span>
                            <span class="print-text-dark text-[#C9A84C] text-lg font-bold">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <!-- Punch Hole Line Cutout Separator (No print) -->
                    <div class="print-cutout w-full border-t border-dashed border-[#202020] my-6"></div>

                    <!-- Bottom Scanning Section (QR/Barcode) -->
                    <div class="flex flex-col items-center justify-center mt-auto">
                        <!-- QR Code API representation -->
                        <div class="bg-white p-2.5 rounded-2xl mb-4 border border-[#202020] shadow-md">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode($order->id) }}&color=020d1a" 
                                 alt="QR Code Tiket" 
                                 class="w-32 h-32 object-contain"
                                 onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                            <!-- Fallback SVG Barcode in case QR Code API fails -->
                            <div class="hidden flex flex-col items-center justify-center w-32 h-32 text-slate-800">
                                <i class="fa-solid fa-qrcode text-5xl text-[#C9A84C] mb-1"></i>
                                <span class="text-[9px] uppercase tracking-widest font-bold">Tiketara Scan</span>
                            </div>
                        </div>
                        
                        <span class="print-text-dark text-xxs tracking-widest font-bold text-gray-400 uppercase mb-1">KODE INVOICE</span>
                        <span class="print-text-dark text-sm font-black tracking-widest text-[#C9A84C]">
                            {{ strtoupper(substr($order->id, 0, 8)) }}
                        </span>
                        <span class="print-text-dark text-[9px] text-gray-500 mt-1 uppercase text-center max-w-[200px]">
                            Tunjukkan kode QR di atas kepada petugas di pintu masuk acara.
                        </span>
                    </div>
                </div>

            </div>
        </div>

    </main>

    <!-- Print Footer (No print) -->
    <footer class="no-print text-center text-xs text-gray-500 py-8">
        <p>© 2026 Tiketara. All rights reserved.</p>
    </footer>
</body>
</html>
