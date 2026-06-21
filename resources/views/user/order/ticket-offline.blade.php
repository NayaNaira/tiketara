<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Cetak Offline #{{ strtoupper(substr($order->id, 0, 8)) }} - Tiketara</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logotiket.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,600,700|dm-sans:400,500,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css'])
    
    <style>

        /* Landscape Card Layout */
        .ticket-container {
            width: 100%;
            max-width: 900px;
            padding: 10px;
            box-sizing: border-box;
        }

        .offline-ticket-card {
            width: 100%;
            background: linear-gradient(135deg, #031d3a 0%, #0a3562 100%);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: row;
            overflow: hidden;
            box-sizing: border-box;
        }

        .left-stub {
            flex: 1;
            padding: 28px 32px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 290px;
            box-sizing: border-box;
        }

        .right-stub {
            width: 250px;
            background-color: rgba(2, 13, 26, 0.25);
            padding: 28px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            shrink-0: true;
            box-sizing: border-box;
        }

        /* Divider Line */
        .ticket-divider {
            width: 0;
            border-left: 2px dashed rgba(255, 255, 255, 0.18);
            margin: 20px 0;
            align-self: stretch;
        }

        /* Columns Grid style (Flex-based for absolute compatibility) */
        .columns-row {
            display: flex;
            flex-direction: row;
            width: 100%;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            margin-top: 20px;
            padding-top: 20px;
        }

        .col-item {
            flex: 1;
            min-width: 0;
            padding-right: 12px;
            text-align: left;
        }

        .col-item:last-child {
            padding-right: 0;
        }

        .col-label {
            color: #4A9FD4;
            font-size: 9px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            display: block;
            margin-bottom: 5px;
        }

        .col-value {
            color: white;
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Metadata Pill Boxes */
        .pills-row {
            display: flex;
            flex-direction: row;
            gap: 10px;
            align-items: center;
        }

        .pill-box {
            background-color: rgba(2, 13, 26, 0.6);
            border: 1px solid rgba(30, 74, 122, 0.4);
            border-radius: 12px;
            padding: 6px 14px;
            text-align: center;
            min-width: 75px;
            box-sizing: border-box;
        }

        .pill-label {
            color: #6b7280;
            font-size: 8px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: block;
            margin-bottom: 2px;
        }

        .pill-value {
            color: #C9A84C;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            display: block;
        }

        /* Typography Helper */
        .event-tour {
            color: #C9A84C;
            font-size: 9px;
            font-weight: 900;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            display: block;
        }

        .event-system {
            color: #9ca3af;
            font-size: 9px;
            font-weight: bold;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            display: block;
            margin-top: 2px;
        }

        .event-title {
            color: white;
            font-size: 26px;
            font-weight: 700;
            text-transform: uppercase;
            margin: 0;
            font-family: 'Playfair Display', serif;
            line-height: 1.25;
            letter-spacing: 0.02em;
        }

        .event-location {
            color: #4A9FD4;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin: 4px 0 0 0;
        }

        /* Print Override styles */
        @media print {
            body {
                background-color: #020D1A !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .no-print {
                display: none !important;
            }
            .ticket-container {
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
            }
            .offline-ticket-card {
                box-shadow: none !important;
                border: 1px solid rgba(255, 255, 255, 0.2) !important;
            }
            @page {
                size: landscape;
                margin: 15mm;
            }
        }
    </style>
</head>
<body class="antialiased min-h-screen flex flex-col font-['DM_Sans',_sans-serif] bg-[#020D1A] text-white p-4 md:p-8">

    <!-- Header / Navigation (No print) -->
    <header class="no-print w-full max-w-2xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4 mb-8">
        <a href="{{ route('buyer.order.ticket', $order->id) }}" class="flex items-center gap-2 text-xs md:text-sm font-semibold text-gray-400 hover:text-white transition">
            <i class="fa-solid fa-chevron-left"></i>
            <span>Kembali ke Detail E-Tiket</span>
        </a>
        <div class="flex items-center gap-3">
            <button onclick="window.print()" class="bg-[#C9A84C] text-[#020D1A] font-bold text-xs px-4 py-2 rounded-full hover:bg-[#b0923e] transition flex items-center gap-2 cursor-pointer shadow-md uppercase tracking-wider">
                <i class="fa-solid fa-file-pdf"></i>
                <span>Unduh PDF / Cetak</span>
            </button>
        </div>
    </header>

    <!-- MAIN CONTENT WRAPPER -->
    <main class="flex-1 flex flex-col items-center justify-center my-4 w-full">
        <!-- MAIN TICKET LAYOUT -->
        <div class="ticket-container">
        
        <div class="offline-ticket-card">
            
            <!-- Left Section: Main Event Information -->
            <div class="left-stub">
                
                <!-- Tour Name / Header -->
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <span class="event-tour">{{ str_replace('_', ' ', strtoupper($order->event->category)) }} TOUR 2026</span>
                        <span class="event-system">TIKETARA VIP SYSTEM</span>
                    </div>
                    
                    <span style="background-color: #C9A84C; color: #020D1A; font-size: 8px; font-weight: 900; padding: 4px 12px; border-radius: 4px; text-transform: uppercase; letter-spacing: 0.1em; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                        {{ $order->ticketType->name }}
                    </span>
                </div>

                <!-- Event Title & Location -->
                <div>
                    <h1 class="event-title">{{ $order->event->title }}</h1>
                    <p class="event-location">
                        {{ $order->event->venue_name ?? $order->event->venue ?? 'TBA' }} &bull; {{ $order->event->city }}
                    </p>
                </div>

                <!-- Grid Details & Metadata Row (Tanggal, Jam Show, Buka Pintu, Venue) -->
                <div>
                    <div class="columns-row">
                        <div class="col-item">
                            <span class="col-label">Tanggal</span>
                            <span class="col-value">{{ \Carbon\Carbon::parse($order->event->event_date)->translatedFormat('d M Y') }}</span>
                        </div>
                        <div class="col-item">
                            <span class="col-label">Jam Show</span>
                            <span class="col-value">{{ \Carbon\Carbon::parse($order->event->start_time)->format('H:i') }} WIB</span>
                        </div>
                        <div class="col-item">
                            <span class="col-label">Buka Pintu</span>
                            <span class="col-value">{{ \Carbon\Carbon::parse($order->event->start_time)->subHours(2)->format('H:i') }} WIB</span>
                        </div>
                        <div class="col-item">
                            <span class="col-label">Venue</span>
                            <span class="col-value" title="{{ $order->event->venue_name ?? $order->event->venue ?? 'TBA' }}">
                                {{ $order->event->venue_name ?? $order->event->venue ?? 'TBA' }}
                            </span>
                        </div>
                    </div>

                    <!-- Bottom row: Holder & seat boxes -->
                    <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: flex-end; width: 100%; margin-top: 20px;">
                        <div>
                            <span style="color: #6b7280; font-size: 9px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 3px;">Pemegang Tiket</span>
                            <span style="color: #C9A84C; font-size: 15px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.02em;">{{ $order->user->name }}</span>
                        </div>

                        <div class="pills-row">
                            <div class="pill-box">
                                <span class="pill-label">Kategori</span>
                                <span class="pill-value">{{ strtoupper(substr($order->ticketType->name, 0, 6)) }}</span>
                            </div>
                            <div class="pill-box">
                                <span class="pill-label">Kursi</span>
                                <span class="pill-value">A{{ 10 + ($order->quantity * 3) }}</span>
                            </div>
                            <div class="pill-box">
                                <span class="pill-label">Gate</span>
                                <span class="pill-value">B2</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Vertical Dotted Separator -->
            <div class="ticket-divider"></div>

            <!-- Right Section: Stub -->
            <div class="right-stub">
                
                <div>
                    <h3 style="color: white; font-size: 13px; font-weight: 800; text-transform: uppercase; margin: 0; font-family: 'Playfair Display', serif; line-height: 1.3; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; max-height: 34px;">
                        {{ $order->event->title }}
                    </h3>
                    <span style="color: #C9A84C; font-size: 8px; font-weight: 900; letter-spacing: 0.1em; text-transform: uppercase; display: block; margin-top: 3px;">
                        {{ str_replace('_', ' ', strtoupper($order->event->category)) }} TOUR
                    </span>
                </div>

                <!-- Stub QR Code -->
                <div style="background-color: white; padding: 8px; border-radius: 12px; border: 1px solid rgba(255, 255, 255, 0.1); display: inline-block;">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data={{ urlencode($order->id) }}&color=020d1a" 
                         alt="QR Code Ticket Stub" 
                         style="width: 100px; height: 100px; display: block; object-fit: contain;">
                </div>

                <!-- Booking code stub -->
                <div>
                    <span style="color: #6b7280; font-size: 8px; font-weight: 800; text-transform: uppercase; display: block; margin-bottom: 2px;">Kode Booking</span>
                    <span style="color: #C9A84C; font-size: 13px; font-weight: 900; letter-spacing: 0.05em;">
                        #{{ strtoupper(substr($order->id, 0, 8)) }}
                    </span>
                </div>

            </div>

        </div>
        
    </main>

</body>
</html>
