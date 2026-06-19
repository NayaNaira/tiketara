<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Register</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-[#020b18] min-h-screen text-white relative flex flex-col justify-between p-6 sm:p-10">

    <header class="px-4 sm:px-8 py-6">
        <img
            src="{{ asset('images/logotiket.png') }}"
            alt="Tiketara"
            class="h-10">
    </header>

    <div class="w-full max-w-md mx-auto my-auto flex flex-col justify-center">
        
        <div class="text-center md:text-left mb-6">
            <h1 class="text-[#cca43b] text-2xl sm:text-3xl font-bold tracking-wide mb-2">
                Selamat datang
            </h1>
            <p class="text-[#41628d] text-sm leading-relaxed">
                Buat akun kamu dengan memasukan nama, email dan password
            </p>
        </div>

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf

            @if(session('success'))
                <div class="mb-4 p-3 rounded-lg bg-green-500 text-white text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex flex-col space-y-1.5">
                <label class="text-[#41628d] text-xs font-semibold tracking-wide">Nama</label>
                <input 
                    type="text" 
                    name="name" 
                    value="{{ old('name') }}"
                    placeholder="Masukan nama" 
                    required 
                    class="w-full bg-white text-gray-900 px-4 py-3 rounded-xl border border-transparent focus:outline-none focus:ring-2 focus:ring-[#cca43b] placeholder-gray-400 font-medium text-sm transition"
                >
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col space-y-1.5">
                <label class="text-[#41628d] text-xs font-semibold tracking-wide">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    placeholder="Masukan email" 
                    required 
                    class="w-full bg-white text-gray-900 px-4 py-3 rounded-xl border border-transparent focus:outline-none focus:ring-2 focus:ring-[#cca43b] placeholder-gray-400 font-medium text-sm transition"
                >
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col space-y-1.5">
                <label class="text-[#41628d] text-xs font-semibold tracking-wide">Password</label>
                <div class="relative">
                    <input 
                        type="password" 
                        name="password" 
                        id="password"
                        placeholder="Masukan Password" 
                        required 
                        class="w-full bg-white text-gray-900 pl-4 pr-12 py-3 rounded-xl border border-transparent focus:outline-none focus:ring-2 focus:ring-[#cca43b] placeholder-gray-400 font-medium text-sm transition"
                    >
                    <button type="button" onclick="togglePassword('password', 'eyeIcon')" class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-600 transition">
                        <i id="eyeIcon" class="fa-regular fa-eye text-base"></i>
                    </button>
                </div>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col space-y-1.5">
                <label class="text-[#41628d] text-xs font-semibold tracking-wide">Konfirmasi Password</label>
                <div class="relative">
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        id="confirm_password"
                        placeholder="Masukan ulang Password" 
                        required 
                        class="w-full bg-white text-gray-900 pl-4 pr-12 py-3 rounded-xl border border-transparent focus:outline-none focus:ring-2 focus:ring-[#cca43b] placeholder-gray-400 font-medium text-sm transition"
                    >
                    <button type="button" onclick="togglePassword('confirm_password', 'eyeIconConfirm')" class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-600 transition">
                        <i id="eyeIconConfirm" class="fa-regular fa-eye text-base"></i>
                    </button>
                </div>
            </div>

            @if ($errors->any())
                <div class="text-red-400 text-xs py-1">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="pt-2">
                <button 
                    type="submit" 
                    class="w-full bg-[#cca43b] hover:bg-[#b08b30] text-[#020b18] font-bold py-3 rounded-xl transition shadow-md active:scale-[0.99]"
                >
                    Buat akun
                </button>
            </div>
        </form>

        <div class="text-center my-5">
            <span class="text-xs text-gray-400 tracking-wide">Atau buat akun dengan</span>
        </div>

        <div class="text-center mt-6 text-sm">
            <span class="text-gray-400">Sudah punya akun? </span>
            <a href="{{ route('login') }}" class="text-[#cca43b] hover:underline font-semibold ml-1">Masuk</a>
        </div>

    </div>

    <div class="h-4 md:hidden"></div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>