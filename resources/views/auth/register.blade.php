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
                  <div class="mb-4 p-3 rounded-lg bg-green-500 text-white">
                       {{ session('success') }}
                  </div>
             @endif

            <form action="{{ route('register') }}" method="POST">


            <div class="flex flex-col space-y-1.5">
                <label class="text-[#41628d] text-xs font-semibold tracking-wide">Nama *</label>
                <input 
                    type="text" 
                    name="name" 
                    value="{{ old('name') }}"
                    placeholder="Masukan nama" 
                    required 
                    class="w-full bg-white text-gray-900 px-4 py-3 rounded-xl border border-transparent focus:outline-none focus:ring-2 focus:ring-[#cca43b] placeholder-gray-400 font-medium text-sm transition"
                >
            </div>

            <div class="flex flex-col space-y-1.5">
                <label class="text-[#41628d] text-xs font-semibold tracking-wide">Email *</label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    placeholder="Masukan email" 
                    required 
                    class="w-full bg-white text-gray-900 px-4 py-3 rounded-xl border border-transparent focus:outline-none focus:ring-2 focus:ring-[#cca43b] placeholder-gray-400 font-medium text-sm transition"
                >
            </div>
                <!-- Nama -->
                <div class="mb-5">

                    <label class="block text-[#4A9FD4] text-sm mb-2">
                        Nama *
                    </label>

                    <input
                        type="text"
                        name="name"
                        placeholder="Masukan nama"
                        class="w-full h-12 px-4 rounded-xl bg-[#ECECEC] text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]">
                  
                    @error('name')
                      <p class="text-red-500 text-sm mt-1">
                       {{ $message }}
                      </p>
                    @enderror


            <div class="flex flex-col space-y-1.5">
                <label class="text-[#41628d] text-xs font-semibold tracking-wide">Password *</label>
                <div class="relative">
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="Masukan Password" 
                        required 
                        class="w-full bg-white text-gray-900 pl-4 pr-12 py-3 rounded-xl border border-transparent focus:outline-none focus:ring-2 focus:ring-[#cca43b] placeholder-gray-400 font-medium text-sm transition"
                    >
                    <button type="button" class="toggle-password absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-600 transition">
                        <i class="fa-regular fa-eye text-base"></i>
                    </button>
                </div>
                

                <!-- Email -->
                <div class="mb-5">

                    <label class="block text-[#4A9FD4] text-sm mb-2">
                        Email *
                    </label>

                    <input
                        type="email"
                        name="email"
                        placeholder="Masukan email"
                        class="w-full h-12 px-4 rounded-xl bg-[#ECECEC] text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]">
                    
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">
                         {{ $message }}
                       </p>
                     @enderror
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
                <!-- Konfirmasi Password -->
                <div class="mb-8">

                    <label class="block text-[#4A9FD4] text-sm mb-2">
                        Konfirmasi Password *
                    </label>

                    <div class="relative">

                        <input
                            type="password"
                            id="confirm_password"
                            name="password_confirmation"
                            placeholder="Masukan Password"
                            class="w-full h-12 px-4 pr-12 rounded-xl bg-[#ECECEC] text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]">

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
                @error('password')
                   <p class="text-red-500 text-sm mt-1">
                     {{ $message }}
                   </p>
                @enderror
                    </div>

                </div>



                <!-- Tombol Register -->
                <button
                    type="submit"
                    class="w-full h-12 rounded-lg bg-[#C9A84C] hover:opacity-90 transition text-white font-medium">


                    Buat akun
                </button>
            </div>
        </form>

        <div class="text-center my-5">
            <span class="text-xs text-gray-400 tracking-wide">Atau buat akun dengan</span>
        </div>

        <a 
            href="#" 
            class="w-full border border-[#cca43b] hover:bg-white/5 text-white font-medium py-3 rounded-xl flex items-center justify-center space-x-2 transition text-sm active:scale-[0.99]"
        >
            <i class="fa-brands fa-google text-red-500"></i>
            <span>Google</span>
        </a>

        <div class="text-center mt-6 text-sm">
            <span class="text-gray-400">Sudah punya akun? </span>
            <a href="{{ route('login') }}" class="text-[#cca43b] hover:underline font-semibold ml-1">Masuk</a>
        </div>

    </div>

    <div class="h-4 md:hidden"></div>

    <script>
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.closest('div').querySelector('input');
                const icon = this.querySelector('i');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    // Mengubah ikon menjadi mata tercoret (hide)
                    icon.classList.remove('fa-regular', 'fa-eye');
                    icon.classList.add('fa-regular', 'fa-eye-slash');
                } else {
                    input.type = 'password';
                    // Mengembalikan ikon ke mata terbuka (show)
                    icon.classList.remove('fa-regular', 'fa-eye-slash');
                    icon.classList.add('fa-regular', 'fa-eye');
                }
            });
        });
    </script>
</body>
</html>