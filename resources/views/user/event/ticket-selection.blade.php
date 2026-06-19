<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beli Tiket - Tiketara</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    
</head>
<body class="bg-[#020b18] min-h-screen text-white flex flex-col p-4 sm:p-6 md:p-10 relative font-['DM_Sans',_sans-serif]">
    <div class="w-full border border-[#1e3a5f] rounded-2xl p-4 sm:p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-8">
        <div class="flex items-center space-x-4">
            <a href="{{ url()->previous() }}" class="flex items-center space-x-2 text-white hover:text-[#cca43b] transition text-xs font-semibold tracking-wider uppercase">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
        </div>
        
        <div class="flex-1 text-center">
        <h1
            class="text-3xl text-white"
            style="font-family: 'Playfair Display', serif;">
            Beli
            <span class="text-[#CCA43B]">Tiket</span>
        </h1>

            <p class="text-[#4A9FD4] text-sm mt-2 tracking-wide">
                SZA in Jakarta · 14 Juli 2026 · Indonesia Arena
            </p>
        </div>
    </div>

    <main class="w-full max-w-xl mx-auto flex flex-col items-center my-auto space-y-8">
        
        <div class="flex items-center space-x-6 sm:space-x-12">
            <div class="flex flex-col items-center space-y-1">
                <div class="w-7 h-7 rounded-full bg-[#cca43b] text-black font-bold text-xs flex items-center justify-center shadow">1</div>
                <span class="text-xxs text-gray-300 font-medium">Tiket</span>
            </div>
            <div class="h-[1px] w-8 sm:w-12 bg-gray-800"></div>
            <div class="flex flex-col items-center space-y-1">
                <div class="w-7 h-7 rounded-full border border-gray-700 text-gray-400 text-xs flex items-center justify-center">2</div>
                <span class="text-xxs text-gray-500 font-medium">Data Diri</span>
            </div>
            <div class="h-[1px] w-8 sm:w-12 bg-gray-800"></div>
            <div class="flex flex-col items-center space-y-1">
                <div class="w-7 h-7 rounded-full border border-gray-700 text-gray-400 text-xs flex items-center justify-center">3</div>
                <span class="text-xxs text-gray-500 font-medium">Bayar</span>
            </div>
        </div>

        <form action="#" method="POST" class="w-full space-y-6 flex flex-col items-center">
            @csrf
            
            <div class="w-full text-center">
                <h2 class="text-xxs font-bold tracking-widest text-[#cca43b] uppercase mb-4">Pilih Kategori Tiket</h2>
                
                <div class="space-y-3 text-left">
                    
                    <label class="block relative border border-[#1e3a5f] rounded-xl p-4 bg-[#020b18] cursor-pointer hover:bg-white/5 transition group">
                        <input type="radio" name="ticket_category" value="vvip" class="sr-only peer" required checked>
                        <div class="absolute inset-0 border-2 border-transparent peer-checked:border-[#cca43b] rounded-xl transition"></div>
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-sm font-semibold text-white">VVIP - Front Floor</h4>
                                <p class="text-xxs text-gray-400 mt-1">Area depan, akses eksklusif merch</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-[#cca43b]">Rp 2.500.000</p>
                                <p class="text-xxs text-gray-500 mt-1">24 sisa</p>
                            </div>
                        </div>
                    </label>

                    <label class="block relative border border-[#1e3a5f] rounded-xl p-4 bg-[#020b18] cursor-pointer hover:bg-white/5 transition group">
                        <input type="radio" name="ticket_category" value="vip" class="sr-only peer">
                        <div class="absolute inset-0 border-2 border-transparent peer-checked:border-[#cca43b] rounded-xl transition"></div>
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-sm font-semibold text-white">VIP - Tribune A</h4>
                                <p class="text-xxs text-gray-400 mt-1">Tempat duduk premium, view terbaik</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-[#cca43b]">Rp 1.500.000</p>
                                <p class="text-xxs text-gray-500 mt-1">142 sisa</p>
                            </div>
                        </div>
                    </label>

                    <label class="block relative border border-[#1e3a5f] rounded-xl p-4 bg-[#020b18] cursor-pointer hover:bg-white/5 transition group">
                        <input type="radio" name="ticket_category" value="festival" class="sr-only peer">
                        <div class="absolute inset-0 border-2 border-transparent peer-checked:border-[#cca43b] rounded-xl transition"></div>
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-sm font-semibold text-white">Festival - Tribune B/C</h4>
                                <p class="text-xxs text-gray-400 mt-1">Tempat duduk area tribune belakang</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-[#cca43b]">Rp 850.000</p>
                                <p class="text-xxs text-gray-500 mt-1">600+</p>
                            </div>
                        </div>
                    </label>

                </div>
            </div>

            <div class="w-full flex flex-col items-center space-y-2 pt-2">
                <h3 class="text-xxs font-bold tracking-widest text-[#cca43b] uppercase">Jumlah Tiket</h3>
                
                <div class="flex items-center space-x-4 bg-transparent py-1 px-2">
                    <button type="button" id="btn-minus" class="w-8 h-8 rounded-lg bg-[#3b82f6] text-white flex items-center justify-center font-bold text-lg hover:bg-blue-600 transition focus:outline-none">-</button>
                    <input type="number" name="quantity" id="ticket-qty" value="1" min="1" max="4" readonly class="w-10 bg-transparent text-center font-bold text-lg text-white focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                    <button type="button" id="btn-plus" class="w-8 h-8 rounded-lg bg-[#3b82f6] text-white flex items-center justify-center font-bold text-lg hover:bg-blue-600 transition focus:outline-none">+</button>
                </div>
                
                <p class="text-xxs text-gray-500 font-medium">Maks. 4 tiket per transaksi</p>
            </div>

            <div class="w-full pt-4">
                <button type="submit" class="w-full bg-[#cca43b] hover:bg-[#b08b30] text-black font-bold text-xs py-3.5 rounded-lg flex items-center justify-center space-x-2 transition shadow-lg group uppercase tracking-wider">
                    <span>Lanjut ke Data Diri</span>
                    <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                </button>
            </div>

        </form>
    </main>

    <script>
        const qtyInput = document.getElementById('ticket-qty');
        const btnMinus = document.getElementById('btn-minus');
        const btnPlus = document.getElementById('btn-plus');
        const maxTickets = 4;

        btnMinus.addEventListener('click', () => {
            let currentVal = parseInt(qtyInput.value);
            if (currentVal > 1) {
                qtyInput.value = currentVal - 1;
            }
        });

        btnPlus.addEventListener('click', () => {
            let currentVal = parseInt(qtyInput.value);
            if (currentVal < maxTickets) {
                qtyInput.value = currentVal + 1;
            }
        });
    </script>

</body>
</html>