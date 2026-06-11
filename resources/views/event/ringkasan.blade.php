<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ringkasan Pesanan - Tiketara</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-[#020b18] min-h-screen text-white flex flex-col p-4 sm:p-6 md:p-10 relative">

    <div class="w-full border border-[#1e3a5f] rounded-2xl p-4 sm:p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-10">
        <div class="flex items-center space-x-4">
            <a href="{{ url()->previous() }}" class="flex items-center space-x-2 text-white hover:text-[#cca43b] transition text-xs font-semibold tracking-wider uppercase">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
        </div>
        
        <div class="md:text-right w-full md:w-auto">
            <h1 class="text-2xl font-light text-white">Ringkasan <span class="text-[#cca43b] font-normal">Pesanan</span></h1>
            <p class="text-gray-400 text-xs mt-1 font-medium tracking-wide">
                SZA in Jakarta · 14 Juli 2026 · Indonesia Arena
            </p>
        </div>
    </div>

    <main class="w-full max-w-xl mx-auto flex flex-col items-center my-auto space-y-6">
        
        <div class="w-full bg-[#020b18] border border-[#1e3a5f] rounded-2xl p-5 sm:p-6 shadow-xl space-y-5">
            <h2 class="text-center text-xs font-bold tracking-widest text-[#cca43b] uppercase">Ringkasan Pesanan</h2>
            
            <div class="flex items-center space-x-4 pb-4 border-b border-gray-900">
                <div class="w-12 h-12 rounded-lg overflow-hidden bg-gray-900 shrink-0">
                    <img src="https://images.unsplash.com/photo-1501386761578-eac5c94b800a?q=80&w=150" alt="SZA Concert" class="w-full h-full object-cover">
                </div>
                <div>
                    <h3 class="text-sm font-bold text-white tracking-wide">SZA in JAKARTA</h3>
                    <p class="text-gray-400 text-xxs mt-0.5 font-medium">14 Juli 2026 · 19:30 WIB · Indonesia Arena</p>
                </div>
            </div>

            <div class="space-y-3.5 text-xs">
    <div class="flex justify-between items-center pb-3 border-b border-gray-900/50">
        <span class="text-[#41628d] font-medium">Kategori</span>
        <span class="text-gray-200 font-semibold">VIP Tribune A</span>
    </div>
    
    <div class="flex justify-between items-center pb-3 border-b border-gray-900/50">
        <span class="text-[#41628d] font-medium">Jumlah Tiket</span>
        <span class="text-gray-200 font-semibold">2 Tiket</span>
    </div>
    
    <div class="flex justify-between items-center pb-3 border-b border-gray-900/50">
        <span class="text-[#41628d] font-medium">Nomor Kursi</span>
        <span class="text-gray-200 font-semibold">A10, A11</span>
    </div>
    
    <div class="flex justify-between items-center pb-3 border-b border-gray-900/50">
        <span class="text-[#41628d] font-medium">Harga Satuan</span>
        <span class="text-gray-200 font-semibold">Rp 1.500.000</span>
    </div>
    
    <div class="flex justify-between items-center pb-3 border-b border-gray-900">
        <span class="text-[#41628d] font-medium">Biaya Layanan</span>
        <span class="text-gray-200 font-semibold">Rp 30.000</span>
    </div>
    
    <div class="flex justify-between items-center pt-1.5">
        <span class="text-base font-bold text-white tracking-wide">Total</span>
        <span class="text-base font-bold text-[#cca43b]">Rp 3.030.000</span>
    </div>
</div>
        </div>

        <div class="w-full bg-[#020b18] border border-[#1e3a5f] rounded-2xl p-5 shadow-xl space-y-3">
            <h4 class="text-xxs font-bold tracking-widest text-[#cca43b] uppercase">Informasi Tiket</h4>
            <ul class="space-y-2 text-xxs text-gray-400 leading-relaxed font-medium">
                <li class="flex items-start">
                    <span class="text-blue-500 mr-2">✓</span>
                    <span>Download e-ticket sesudah transaksi berhasil</span>
                </li>
                <li class="flex items-start">
                    <span class="text-blue-500 mr-2">✓</span>
                    <span>Tunjukkan QR di gate masuk</span>
                </li>
                <li class="flex items-start">
                    <span class="text-blue-500 mr-2">✓</span>
                    <span>Tidak bisa di-refund / transfer</span>
                </li>
                <li class="flex items-start">
                    <span class="text-blue-500 mr-2">✓</span>
                    <span>Berlaku 1 orang per tiket</span>
                </li>
            </ul>
        </div>

        <div class="w-full pt-4">
            <form action="#" method="POST">
                @csrf
                <button type="submit" class="w-full bg-[#cca43b] hover:bg-[#b08b30] text-black font-bold text-xs py-3.5 rounded-lg flex items-center justify-center space-x-2 transition shadow-lg group uppercase tracking-wider active:scale-[0.99]">
                    <span>Lanjut ke Pembayaran</span>
                    <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                </button>
            </form>
        </div>

    </main>

</body>
</html>