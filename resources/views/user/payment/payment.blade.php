<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - Tiketara</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @if(!isset($isMock) || !$isMock)
        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    @endif
</head>
<body class="bg-[#020D1A] min-h-screen text-white flex flex-col p-4 sm:p-6 md:p-10 relative font-['DM_Sans',_sans-serif]">

    <!-- Verification Spinner Overlay -->
    <div id="spinner-overlay" class="hidden fixed inset-0 z-50 flex flex-col items-center justify-center bg-black/90 backdrop-blur-sm">
        <div class="flex flex-col items-center space-y-4 text-center px-6">
            <i class="fa-solid fa-circle-notch text-5xl text-[#C9A84C] animate-spin"></i>
            <p class="text-sm font-bold text-white tracking-wide uppercase mt-2">Memverifikasi Pembayaran...</p>
            <p class="text-xs text-gray-400 max-w-xs leading-relaxed">Mohon tunggu sebentar, sistem sedang memverifikasi transaksi Anda.</p>
        </div>
    </div>

    <!-- Navigation Header -->
    <div class="w-full border border-[#1e3a5f]/40 bg-[#031124]/40 backdrop-blur-md rounded-2xl p-4 sm:p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-8">
        <div class="flex items-center space-x-4">
            <a href="{{ url()->previous() }}" class="flex items-center space-x-2 text-gray-400 hover:text-white transition text-xs font-semibold tracking-wider uppercase">
                <i class="fa-solid fa-chevron-left"></i>
                <span>Kembali</span>
            </a>
        </div>
        
        <div class="flex-1 text-center">
            <h1 class="text-2xl sm:text-3xl text-white" style="font-family: 'Playfair Display', serif;">
                Pembayaran <span class="text-[#C9A84C]">Tiket</span>
            </h1>
        </div>
        <div class="w-16 hidden md:block"></div>
    </div>

    <main class="w-full max-w-lg mx-auto flex-1 flex flex-col justify-center my-4 space-y-6">
        
        <!-- Step Indicator -->
        <div class="flex items-center justify-center space-x-6 sm:space-x-12 pb-4">
            <div class="flex flex-col items-center space-y-1">
                <div class="w-6 h-6 rounded-full bg-gray-800 border border-gray-700 text-gray-400 font-bold text-[10px] flex items-center justify-center">1</div>
                <span class="text-[9px] text-gray-500 font-medium">Tiket</span>
            </div>
            <div class="h-[1px] w-8 sm:w-12 bg-gray-800"></div>
            
            <div class="flex flex-col items-center space-y-1">
                <div class="w-6 h-6 rounded-full bg-gray-800 border border-gray-700 text-gray-400 font-bold text-[10px] flex items-center justify-center">2</div>
                <span class="text-[9px] text-gray-500 font-medium">Data Diri</span>
            </div>
            <div class="h-[1px] w-8 sm:w-12 bg-gray-800"></div>
            
            <div class="flex flex-col items-center space-y-1">
                <div class="w-6 h-6 rounded-full bg-[#C9A84C] text-black font-bold text-[10px] flex items-center justify-center shadow">3</div>
                <span class="text-[9px] text-gray-300 font-medium">Bayar</span>
            </div>
        </div>

        @if(isset($isMock) && $isMock)
            <!-- MOCK REALISTIC QRIS PAGE -->
            <div class="w-full bg-[#031124] border border-[#C9A84C]/25 rounded-3xl p-6 shadow-2xl flex flex-col items-center space-y-6">
                
                <div class="w-full text-center space-y-1.5 border-b border-[#1e3a5f]/20 pb-4">
                    <span class="text-[10px] font-bold tracking-widest text-[#C9A84C] uppercase">QRIS / E-Wallet</span>
                    <h2 class="text-base font-bold text-white uppercase tracking-wide">
                        {{ $order->event->title }}
                    </h2>
                    <p class="text-xs text-gray-400">
                        {{ $order->ticketType->name }} ({{ $order->quantity }}x)
                    </p>
                </div>

                <!-- Timer & Amount Grid -->
                <div class="w-full grid grid-cols-2 gap-4 bg-[#020D1A] border border-[#1e3a5f]/15 rounded-2xl p-4 text-xs font-semibold text-center">
                    <div class="border-r border-[#1e3a5f]/15">
                        <span class="text-gray-500 block text-[9px] uppercase tracking-wider mb-1">Batas Waktu Bayar</span>
                        <span id="timer" class="text-sm font-bold text-yellow-500 tracking-wider">15:00</span>
                    </div>
                    <div>
                        <span class="text-gray-500 block text-[9px] uppercase tracking-wider mb-1">Total Pembayaran</span>
                        <span class="text-sm font-bold text-[#C9A84C]">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <!-- QRIS Logo & Code Container -->
                <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-lg text-center flex flex-col items-center justify-center space-y-3 relative overflow-hidden group">
                    <div class="flex items-center space-x-1.5 border-b border-gray-100 pb-2 mb-1 w-full justify-center">
                        <span class="text-[11px] font-extrabold text-blue-900 tracking-tighter italic">QRIS</span>
                        <span class="text-[8px] bg-red-600 text-white font-bold px-1 rounded">GPN</span>
                    </div>
                    
                    <!-- Scan to Simulate QR Code -->
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode(route('buyer.order.payment.simulate', $order->id)) }}&color=020d1a" 
                         alt="QR Code QRIS" 
                         class="w-48 h-48 object-contain">
                    
                    <p class="text-[9px] text-gray-400 font-medium tracking-wide">Pindai kode QR untuk membayar</p>
                </div>

                <!-- Payment Instructions -->
                <div class="w-full text-left bg-[#020D1A]/50 border border-[#1e3a5f]/10 rounded-xl p-4 space-y-2 text-[10px] text-gray-400 leading-relaxed font-medium">
                    <div class="flex items-start gap-2.5">
                        <span class="bg-[#C9A84C]/10 text-[#C9A84C] w-4.5 h-4.5 rounded-full flex items-center justify-center shrink-0 border border-[#C9A84C]/25 text-[9px] font-bold">1</span>
                        <span>Buka aplikasi E-Wallet (GoPay, OVO, Dana, LinkAja) atau Mobile Banking Anda.</span>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <span class="bg-[#C9A84C]/10 text-[#C9A84C] w-4.5 h-4.5 rounded-full flex items-center justify-center shrink-0 border border-[#C9A84C]/25 text-[9px] font-bold">2</span>
                        <span>Pilih opsi scan/pindai kode QR, arahkan ke kode QRIS di atas.</span>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <span class="bg-[#C9A84C]/10 text-[#C9A84C] w-4.5 h-4.5 rounded-full flex items-center justify-center shrink-0 border border-[#C9A84C]/25 text-[9px] font-bold">3</span>
                        <span>Periksa rincian tagihan Anda, lalu masukkan PIN untuk menyelesaikan transaksi.</span>
                    </div>
                </div>

                <!-- Actions -->
                <div class="w-full space-y-2 pt-2">
                    <button type="button" id="check-status-btn" class="w-full bg-[#C9A84C] hover:bg-[#b0923e] text-[#020D1A] font-bold text-xs py-3.5 rounded-xl flex items-center justify-center space-x-2 transition shadow-lg uppercase tracking-wider cursor-pointer">
                        <span>Cek Status Pembayaran</span>
                        <i class="fa-solid fa-arrows-rotate text-xs"></i>
                    </button>
                </div>
            </div>

        @else
            <!-- ACTUAL MIDTRANS SNAP PAGE -->
            <div class="w-full bg-[#031124] border border-[#1e3a5f]/40 rounded-3xl p-6 shadow-2xl flex flex-col items-center space-y-6">
                
                <div class="text-center w-full space-y-1.5 border-b border-[#1e3a5f]/20 pb-4">
                    <span class="text-[10px] font-bold tracking-widest text-[#C9A84C] uppercase">Gerbang Pembayaran Digital</span>
                    <h2 class="text-base font-bold text-white uppercase tracking-wide">
                        {{ $order->event->title }}
                    </h2>
                    <p class="text-xs text-gray-400">
                        {{ $order->ticketType->name }} ({{ $order->quantity }}x)
                    </p>
                </div>

                <div class="border border-[#C9A84C]/25 rounded-2xl px-12 py-4 bg-transparent flex items-center justify-center select-none shadow-md">
                    <span class="text-base font-black tracking-wider text-[#C9A84C] italic">MIDTRANS SNAP</span>
                </div>

                <div class="bg-[#020D1A] p-8 rounded-2xl border border-[#1e3a5f]/30 text-center w-48 h-48 flex flex-col items-center justify-center space-y-3">
                    <i class="fa-solid fa-qrcode text-5xl text-[#C9A84C] animate-pulse"></i>
                    <span class="text-[10px] text-gray-400">Pop-up QRIS / Bank Transfer</span>
                </div>

                <div class="text-center space-y-1">
                    <span class="text-[10px] text-gray-500 uppercase tracking-widest font-semibold block">Total Tagihan</span>
                    <p class="text-xl font-bold text-[#C9A84C] tracking-wide">
                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </p>
                </div>

                <div class="w-full pt-4">
                    <button type="button" id="pay-button" class="w-full bg-[#C9A84C] hover:bg-[#b0923e] text-[#020D1A] font-bold text-xs py-3.5 rounded-xl flex items-center justify-center space-x-2 transition shadow-lg group uppercase tracking-wider active:scale-[0.99] cursor-pointer">
                        <span>Buka Pop-up Pembayaran</span>
                        <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                    </button>
                </div>
            </div>
        @endif

    </main>

    <footer class="text-center text-[10px] text-gray-500 py-6">
        <p>© 2026 Tiketara. All rights reserved.</p>
    </footer>

    <script type="text/javascript">
        // Countdown Timer Script (15 minutes)
        let time = 15 * 60; 
        const timerElement = document.getElementById('timer');
        if (timerElement) {
            const interval = setInterval(() => {
                const minutes = Math.floor(time / 60);
                const seconds = time % 60;
                timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                if (time <= 0) {
                    clearInterval(interval);
                    timerElement.textContent = "EXPIRED";
                }
                time--;
            }, 1000);
        }

        @if(isset($isMock) && $isMock)
            // MODE REALISTIK DUMMY GATEWAY (QRIS)
            const checkStatusBtn = document.getElementById('check-status-btn');
            const spinnerOverlay = document.getElementById('spinner-overlay');
            
            // 1. Polling status from server (checks if they scanned QR with phone)
            setInterval(() => {
                fetch("{{ route('buyer.order.checkStatus', $order->id) }}")
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'paid') {
                            spinnerOverlay.classList.remove('hidden');
                            setTimeout(() => {
                                window.location.href = "{{ route('buyer.order.ticket', $order->id) }}";
                            }, 1000);
                        }
                    });
            }, 2000);

            // 2. Click button to manually trigger verification spinner and success redirect
            if (checkStatusBtn) {
                checkStatusBtn.addEventListener('click', function() {
                    checkStatusBtn.disabled = true;
                    spinnerOverlay.classList.remove('hidden');
                    setTimeout(() => {
                        window.location.href = "{{ route('buyer.order.payment.simulate', $order->id) }}";
                    }, 1800);
                });
            }
        @else
            // MODE RIIL MIDTRANS SNAP
            const payButton = document.getElementById('pay-button');
            if (payButton) {
                payButton.addEventListener('click', function () {
                    window.snap.pay('{{ $snapToken }}', {
                        onSuccess: function(result){
                            alert("Pembayaran berhasil dicatat! Mengalihkan ke E-Tiket...");
                            window.location.href = "{{ route('buyer.order.ticket', $order->id) }}";
                        },
                        onPending: function(result){
                            alert("Menunggu penyelesaian pembayaran Anda.");
                            window.location.reload();
                        },
                        onError: function(result){
                            alert("Transaksi gagal. Silakan coba lagi.");
                        },
                        onClose: function(){
                            alert('Anda menutup pop-up sebelum menyelesaikan pembayaran.');
                        }
                    });
                });
            }
        @endif
    </script>
</body>
</html>