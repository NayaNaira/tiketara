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
    
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
</head>
<body class="bg-[#020b18] min-h-screen text-white flex flex-col p-4 sm:p-6 md:p-10 relative font-['DM_Sans',_sans-serif]">

    <div class="w-full border border-[#1e3a5f] rounded-2xl p-4 sm:p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-8">
        <div class="flex items-center space-x-4">
            <a href="{{ url()->previous() }}" class="flex items-center space-x-2 text-white hover:text-[#cca43b] transition text-xs font-semibold tracking-wider uppercase">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
        </div>
        
        <div class="flex-1 text-center">
            <h1 class="text-3xl text-white" style="font-family: 'Playfair Display', serif;">
                Pembayaran <span class="text-[#CCA43B]">Tiket</span>
            </h1>
        </div>
        <div class="w-4 hidden md:block"></div>
    </div>

    <main class="w-full max-w-xl mx-auto flex flex-col items-center my-auto space-y-8">
        
        <div class="flex items-center space-x-6 sm:space-x-12">
            <div class="flex flex-col items-center space-y-1">
                <div class="w-7 h-7 rounded-full bg-gray-800 border border-gray-700 text-gray-400 font-bold text-xs flex items-center justify-center">1</div>
                <span class="text-xxs text-gray-500 font-medium">Tiket</span>
            </div>
            <div class="h-[1px] w-8 sm:w-12 bg-gray-800"></div>
            
            <div class="flex flex-col items-center space-y-1">
                <div class="w-7 h-7 rounded-full bg-gray-800 border border-gray-700 text-gray-400 font-bold text-xs flex items-center justify-center">2</div>
                <span class="text-xxs text-gray-500 font-medium">Data Diri</span>
            </div>
            <div class="h-[1px] w-8 sm:w-12 bg-gray-800"></div>
            
            <div class="flex flex-col items-center space-y-1">
                <div class="w-7 h-7 rounded-full bg-[#cca43b] text-black font-bold text-xs flex items-center justify-center shadow">3</div>
                <span class="text-xxs text-gray-300 font-medium">Bayar</span>
            </div>
        </div>

        <div class="w-full flex flex-col items-center space-y-6">
            <div class="text-center w-full">
                <h2 class="text-xxs font-bold tracking-widest text-[#cca43b] uppercase mb-1">Metode Pembayaran</h2>
                <div class="w-24 h-[1px] bg-gray-800 mx-auto mt-3"></div>
            </div>

            <div class="border-2 border-[#cca43b] rounded-xl px-24 py-5 bg-transparent flex items-center justify-center select-none shadow-md">
                <span class="text-lg font-black tracking-wider text-white italic">MIDTRANS SNAP</span>
            </div>

            <p class="text-xxs tracking-wider text-[#41628d] font-bold uppercase">Klik tombol di bawah untuk membayar</p>

            <div class="bg-white/5 p-8 rounded-2xl border border-[#1e3a5f]/40 text-center w-48 h-48 flex flex-col items-center justify-center space-y-3">
                <i class="fa-solid fa-qrcode text-5xl text-[#cca43b] animate-pulse"></i>
                <span class="text-[10px] text-gray-400">Pop-up QRIS / Bank Transfer</span>
            </div>

            <div class="text-center space-y-1">
                <p class="text-xxs font-semibold tracking-widest text-[#41628d] uppercase">
                    {{ $order->event->title }} - {{ $order->ticketType->name }} ({{ $order->quantity }}x)
                </p>
                <p class="text-xl font-bold text-[#cca43b] tracking-wide">
                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                </p>
            </div>

            <div class="w-full pt-4">
                <button type="button" id="pay-button" class="w-full bg-[#cca43b] hover:bg-[#b08b30] text-black font-bold text-xs py-3.5 rounded-lg flex items-center justify-center space-x-2 transition shadow-lg group uppercase tracking-wider active:scale-[0.99] cursor-pointer">
                    <span>Buka Pop-up Pembayaran</span>
                    <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                </button>
            </div>
        </div>

    </main>

    <script type="text/javascript">
        const payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            // Membuka pop-up transaksi Midtrans aman menggunakan Snap Token dari Controller
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    alert("Pembayaran berhasil dicatat! Mengalihkan ke E-Tiket...");
                    // Lempar otomatis ke halaman cetak E-Tiket ber-barcode
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
    </script>

</body>
</html>