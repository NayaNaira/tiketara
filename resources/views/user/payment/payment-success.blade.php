<!DOCTYPE html>
<html lang="id">
<<head>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>


<body class="bg-[#020D1A] min-h-screen flex flex-col" style="font-family: 'DM Sans', sans-serif;">
    <!-- Header -->
    <header class="px-4 sm:px-8 py-6">
        <a href="{{ url('/') }}" class="inline-block hover:opacity-90 transition">
            <img
                src="{{ asset('images/logotiket.png') }}"
                alt="Tiketara"
                class="h-10">
        </a>
    </header>

    <!-- Content -->
    <main class="flex-1 flex items-center justify-center px-4">

        <div class="text-center">

            <!-- Icon Success -->
            <div class="flex justify-center mb-6">

                <div class="relative w-20 h-20">

                    <svg
                        class="w-20 h-20 text-[#C9A84C]"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 12.75l2.25 2.25L15 9.75"/>

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21 12a9 9 0 11-4.5-7.794"/>
                    </svg>

                </div>

            </div>

            <!-- Title -->
            <h1
                class="text-white text-3xl md:text-4xl font-bold mb-2"
                style="font-family: 'Playfair Display', serif;">
                Pembayaran Berhasil!
            </h1>

            <p class="text-sm md:text-base mb-8">

    <a href="#" class="hover:underline">

        <span class="text-[#4A9FD4]">
            Download
        </span>

        <span class="text-[#4A9FD4] font-medium">
            E-Ticket
        </span>

        <span class="text-[#C9A84C]">
            Disini
        </span>

    </a>

</p>

            <!-- Button -->
            <a
                href="#"
                class="inline-flex items-center gap-2 border border-[#C9A84C] text-[#C9A84C] px-8 py-3 rounded-md text-sm font-medium hover:bg-[#C9A84C] hover:text-black transition">

                ← KEMBALI KE DAFTAR

            </a>

        </div>

    </main>

</body>
</html>