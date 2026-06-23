<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Your Email - Tiketara</title>

    @vite(['resources/css/app.css'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

    <main class="flex-1 flex items-center justify-center px-4">

    <!-- Content -->
    <div class="min-h-screen flex items-center justify-center px-4">

        <!-- Card -->
        <div
            class="w-full max-w-sm bg-[#041830] border border-[#4A9FD4] rounded-xl p-5 shadow-lg">

            <!-- Icon -->
            <div
                class="w-10 h-10 rounded-full bg-[#C9A84C] flex items-center justify-center mb-5">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 text-white"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 8l9 6 9-6m-18 0v8a2 2 0 002 2h14a2 2 0 002-2V8"/>

                </svg>

            </div>

            <!-- Title -->
            <h2 class="text-[#C9A84C] text-2xl font-semibold mb-4 text-center">
                Cek Email Anda
            </h2>

            @if(session('success'))
                <div class="mb-4 bg-green-500/10 border border-green-500/50 text-green-500 text-sm p-3 rounded-lg text-center">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Description -->
            <div class="text-[#4A9FD4] text-sm leading-6 mb-6 text-center">
                <p>Kami telah mengirimkan link verifikasi ke:</p>
                <p class="font-bold text-white my-1">
                    {{ session('email', 'Email Anda') }}
                </p>
                <p>Silakan klik tautan di dalamnya untuk mengaktifkan akun Anda.</p>
            </div>

            <!-- Button -->
            <form method="POST" action="{{ route('verification.send.public') }}">
                @csrf
                <input type="hidden" name="email" value="{{ session('email') }}">
                <button type="submit" class="w-full bg-[#C9A84C] hover:opacity-90 transition text-[#020D1A] font-bold py-3 rounded-lg cursor-pointer">
                    Kirim Ulang Email
                </button>
            </form>

            <!-- Footer -->
            <div class="mt-5 text-center">
                <a href="{{ route('login') }}" class="text-[#4A9FD4] hover:text-white text-xs underline">
                    Kembali ke halaman Login
                </a>
            </div>
        </div>

    </div>

</body>
</html>