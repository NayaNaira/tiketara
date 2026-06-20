<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Promoter - Tiketara</title>

    @vite(['resources/css/app.css'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-[#020D1A] min-h-screen">

    <header class="px-4 sm:px-8 py-6">
        <img
            src="{{ asset('images/logo.png') }}"
            alt="Tiketara"
            class="h-10">
    </header>

    <main class="flex justify-center px-4 pb-10">

        <div class="w-full max-w-md">

            <h1 class="text-4xl font-semibold text-[#C9A84C] mb-2">
                Ajukan Promoter
            </h1>

            <p class="text-[#4A9FD4] text-sm leading-6 mb-8">
                Lengkapi data profil Anda di bawah ini untuk mengajukan permohonan hak akses sebagai Promoter (Penyelenggara Event) di Tiketara.
            </p>

            <form action="{{ route('promoter.apply.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="flex flex-col items-center mb-8">
                    <div class="relative">
                        @if($user->avatar)
                            @if(str_starts_with($user->avatar, 'http'))
                                <img id="avatarPreview" src="{{ $user->avatar }}" alt="Avatar" class="w-32 h-32 rounded-2xl object-cover border-4 border-[#C9A84C] shadow-lg" referrerpolicy="no-referrer">
                            @else
                                <img id="avatarPreview" src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-32 h-32 rounded-2xl object-cover border-4 border-[#C9A84C] shadow-lg">
                            @endif
                        @else
                            <img id="avatarPreview" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=111827&color=C9A84C&size=128" alt="Avatar" class="w-32 h-32 rounded-2xl object-cover border-4 border-[#C9A84C] shadow-lg">
                        @endif

                        <label
                            for="avatar"
                            class="absolute bottom-[-10px] right-[-10px] bg-[#C9A84C] rounded-full p-2 cursor-pointer hover:scale-105 transition shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 018.542 5.25h6.916a2.31 2.31 0 011.715.925l.826 1.1h1.251A2.25 2.25 0 0121.5 9.525v8.25A2.25 2.25 0 0119.25 20.025H4.75A2.25 2.25 0 012.5 17.775v-8.25a2.25 2.25 0 012.25-2.25H6l.827-1.1z"/>
                            </svg>
                        </label>

                        <input
                            type="file"
                            id="avatar"
                            name="avatar"
                            class="hidden"
                            accept="image/*">
                    </div>

                    <p id="avatarStatus" class="text-[#4A9FD4] text-sm mt-5">
                        Unggah Foto / Logo Instansi Promoter
                    </p>
                    @error('avatar')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="block text-[#4A9FD4] text-sm mb-2">
                        Nama Promoter / Instansi
                    </label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        required
                        placeholder="Masukkan nama organisasi atau nama Anda"
                        class="w-full h-12 px-4 rounded-xl bg-[#ECECEC] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="block text-[#4A9FD4] text-sm mb-2">
                        Nomor Induk Kependudukan (NIK) Penanggung Jawab
                    </label>
                    <input
                        type="text"
                        maxlength="16"
                        name="nik"
                        value="{{ old('nik', $user->nik) }}"
                        required
                        placeholder="Masukkan 16 digit NIK pemilik akun"
                        class="w-full h-12 px-4 rounded-xl bg-[#ECECEC] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]">
                    @error('nik')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="block text-[#4A9FD4] text-sm mb-2">
                        Nomor HP / WhatsApp Aktif
                    </label>
                    <input
                        type="text"
                        name="phone_number"
                        value="{{ old('phone_number', $user->phone_number) }}"
                        required
                        placeholder="Contoh: 08xxxxxxxxxx"
                        class="w-full h-12 px-4 rounded-xl bg-[#ECECEC] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#C9A84C]">
                    @error('phone_number')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-8">
                    <label class="block text-[#4A9FD4] text-sm mb-2">
                        Alamat Lengkap Instansi / Rumah
                    </label>
                    <textarea
                        name="address"
                        rows="4"
                        required
                        placeholder="Masukkan alamat lengkap korespondensi promoter..."
                        class="w-full px-4 py-3 rounded-xl bg-[#ECECEC] text-gray-800 resize-none focus:outline-none focus:ring-2 focus:ring-[#C9A84C]">{{ old('address', $user->address) }}</textarea>
                    @error('address')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-3">
                    <button
                        type="submit"
                        class="w-full h-12 rounded-lg bg-[#C9A84C] text-white font-medium hover:opacity-90 transition cursor-pointer">
                        Kirim Formulir Pengajuan
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

    <script>
        document.getElementById('avatar').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('avatarPreview');
            const statusText = document.getElementById('avatarStatus');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);

                statusText.innerText = "✓ Gambar terpilih: " + file.name;
                statusText.classList.replace('text-[#4A9FD4]', 'text-green-400');
            }
        });
    </script>

</body>
</html>