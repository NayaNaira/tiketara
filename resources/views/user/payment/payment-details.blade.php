<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transfer Pembayaran - Tiketara</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-[#020b18] min-h-screen text-white flex flex-col p-4 sm:p-6 md:p-10 relative" 
      x-data="{ showModal: false }"> <div class="w-full border border-[#1e3a5f] rounded-2xl p-4 sm:p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-10">
        <div class="flex items-center space-x-4">
            <a href="{{ url()->previous() }}" class="flex items-center space-x-2 text-white hover:text-[#cca43b] transition text-xs font-semibold tracking-wider uppercase">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
        </div>
        
        <div class="text-left md:text-center w-full">
            <h1 class="text-2xl font-light text-white">Pembayaran <span class="text-[#cca43b] font-normal">Pesanan</span></h1>
            <p class="text-gray-400 text-xs mt-1 font-medium tracking-wide">
                SZA in Jakarta · 14 Juli 2026 · Indonesia Arena
            </p>
        </div>
    </div>

    <main class="w-full max-w-xl mx-auto flex flex-col items-center my-auto space-y-6">
        
        <div class="w-full bg-[#020b18] border border-[#1e3a5f] rounded-2xl p-5 sm:p-6 shadow-xl space-y-5">
            <h2 class="text-xs font-bold tracking-widest text-[#cca43b] uppercase">Detail Transfer</h2>
            
            <div class="space-y-3.5 text-xs">
                <div class="flex justify-between items-center pb-3 border-b border-gray-900/50">
                    <span class="text-[#41628d] font-medium">Bank</span>
                    <span class="text-gray-200 font-semibold uppercase">QRIS BCA</span>
                </div>
                
                <div class="flex justify-between items-center pb-3 border-b border-gray-900/50">
                    <span class="text-[#41628d] font-medium">No. Rekening</span>
                    <span class="text-gray-200 font-semibold tracking-wider">1276-4735-7453</span>
                </div>
                
                <div class="flex justify-between items-center pb-3 border-b border-gray-900/50">
                    <span class="text-[#41628d] font-medium">Atas Nama</span>
                    <span class="text-gray-200 font-semibold">Zara</span>
                </div>
                
                <div class="flex justify-between items-center pb-3 border-b border-gray-900/50">
                    <span class="text-[#41628d] font-medium">Total Transfer</span>
                    <span class="text-gray-200 font-semibold">Rp 3.030.000</span>
                </div>
                
                <div class="flex justify-between items-center">
                    <span class="text-[#41628d] font-medium">Kode Unik</span>
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-200 font-semibold">030</span>
                        <span class="text-xxs text-gray-500 font-medium">Sudah termasuk</span>
                    </div>
                </div>
            </div>
        </div>

        <form action="#" method="POST" id="paymentForm" class="w-full pt-2">
            @csrf
            <button type="button" @click="showModal = true" class="w-full bg-[#cca43b] hover:bg-[#b08b30] text-black font-bold text-xs py-3.5 rounded-lg flex items-center justify-center space-x-2 transition shadow-lg group uppercase tracking-wider active:scale-[0.99]">
                <span>Konfirmasi Pembayaran</span>
                <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
            </button>
        </form>
    </main>

    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70"
         x-show="showModal"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         style="display: none;">
         
        <div class="w-full max-w-md bg-[#1a0507] border border-[#7a1822] rounded-2xl p-6 shadow-2xl space-y-5">
            <div class="flex items-start space-x-3">
                <div class="text-[#f87171] text-lg shrink-0 mt-0.5">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div class="space-y-1">
                    <h3 class="text-sm font-bold text-[#f87171] tracking-wide">Penting! Konfirmasi Transfer</h3>
                    <p class="text-xs text-gray-300 leading-relaxed font-medium">
                        Apakah Anda sudah melakukan transfer tepat sebesar <span class="text-white font-bold">Rp 3.030.000</span>?
                    </p>
                    <p class="text-xxs text-gray-400">
                        Nomor nominal yang berbeda atau tidak menyertakan kode unik akan mengakibatkan pesanan otomatis dibatalkan oleh sistem.
                    </p>
                </div>
            </div>

            <div class="flex items-center justify-end space-x-3 pt-2 text-xs font-semibold">
                <button type="button" @click="showModal = false" class="px-4 py-2 rounded-lg text-gray-400 hover:text-white transition uppercase tracking-wider text-xxs">
                    Batal
                </button>
                <button type="button" onclick="document.getElementById('paymentForm').submit();" class="px-4 py-2 bg-[#7a1822] hover:bg-[#99202c] text-white rounded-lg transition uppercase tracking-wider text-xxs shadow-md">
                    Ya, Sudah Transfer
                </button>
            </div>
        </div>
    </div>

</body>
</html>