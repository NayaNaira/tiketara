<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Tiketara</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-[#020b18] min-h-screen text-white flex flex-col p-6 sm:p-10 relative">

    <header class="px-4 sm:px-8 py-6">
        <img
            src="{{ asset('images/logo.png') }}"
            alt="Tiketara"
            class="h-10">
    </header>

    <div class="w-full max-w-md mx-auto flex flex-col items-center my-auto">
        
        <div class="w-full flex items-center justify-center mb-8 relative">
            <a href="{{ url()->previous() }}" class="absolute left-0 flex items-center space-x-2 text-white hover:text-[#cca43b] transition">
                <i class="fa-solid fa-chevron-left text-sm"></i>
                <span class="text-xs font-bold tracking-widest uppercase">Profile</span>
            </a>
            <div class="h-6"></div>
        </div>

        <div class="flex flex-col items-center mb-6">
            <div class="w-28 h-28 rounded-full overflow-hidden mb-4 shadow-lg border-2 border-gray-800">
                <img 
                    src="https://ui-avatars.com/api/?name=Zara&background=cca43b&color=fff&size=128" 
                    alt="User Avatar" 
                    class="w-full h-full object-cover"
                >
            </div>
            <h2 class="text-xl font-bold tracking-tight">Zara</h2>
            <p class="text-gray-400 text-xs mt-0.5">zara@gmail.com</p>
        </div>

        <div class="w-full bg-[#0d1726]/60 border border-gray-800/60 rounded-xl p-4 mb-6 flex items-center justify-between shadow-sm">
            <div class="flex-1">
                <h3 class="text-white font-semibold text-sm">
                    Apakah kamu ingin membuat event?
                </h3>
                <p class="text-gray-400 text-xxs mt-0.5">
                    Daftarkan event mu sekarang!
                </p>
            </div>
            <button class="bg-[#cca43b] w-6 h-6 rounded-full flex items-center justify-center text-black text-xs transition hover:scale-105">
                <i class="fa-solid fa-arrow-up-right-from-square scale-75"></i>
            </button>
        </div>

        <div class="w-full space-y-1">
            <a href="#" class="w-full flex items-center justify-between py-3 px-1 hover:bg-white/5 rounded-lg transition group">
                <span class="text-sm font-medium text-gray-200">Edit Profile</span>
                <i class="fa-solid fa-chevron-right text-xxs text-gray-500 group-hover:text-white transition"></i>
            </a>

            <button 
                type="button" 
                onclick="openLogoutModal()" 
                class="w-full flex items-center justify-start py-3 px-1 text-red-600 hover:text-red-500 font-medium text-sm transition"
            >
                Keluar
            </button>
        </div>
    </div>


    <div 
        id="logoutModal" 
        class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-xs transition-opacity duration-200"
    >
        <div class="bg-[#021024] border border-[#1e3a5f] w-full max-w-sm rounded-xl p-6 shadow-2xl transform scale-95 transition-transform duration-200">
            
            <h3 class="text-base font-semibold text-white mb-12">
                Keluar dari akun ini?
            </h3>
            
            <div class="flex justify-end space-x-6 items-center">
                <button 
                    type="button" 
                    onclick="closeLogoutModal()" 
                    class="text-[#cca43b] hover:text-[#b08b30] font-medium text-sm transition focus:outline-none"
                >
                    Batal
                </button>
                
                <form action="#" method="POST" class="inline">
                    @csrf
                    <button 
                        type="submit" 
                        class="text-[#cca43b] hover:text-[#b08b30] font-medium text-sm transition focus:outline-none"
                    >
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>


    <script>
        const modal = document.getElementById('logoutModal');

        function openLogoutModal() {
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.querySelector('.transform').classList.remove('scale-95');
                modal.querySelector('.transform').classList.add('scale-100');
            }, 10);
        }

        function closeLogoutModal() {
            modal.querySelector('.transform').classList.remove('scale-100');
            modal.querySelector('.transform').classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 150);
        }

        // Tutup otomatis jika bagian luar kotak diklik
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeLogoutModal();
            }
        });
    </script>

</body>
</html>