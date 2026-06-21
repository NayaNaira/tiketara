<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - Tiketara</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logotiket.png') }}">

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
        <a href="{{ url('/') }}" class="inline-block hover:opacity-90 transition">
            <img
                src="{{ asset('images/logotiket.png') }}"
                alt="Tiketara"
                class="h-10">
        </a>
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

            <!-- Notifikasi Sukses / Error Validation -->
            @if(session('success'))
                <div class="bg-green-500/10 border border-green-500/30 text-green-400 text-xs rounded-xl p-3 mb-5 text-center">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Avatar -->
                <div class="flex flex-col items-center mb-8">

                    <div class="relative">
                        <!-- ID 'avatarPreview' ditambahkan di sini untuk dimanipulasi oleh JS -->
                        @if($user->avatar)
                            @if(str_starts_with($user->avatar, 'http'))
                                <img id="avatarPreview" src="{{ $user->avatar }}" alt="Avatar" class="w-32 h-32 rounded-full object-cover border-4 border-[#C9A84C] shadow-lg" referrerpolicy="no-referrer" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=C9A84C&color=fff&size=128';">
                            @else
                                <img id="avatarPreview" src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-32 h-32 rounded-full object-cover border-4 border-[#C9A84C] shadow-lg" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=C9A84C&color=fff&size=128';">
                            @endif
                        @else
                            <img id="avatarPreview" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=C9A84C&color=fff&size=128" alt="Avatar" class="w-32 h-32 rounded-full object-cover border-4 border-[#C9A84C] shadow-lg">
                        @endif

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

                    <p id="avatarStatus" class="text-[#4A9FD4] text-sm mt-4">
                        Klik ikon kamera untuk mengganti foto profil
                    </p>
                    @error('avatar')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                </div>

                <!-- Nama -->
                <div class="mb-5">
                    <label class="block text-[#4A9FD4] text-sm mb-2">
                        Nama Lengkap
                    </label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        required
                        placeholder="Masukkan nama lengkap"
                        class="w-full h-12 px-4 rounded-xl bg-[#ECECEC] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nomor HP -->
                <div class="mb-5">
                    <label class="block text-[#4A9FD4] text-sm mb-2">
                        Nomor HP
                    </label>
                    <input
                        type="text"
                        name="phone_number"
                        value="{{ old('phone_number', $user->phone_number) }}"
                        placeholder="08xxxxxxxxxx"
                        class="w-full h-12 px-4 rounded-xl bg-[#ECECEC] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]">
                    @error('phone_number')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
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
                        value="{{ old('nik', $user->nik) }}"
                        placeholder="Masukkan 16 digit NIK"
                        class="w-full h-12 px-4 rounded-xl bg-[#ECECEC] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]">
                    @error('nik')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
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
                        class="w-full px-4 py-3 rounded-xl bg-[#ECECEC] text-gray-800 resize-none focus:outline-none focus:ring-2 focus:ring-[#C9A84C]">{{ old('address', $user->address) }}</textarea>
                    @error('address')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol -->
                <div class="space-y-3">
                    <button
                        type="submit"
                        class="w-full h-12 rounded-lg bg-[#C9A84C] text-white font-medium hover:opacity-90 transition cursor-pointer">
                        Simpan Perubahan
                    </button>

                    <button
                        type="button"
                        onclick="history.back()"
                        class="w-full h-12 rounded-lg border border-[#C9A84C] text-[#C9A84C] hover:bg-[#C9A84C]/10 transition cursor-pointer">
                        Batal
                    </button>
                </div>

            </form>

        </div>

    </main>

    <!-- LOGIKA LIVE PREVIEW IMAGE -->
    <script>
        document.getElementById('avatar').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('avatarPreview');
            const statusText = document.getElementById('avatarStatus');

            if (file) {
                // Membaca file gambar yang dipilih
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    // Mengganti isi src gambar profil lama dengan file baru
                    preview.src = e.target.result;
                };
                
                reader.readAsDataURL(file);

                // Ubah teks panduan menjadi nama file baru yang dipilih agar user makin yakin
                statusText.innerText = "✓ Foto berhasil dipilih: " + file.name;
                statusText.classList.replace('text-[#4A9FD4]', 'text-green-400');
            }
        });
    </script>

</body>
</html>