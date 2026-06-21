<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Sandi Berhasil - TicketFlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-[#020D1A] min-h-screen flex flex-col">

    <header class="px-4 sm:px-8 py-6">
        <a href="{{ url('/') }}" class="inline-block hover:opacity-90 transition">
            <img
                src="{{ asset('images/logotiket.png') }}"
                alt="Tiketara"
                class="h-10">
        </a>
    </header>

    <div class="flex-grow flex items-center justify-center w-full max-w-4xl mx-auto z-10 my-12">
        <div class="w-full max-w-md text-center px-4">
            
            <div class="flex justify-center mb-6">
                <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="48" stroke="#C9A84C" stroke-width="1.5" opacity="0.9"/>
                    <path d="M32 52L45 65L70 36" stroke="#C9A84C" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            
            <h1 class="text-2xl md:text-3xl font-medium text-[#C9A84C] tracking-wide mb-4">
                Berhasil!
            </h1>
            
            <p class="text-xs md:text-sm text-[#4A9FD4] mb-8 font-light max-w-xs mx-auto leading-relaxed tracking-wide">
                Kata sandi Anda telah berhasil diperbarui. Silahkan masuk kembali menggunakan kata sandi baru.
            </p>

            <div class="flex justify-center">
                <a href="#" class="w-full max-w-[280px] bg-[#C9A84C] hover:bg-[#b59540] active:scale-[0.98] text-[#020D1A] font-bold py-3 rounded-full transition-all duration-200 text-center text-sm tracking-wider shadow-lg block">
                    Login
                </a>
            </div>
            
        </div>
    </div>

    <div class="w-full text-center text-[11px] md:text-xs text-slate-500 font-light space-y-3 pt-6 border-t border-white/[0.03]">
        <p class="opacity-75">&copy; 2026 Tiketara. All rights reserved.</p>
        <div class="flex justify-center space-x-5 opacity-90">
            <a href="#" class="hover:text-[#4A9FD4] transition duration-150">Privacy Policy</a>
            <a href="#" class="hover:text-[#4A9FD4] transition duration-150">Terms of Service</a>
            <a href="#" class="hover:text-[#4A9FD4] transition duration-150">Support</a>
        </div>
    </div>

</body>
</html>