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
            src="{{ asset('images/logotiket.png') }}"
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
                @if($user->avatar)
                    @if(str_starts_with($user->avatar, 'http'))
                        <img src="{{ $user->avatar }}" class="w-full h-full object-cover" referrerpolicy="no-referrer">
                    @else
                        <img src="{{ asset('storage/'.$user->avatar) }}" class="w-full h-full object-cover">
                    @endif
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=cca43b&color=fff&size=128" class="w-full h-full object-cover">
                @endif
            </div>
            
            <h2 class="text-xl font-bold tracking-tight">{{ $user->name }}</h2>
            
            <div class="mt-1.5 mb-1">
                @if($user->role === 'super_admin')
                    <span class="bg-[#cca43b]/10 text-[#cca43b] border border-[#cca43b]/30 text-[10px] font-bold tracking-widest uppercase px-2.5 py-0.5 rounded-full shadow-sm">
                        Super Admin
                    </span>
                @elseif($user->role === 'promoter')
                    <span class="bg-blue-500/10 text-blue-400 border border-blue-500/30 text-[10px] font-bold tracking-widest uppercase px-2.5 py-0.5 rounded-full shadow-sm">
                        Promoter
                    </span>
                @else
                    <span class="bg-gray-800 text-gray-400 text-[10px] font-bold tracking-widest uppercase px-2.5 py-0.5 rounded-full">
                        Buyer
                    </span>
                @endif
            </div>

            <p class="text-gray-400 text-xs mt-0.5">{{ $user->email }}</p>
        </div>

        @if($user->role !== 'super_admin' && $user->role !== 'promoter')
            @if($user->promoter_status == 'none' || $user->promoter_status == 'rejected')
                <div class="w-full bg-[#0d1726]/60 border border-gray-800/60 rounded-xl p-4 mb-6 flex items-center justify-between shadow-sm">
                    <div class="flex-1">
                        <h3 class="text-white font-semibold text-sm">
                            Apakah kamu ingin membuat event?
                        </h3>
                        <p class="text-gray-400 text-xxs mt-0.5">
                            {{ $user->promoter_status == 'rejected' ? 'Pengajuan ditolak. Silakan ajukan ulang berkasmu!' : 'Daftarkan event mu sekarang!' }}
                        </p>
                    </div>
                    <a href="{{ route('promoter.apply') }}" class="inline-block">
                        <button class="bg-[#cca43b] w-6 h-6 rounded-full flex items-center justify-center text-black text-xs transition hover:scale-105 cursor-pointer">
                            <i class="fa-solid {{ $user->promoter_status == 'rejected' ? 'fa-rotate-right' : 'fa-arrow-up-right-from-square' }} scale-75"></i>
                        </button>
                    </a>    
                </div>
            @elseif($user->promoter_status == 'pending')
                <div class="w-full bg-[#0d1726]/40 border border-yellow-600/20 rounded-xl p-4 mb-6 flex items-center justify-between shadow-sm">
                    <div class="flex-1">
                        <h3 class="text-yellow-500 font-semibold text-sm">
                            Pengajuan Promoter Diproses
                        </h3>
                        <p class="text-gray-400 text-xxs mt-0.5">
                            Berkas identitasmu sedang ditinjau oleh tim Super Admin.
                        </p>
                    </div>
                    <div class="text-yellow-500 text-sm animate-pulse px-1">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                </div>
            @endif
        @endif

        <div class="w-full space-y-1">
            <a href="{{ route('profile.edit') }}" class="w-full flex items-center justify-between py-3 px-1 hover:bg-white/5 rounded-lg transition group">
                <span class="text-sm font-medium text-gray-200">Edit Profile</span>
                <i class="fa-solid fa-chevron-right text-xxs text-gray-500 group-hover:text-white transition"></i>
            </a>

            <button 
                type="button" 
                onclick="openLogoutModal()" 
                class="w-full flex items-center justify-start py-3 px-1 text-red-600 hover:text-red-500 font-medium text-sm transition cursor-pointer"
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
                    class="text-[#cca43b] hover:text-[#b08b30] font-medium text-sm transition focus:outline-none cursor-pointer"
                >
                    Batal
                </button>
                
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button 
                        type="submit" 
                        class="text-[#cca43b] hover:text-[#b08b30] font-medium text-sm transition focus:outline-none cursor-pointer"
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

        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeLogoutModal();
            }
        });
    </script>

</body>
</html>