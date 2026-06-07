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
        <img
            src="{{ asset('images/logo.png') }}"
            alt="Tiketara"
            class="h-10">
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
            <h2 class="text-[#C9A84C] text-2xl font-semibold mb-4">
                Check Your Email
            </h2>

            <!-- Description -->
            <div class="text-[#4A9FD4] text-sm leading-6 mb-6">

                <p>
                    Kami mengirim link verifikasi
                </p>

                <p class="font-medium">
                    zara@gmail.com
                </p>

                <p>
                    Silakan klik tautan untuk
                </p>

                <p>
                    menyelesaikan pendaftaran Anda.
                </p>

            </div>

            <!-- Button -->
            <button
                class="w-full bg-[#C9A84C] hover:opacity-90 transition text-white font-medium py-3 rounded-md">

                Kirim Ulang Verifikasi

            </button>

            <!-- Footer -->
            <p class="text-[#4A9FD4] text-xs mt-5 leading-5">
                Anda dapat meminta tautan baru
                dalam 60 detik.
            </p>

        </div>

    </div>

</body>
</html>