<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Tiket - Tiketara</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-[#020b18] min-h-screen text-white flex flex-col p-4 sm:p-6 md:p-10 relative">

    <div class="w-full border border-[#1e3a5f] rounded-2xl p-4 sm:p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-8">
        <div class="flex items-center space-x-4">
            <a href="{{ url()->previous() }}" class="flex items-center space-x-2 text-white hover:text-[#cca43b] transition text-xs font-semibold tracking-wider uppercase">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
        </div>
        
        <div class="md:text-right w-full md:w-auto">
            <h1 class="text-2xl font-light text-white">Pembayaran <span class="text-[#cca43b] font-normal">Tiket</span></h1>
            <p class="text-gray-400 text-xs mt-1 font-medium tracking-wide">
                SZA in Jakarta · 14 Juli 2026 · Indonesia Arena
            </p>
        </div>
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

            <div class="border-2 border-[#cca43b] rounded-xl px-25 py-6 bg-transparent flex items-center justify-center select-none shadow-md">
                <span class="text-lg font-black tracking-wider text-white italic">QRIS</span>
            </div>

            <p class="text-xxs tracking-wider text-[#41628d] font-bold uppercase">Scan QR di bawah</p>

            <div class="bg-white p-4 rounded-2xl shadow-2xl transition hover:scale-[1.01] duration-300">
                {!! QrCode::size(200)->backgroundColor(255,255,255)->color(0,0,0)->generate('SZA-JKT-2-VIP-3030000') !!}
            </div>

            <div class="text-center space-y-1">
                <p class="text-xxs font-semibold tracking-widest text-[#41628d] uppercase">SZA-JKT-2-VIP</p>
                <p class="text-xl font-bold text-[#cca43b] tracking-wide">Rp 3.030.000</p>
            </div>

            <div class="w-full pt-4">
                <form action="#" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-[#cca43b] hover:bg-[#b08b30] text-black font-bold text-xs py-3.5 rounded-lg flex items-center justify-center space-x-2 transition shadow-lg group uppercase tracking-wider active:scale-[0.99]">
                        <span>Konfirmasi Pembayaran</span>
                        <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                    </button>
                </form>
            </div>
        </div>

    </main>

</body>
</html>