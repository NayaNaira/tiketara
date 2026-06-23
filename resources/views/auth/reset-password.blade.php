<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kata Sandi Baru - TicketFlow</title>
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
            
            <h1 class="text-2xl md:text-3xl font-medium text-[#C9A84C] tracking-wide mb-3">
                Kata Sandi Baru
            </h1>
            
            <p class="text-sm md:text-base text-[#4A9FD4] mb-8 font-light max-w-sm mx-auto leading-relaxed">
                Masukkan kata sandi baru untuk email Anda
            </p>

            @if($errors->any())
                <div class="mb-8 p-3 bg-red-500/20 border border-red-500/50 text-red-300 text-sm rounded-xl text-center">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ request()->email }}">
                
                <div class="relative flex items-center">
                    <span class="absolute left-4 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                    </span>
                    <input type="password" id="password" name="password" placeholder="zara1819" class="w-full bg-[#E2E8F0] text-[#020D1A] font-medium py-3.5 pl-12 pr-12 rounded-xl focus:outline-none focus:ring-4 focus:ring-[#C9A84C]/50 transition duration-200 shadow-md placeholder-gray-400 text-sm md:text-base" required />
                    <button type="button" onclick="togglePassword('password', 'eyeIcon1')" class="absolute right-4 text-gray-400 hover:text-gray-600 transition">
                        <svg id="eyeIcon1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </button>
                </div>

                <div class="relative flex items-center">
                    <span class="absolute left-4 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                    </span>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="zara1819" class="w-full bg-[#E2E8F0] text-[#020D1A] font-medium py-3.5 pl-12 pr-12 rounded-xl focus:outline-none focus:ring-4 focus:ring-[#C9A84C]/50 transition duration-200 shadow-md placeholder-gray-400 text-sm md:text-base" required />
                    <button type="button" onclick="togglePassword('password_confirmation', 'eyeIcon2')" class="absolute right-4 text-gray-400 hover:text-gray-600 transition">
                        <svg id="eyeIcon2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </button>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-[#C9A84C] hover:bg-[#b59540] active:scale-[0.98] text-[#020D1A] font-bold py-3.5 rounded-xl transition-all duration-200 text-sm md:text-base tracking-wider shadow-lg">
                        Kirim
                    </button>
                </div>
            </form>
            
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

    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = document.getElementById(iconId);
            
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                // Mengubah icon mata coret menjadi mata terbuka ketika password terlihat
                eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />`;
            } else {
                passwordInput.type = "password";
                // Kembalikan ke icon mata dicoret
                eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />`;
            }
        }
    </script>
</body>
</html>