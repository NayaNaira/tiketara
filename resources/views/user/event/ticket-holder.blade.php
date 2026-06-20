<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pemegang Tiket - {{ $event->title }}</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-[#020b18] min-h-screen text-white flex flex-col p-4 sm:p-6 md:p-10 relative font-['DM_Sans',_sans-serif]">

    <div class="w-full border border-[#1e3a5f] rounded-2xl p-4 sm:p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-8">
        <div class="flex items-center space-x-4">
            <a href="{{ url()->previous() }}" class="flex items-center space-x-2 text-white hover:text-[#cca43b] transition text-xs font-semibold tracking-wider uppercase">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
        </div>
        
        <div class="flex-1 text-center">
            <h1 class="text-3xl text-white" style="font-family: 'Playfair Display', serif;">
                Data <span class="text-[#CCA43B]">Pemegang</span>
            </h1>

            <p class="text-[#4A9FD4] text-sm mt-2 tracking-wide">
                {{ $event->title }} · {{ \Carbon\Carbon::parse($event->event_date ?? $event->date)->translatedFormat('d F Y') }} · {{ $event->venue_name ?? $event->location }}
            </p>
        </div>
    </div>

    <main class="w-full max-w-xl mx-auto flex flex-col items-center my-auto space-y-8">
        
        <div class="flex items-center space-x-4 sm:space-x-8">
            <div class="flex items-center space-x-2">
                <div class="w-7 h-7 rounded-full bg-gray-800 border border-gray-700 text-gray-400 font-bold text-xs flex items-center justify-center">1</div>
                <span class="text-xxs text-gray-500 font-medium">Tiket</span>
            </div>
            <div class="h-[1px] w-6 sm:w-12 bg-gray-800"></div>
            
            <div class="flex items-center space-x-2">
                <div class="w-7 h-7 rounded-full bg-[#cca43b] text-black font-bold text-xs flex items-center justify-center shadow">2</div>
                <span class="text-xxs text-gray-300 font-medium">Data Diri</span>
            </div>
            <div class="h-[1px] w-6 sm:w-12 bg-gray-800"></div>
            
            <div class="flex items-center space-x-2">
                <div class="w-7 h-7 rounded-full border border-gray-700 text-gray-400 text-xs flex items-center justify-center">3</div>
                <span class="text-xxs text-gray-500 font-medium hidden sm:inline">Bayar</span>
            </div>
        </div>

        <!-- FIX: Mengubah rute ke checkout.store dan metode pengiriman ke POST -->
        <form action="{{ route('buyer.checkout.store', $event->id) }}" method="POST" class="w-full space-y-6 flex flex-col items-center">
            @csrf <!-- Token keamanan Laravel wajib ada untuk form POST -->
            
            <div class="w-full p-6 border border-[#1e3a5f] rounded-2xl bg-[#020b18]/50 space-y-5">
                <h2 class="text-center text-xxs font-bold tracking-widest text-[#cca43b] uppercase mb-2">Informasi Pemegang Tiket</h2>
                
                <div class="flex flex-col space-y-1.5">
                    <label class="text-[#41628d] text-xxs font-bold tracking-wider uppercase">Nama Lengkap</label>
                    <input type="text" name="full_name" value="{{ old('full_name', Auth::user()->name ?? '') }}" placeholder="Sesuai KTP / Identitas" required 
                        class="w-full bg-white text-gray-900 px-4 py-3 rounded-xl border border-transparent focus:outline-none focus:ring-2 focus:ring-[#cca43b] font-medium text-sm placeholder-gray-400 transition shadow-sm">
                    <span class="text-gray-500 text-xxs px-1">Nama ini akan tercetak di e-tiket</span>
                </div>

                <div class="flex flex-col space-y-1.5">
                    <label class="text-[#41628d] text-xxs font-bold tracking-wider uppercase">Email</label>
                    <input type="email" name="email" value="{{ old('email', Auth::user()->email ?? '') }}" placeholder="nama@email.com" required 
                        class="w-full bg-white text-gray-900 px-4 py-3 rounded-xl border border-transparent focus:outline-none focus:ring-2 focus:ring-[#cca43b] font-medium text-sm placeholder-gray-400 transition shadow-sm">
                </div>

                <div class="flex flex-col space-y-1.5">
                    <label class="text-[#41628d] text-xxs font-bold tracking-wider uppercase">No Telepon / WhatsApp</label>
                    <input type="text" name="phone_number" value="{{ old('phone_number', Auth::user()->phone_number ?? '') }}" placeholder="08xxxxxxxxxx" required 
                        class="w-full bg-white text-gray-900 px-4 py-3 rounded-xl border border-transparent focus:outline-none focus:ring-2 focus:ring-[#cca43b] font-medium text-sm placeholder-gray-400 transition shadow-sm">
                </div>

                <div class="flex flex-col space-y-1.5">
                    <label class="text-[#41628d] text-xxs font-bold tracking-wider uppercase">Nomor ID / NIK KTP</label>
                    <input type="text" name="nik" value="{{ old('nik', Auth::user()->nik ?? '') }}" placeholder="16 Digit NIK KTP" required 
                        class="w-full bg-white text-gray-900 px-4 py-3 rounded-xl border border-transparent focus:outline-none focus:ring-2 focus:ring-[#cca43b] font-medium text-sm placeholder-gray-400 transition shadow-sm">
                    <span class="text-gray-500 text-xxs px-1">Digunakan untuk validasi saat penukaran tiket fisik</span>
                </div>

                <div class="pt-2">
                    <label class="flex items-start space-x-3 border border-[#1e3a5f]/60 rounded-xl p-3 bg-[#020b18] cursor-pointer hover:bg-white/5 transition select-none">
                        <input type="checkbox" name="agreement" required class="mt-1 w-4 h-4 text-[#cca43b] bg-transparent border-gray-700 rounded focus:ring-[#cca43b] accent-[#cca43b]">
                        <span class="text-xxs text-gray-400 leading-normal">
                            Saya menyatakan data yang dimasukkan sudah benar dan menyetujui <span class="text-[#cca43b] font-semibold hover:underline">Syarat & Ketentuan</span> yang berlaku.
                        </span>
                    </label>
                </div>
            </div>

            <div class="w-full max-w-xs pt-4 mx-auto">
                <button type="submit" class="w-full bg-[#cca43b] hover:bg-[#b08b30] text-black font-bold text-xs py-3.5 rounded-lg flex items-center justify-center space-x-2 transition shadow-lg group uppercase tracking-wider active:scale-[0.99] cursor-pointer">
                    <span>Lanjut ke Ringkasan</span>
                    <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                </button>
            </div>

        </form>
    </main>

</body>
</html>