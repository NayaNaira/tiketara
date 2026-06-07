<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masukan Kode Verifikasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-[#020D1A] min-h-screen flex flex-col">

    <header class="px-4 sm:px-8 py-6">
        <img
            src="{{ asset('images/logo.png') }}"
            alt="Tiketara"
            class="h-10">
    </header>

    <div class="flex-grow flex items-center justify-center w-full max-w-md mx-auto">
        <div class="w-full text-center px-4">
            
            <h1 class="text-2xl md:text-3xl font-medium text-[#C9A84C] tracking-wide mb-3">
                Masukan Kode Verifikasi
            </h1>
            
            <p class="text-sm md:text-base text-[#4A9FD4] mb-8 font-light max-w-sm mx-auto leading-relaxed">
                Kode Verifikasi telah dikirim melalui email ke <span class="text-[#C9A84C] font-semibold">zara@gmail.com</span>
            </p>

            <form id="otpForm" class="space-y-8">
                <div class="flex justify-center gap-3 md:gap-4">
                    <input type="text" maxlength="1" value="x" onfocus="if(this.value=='x') this.value='';" onblur="if(this.value=='') this.value='x';" class="otp-input w-12 h-14 md:w-14 md:h-16 text-center text-2xl font-bold bg-white text-gray-400 focus:text-[#020D1A] rounded-xl focus:outline-none focus:ring-4 focus:ring-[#C9A84C]/50 transition duration-200 shadow-lg" />
                    <input type="text" maxlength="1" value="x" onfocus="if(this.value=='x') this.value='';" onblur="if(this.value=='') this.value='x';" class="otp-input w-12 h-14 md:w-14 md:h-16 text-center text-2xl font-bold bg-white text-gray-400 focus:text-[#020D1A] rounded-xl focus:outline-none focus:ring-4 focus:ring-[#C9A84C]/50 transition duration-200 shadow-lg" />
                    <input type="text" maxlength="1" value="x" onfocus="if(this.value=='x') this.value='';" onblur="if(this.value=='') this.value='x';" class="otp-input w-12 h-14 md:w-14 md:h-16 text-center text-2xl font-bold bg-white text-gray-400 focus:text-[#020D1A] rounded-xl focus:outline-none focus:ring-4 focus:ring-[#C9A84C]/50 transition duration-200 shadow-lg" />
                    <input type="text" maxlength="1" value="x" onfocus="if(this.value=='x') this.value='';" onblur="if(this.value=='') this.value='x';" class="otp-input w-12 h-14 md:w-14 md:h-16 text-center text-2xl font-bold bg-white text-gray-400 focus:text-[#020D1A] rounded-xl focus:outline-none focus:ring-4 focus:ring-[#C9A84C]/50 transition duration-200 shadow-lg" />
                </div>

                <div>
                    <button type="submit" class="w-full max-w-[260px] md:max-w-[280px] bg-[#C9A84C] hover:bg-[#b59540] active:scale-95 text-[#020D1A] font-bold py-3 px-6 rounded-full transition-all duration-200 text-sm md:text-base tracking-wider shadow-md">
                        Kirim
                    </button>
                </div>
            </form>
            
        </div>
    </div>

    <div class="w-full text-center text-[11px] md:text-xs text-slate-400 font-light space-y-3 pt-6">
        <p class="opacity-75">&copy; 2026 TicketFlow Management Systems. All rights reserved.</p>
        <div class="flex justify-center space-x-5 opacity-90">
            <a href="#" class="hover:text-[#4A9FD4] transition duration-150">Privacy Policy</a>
            <a href="#" class="hover:text-[#4A9FD4] transition duration-150">Terms of Service</a>
            <a href="#" class="hover:text-[#4A9FD4] transition duration-150">Support</a>
        </div>
    </div>

    <script>
        const inputs = document.querySelectorAll('.otp-input');

        inputs.forEach((input, index) => {
            // pindah kotak otomatis ke kaman
            input.addEventListener('input', (e) => {
                if (e.target.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });

            // pindah kotak otomatis ke kiri
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });

        
    </script>
</body>
</html>