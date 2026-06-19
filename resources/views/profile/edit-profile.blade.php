<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - Tiketara</title>

    @vite(['resources/css/app.css'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <style>
        body{
            font-family:'DM Sans',sans-serif;
        }
    </style>
</head>

<body class="bg-[#020D1A] min-h-screen">

    <!-- Header -->
    <header class="px-4 sm:px-8 py-6">
        <img
            src="{{ asset('images/logo.png') }}"
            alt="Tiketara"
            class="h-10">
    </header>

    <!-- Content -->
    <main class="flex justify-center px-4 pb-10">

        <div class="w-full max-w-md">

            <!-- Judul -->
            <h1 class="text-4xl font-semibold text-[#C9A84C] mb-2">
                Edit Profil
            </h1>

            <p class="text-[#4A9FD4] text-sm leading-6 mb-8">
                Perbarui informasi akun Anda agar tetap
                akurat dan mudah dihubungi.
            </p>

            <form action="#" method="POST" enctype="multipart/form-data">

                @csrf

                <!-- Avatar -->
                <div class="flex flex-col items-center mb-8">

                    <div class="relative">

                        <img
                            src="{{ asset('images/default-avatar.png') }}"
                            alt="Avatar"
                            class="w-32 h-32 rounded-full object-cover border-4 border-[#C9A84C] shadow-lg">

                        <label
                            for="avatar"
                            class="absolute bottom-0 right-0 bg-[#C9A84C] rounded-full p-2 cursor-pointer hover:scale-105 transition">

                            <!-- Icon Kamera -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="white"
                                 class="w-5 h-5">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M6.827 6.175A2.31 2.31 0 018.542 5.25h6.916a2.31 2.31 0 011.715.925l.826 1.1h1.251A2.25 2.25 0 0121.5 9.525v8.25A2.25 2.25 0 0119.25 20.025H4.75A2.25 2.25 0 012.5 17.775v-8.25a2.25 2.25 0 012.25-2.25H6l.827-1.1z"/>

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M15.75 13.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/>

                            </svg>

                        </label>

                        <input
                            type="file"
                            id="avatar"
                            name="avatar"
                            class="hidden"
                            accept="image/*">

                    </div>

                    <p class="text-[#4A9FD4] text-sm mt-4">
                        Klik ikon kamera untuk mengganti foto profil
                    </p>

                </div>

                <!-- Nama -->
                <div class="mb-5">

                    <label class="block text-[#4A9FD4] text-sm mb-2">
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap"
                        class="w-full h-12 px-4 rounded-xl bg-[#ECECEC] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]">

                </div>

                <!-- Nomor HP -->
                <div class="mb-5">

                    <label class="block text-[#4A9FD4] text-sm mb-2">
                        Nomor HP
                    </label>

                    <input
                        type="text"
                        name="phone"
                        placeholder="08xxxxxxxxxx"
                        class="w-full h-12 px-4 rounded-xl bg-[#ECECEC] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]">

                </div>

                <!-- NIK -->
                <div class="mb-5">

                    <label class="block text-[#4A9FD4] text-sm mb-2">
                        NIK
                    </label>

                    <input
                        type="text"
                        maxlength="16"
                        name="nik"
                        placeholder="Masukkan 16 digit NIK"
                        class="w-full h-12 px-4 rounded-xl bg-[#ECECEC] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]">

                </div>

                <!-- Alamat -->
                <div class="mb-8">

                    <label class="block text-[#4A9FD4] text-sm mb-2">
                        Alamat
                    </label>

                    <textarea
                        name="address"
                        rows="4"
                        placeholder="Masukkan alamat lengkap"
                        class="w-full px-4 py-3 rounded-xl bg-[#ECECEC] text-gray-800 resize-none focus:outline-none focus:ring-2 focus:ring-[#C9A84C]"></textarea>

                </div>

                <!-- Tombol -->
                <div class="space-y-3">

                    <button
                        type="submit"
                        class="w-full h-12 rounded-lg bg-[#C9A84C] text-white font-medium hover:opacity-90 transition">

                        Simpan Perubahan

                    </button>

                    <button
                        type="button"
                        onclick="history.back()"
                        class="w-full h-12 rounded-lg border border-[#C9A84C] text-[#C9A84C] hover:bg-[#C9A84C]/10 transition">

                        Batal

                    </button>

                </div>

            </form>

        </div>

    </main>

</body>
</html>