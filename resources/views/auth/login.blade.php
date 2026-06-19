<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiketara - Masuk</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-[#020D1A] min-h-screen flex flex-col justify-between text-white p-6 relative select-none">

    <header class="px-4 sm:px-8 py-4">
    <img
        src="{{ asset('images/logotiket.png') }}"
        alt="Tiketara"
        class="h-14 w-auto">
    </header>

    <main class="flex-grow flex items-center justify-center w-full max-w-4xl mx-auto z-10 my-12">
        <div class="w-full max-w-md bg-[#041830]/60 p-8 md:p-10 rounded-2xl border border-white/[0.03] shadow-2xl backdrop-blur-sm">

            <h2 class="text-3xl font-semibold text-[#C9A84C] tracking-wide mb-2">
                Selamat Datang!
            </h2>

            <p class="text-[#4A9FD4] text-sm font-light mb-8 leading-relaxed">
                Kelola konser dan transaksi dalam satu platform.
            </p>

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-300 tracking-wide">
                        Email
                    </label>
                    <div class="relative flex items-center">
                        <input
                            type="email"
                            name="email"
                            placeholder="@email.com"
                            class="w-full bg-[#E2E8F0] text-[#020D1A] font-medium py-3 px-4 rounded-xl placeholder-gray-400 text-sm md:text-base outline-none focus:outline-none"
                            required>
                    </div>
                </div>
                @error('email')
                     <div class="mt-2 text-sm text-red-400">
                      {{ $message }}
                     </div>
                @enderror

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-300 tracking-wide">
                        Password
                    </label>
                    <div class="relative flex items-center">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="********"
                            class="w-full bg-[#E2E8F0] text-[#020D1A] font-medium py-3 pl-4 pr-12 rounded-xl placeholder-gray-400 text-sm md:text-base outline-none focus:outline-none"
                            required>

                        <button
                            type="button"
                            onclick="togglePassword('password', 'eyeIconVisible', 'eyeIconHidden')"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 transition duration-150 active:scale-95">
                            
                            <svg id="eyeIconVisible" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>

                            <svg id="eyeIconHidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <div class="flex items-center justify-between gap-2 pt-1">
                    <label class="flex items-center gap-2 text-xs sm:text-sm text-gray-300 cursor-pointer">
                        <input type="checkbox" name="remember" class="accent-[#C9A84C] rounded">
                        Ingat Saya
                    </label>

                    <a href="/forgot-password" class="text-xs sm:text-sm text-[#4A9FD4] hover:text-cyan-300 hover:underline transition whitespace-nowrap">
                        Lupa Password?
                    </a>
                </div>

                <div class="space-y-4">

                        <button
                            type="submit"
                            class="w-full bg-[#C9A84C] hover:opacity-90 transition text-black font-semibold py-3 rounded-md">

                            Masuk →
                        </button>

                        <a 
                        href="#"
                        class="w-full border border-[#C9A84C] hover:bg-white/5 text-white font-medium py-3 rounded-md flex items-center justify-center gap-3 transition">

                        <img
                            src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg"
                            alt="Google"
                            class="w-5 h-5">

                        <span>Masuk dengan Google</span>

                    </a>

                    </div>
                

            </form>
            <div class="border-t border-[#4A9FD4]/40 mt-8 pt-5">

                    <p class="text-center text-sm">

                        <span class="text-[#4A9FD4]">
                            Belum punya akun?
                        </span>

                        <a
                            href="/register"
                            class="text-[#C9A84C] hover:underline font-medium">

                            Registrasi

                        </a>

                    </p>

                </div>
        </div>
    </main>

    <footer class="text-center mt-8">

                <p class="text-gray-300 text-xs">
                    ©2026 TicketFlow Management Systems.
                    All rights reserved.
                </p>

                <div class="flex justify-center gap-6 mt-4 text-xs">

                    <a href="#" class="text-gray-300 hover:text-[#C9A84C]">
                        Privacy Policy
                    </a>

                    <a href="#" class="text-gray-300 hover:text-[#C9A84C]">
                        Terms of Service
                    </a>

                    <a href="#" class="text-gray-300 hover:text-[#C9A84C]">
                        Support
                    </a>

                </div>

            </footer>

    <script>
        function togglePassword(inputId, visibleIconId, hiddenIconId) {
            const passwordInput = document.getElementById(inputId);
            const iconVisible = document.getElementById(visibleIconId);
            const iconHidden = document.getElementById(hiddenIconId);

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                iconVisible.classList.add('hidden');
                iconHidden.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                iconVisible.classList.remove('hidden');
                iconHidden.classList.add('hidden');
            }
        }
    </script>
</body>
</html>