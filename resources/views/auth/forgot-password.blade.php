<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi - Tiketara</title>

    @vite(['resources/css/app.css'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#020D1A] font-[Poppins] min-h-screen flex flex-col">

    <!-- Header -->
    <header class="px-4 sm:px-8 py-6">
        <img
            src="{{ asset('images/logotiket.png') }}"
            alt="Tiketara"
            class="h-10">
    </header>

    <!-- Content -->
    <main class="flex-1 flex items-center justify-center px-4">

        <div class="w-full max-w-sm">

            <!-- Title -->
            <h1 class="text-[#C9A84C] text-4xl font-semibold text-center mb-4">
                Lupa Kata Sandi
            </h1>

            <!-- Description -->
            <p class="text-[#4A9FD4] text-center text-sm leading-6 mb-8">
                Mohon masukan username atau Email
                <br>
                untuk mengatur ulang password
            </p>

            <!-- Form -->
            <form action="#" method="POST">

                @csrf

                <!-- Email -->
                <div class="relative mb-6">

                    <span
                        class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">

                        👤

                    </span>

                    <input
                        type="email"
                        name="email"
                        placeholder="@gmail.com"
                        class="w-full h-12 pl-12 pr-4 rounded-xl bg-[#ECECEC] text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]">

                </div>

                <!-- Button -->
                <button
                    type="submit"
                    class="w-full h-12 rounded-xl bg-[#C9A84C] text-black font-semibold hover:opacity-90 transition">

                    Kirim

                </button>

            </form>

        </div>

    </main>

    <!-- Footer -->
    <footer class="pb-6 text-center">

        <p class="text-white text-xs">
            ©2026 TicketFlow Management Systems.
            All rights reserved.
        </p>

        <div class="flex justify-center gap-6 mt-4 text-xs">

            <a href="#" class="text-white hover:text-[#C9A84C]">
                Privacy Policy
            </a>

            <a href="#" class="text-white hover:text-[#C9A84C]">
                Terms of Service
            </a>

            <a href="#" class="text-white hover:text-[#C9A84C]">
                Support
            </a>

        </div>

    </footer>

</body>
</html>