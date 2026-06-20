<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Berhasil - TicketFlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #020D1A;
        }
        <!-- efek -->
        .fade-in {
            animation: fadeIn 0.8s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-[#020D1A] min-h-screen flex flex-col">

    <header class="px-4 sm:px-8 py-6">
        <img
            src="{{ asset('images/logo.png') }}"
            alt="Tiketara"
            class="h-10">
    </header>

    <div class="flex-grow flex items-center justify-center w-full max-w-md mx-auto fade-in">
        <div class="w-full text-center px-4">
            
            <div class="flex justify-center mb-8">
                <div class="relative">
                    <svg width="120" height="120" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="50" cy="50" r="48" stroke="#C9A84C" stroke-width="2"/>
                        <path d="M30 52L43 65L70 38" stroke="#C9A84C" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
            
            <h1 class="text-3xl md:text-4xl font-medium text-[#C9A84C] tracking-wide mb-3">
                Verifikasi Berhasil!
            </h1>
            
            <p class="text-base md:text-lg text-[#4A9FD4] mb-10 font-light leading-relaxed">
                Silahkan klik tombol lanjutkan
            </p>

            <div class="flex justify-center">
                <a href="{{ url('/') }}" class="w-full max-w-[320px] bg-[#C9A84C] hover:bg-[#b59540] active:scale-95 text-[#020D1A] font-bold py-3.5 px-6 rounded-full transition-all duration-200 text-center text-sm md:text-base tracking-wider shadow-lg block">
                    Lanjutkan
                </a>
            </div>
            
        </div>
    </div>

    <div class="w-full text-center text-[11px] md:text-xs text-slate-400 font-light space-y-3 pt-6">
        <p class="opacity-75">&copy; 2026 TicketFlow Management Systems. All rights reserved.</p>
        <div class="flex justify-center space-x-5 opacity-90">
            <a href="#" class="hover:text-[#4A9FD4] transition duration-150">Privacy Policy</a>
            <a href="#" class="hover:text-[#4A9FD4] transition duration-150">Terms of Service</a>
            <a href="#" class="hover:text-[#4A9FD4] transition duration-150">Support</a>
        </div>
    </div>

</body>
</html>