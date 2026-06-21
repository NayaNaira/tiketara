<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebijakan Privasi - Tiketara</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logotiket.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,600,700|dm-sans:400,500,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css'])
</head>
<body class="antialiased min-h-screen flex flex-col font-['DM_Sans',_sans-serif] bg-[#020D1A] text-white">

    <!-- Header -->
    <header class="w-full flex items-center justify-between px-4 md:px-8 py-3 md:py-4 border-b border-[#202020]">
        <div class="flex items-center gap-2">
            <a href="{{ url('/') }}" class="flex items-center gap-2.5 group">
                <img src="{{ asset('images/logotiket.png') }}" alt="Tiketara Logo" class="h-8 md:h-10 w-auto object-contain hover:opacity-90 transition">
                <span class="text-lg md:text-xl font-bold tracking-wider text-white group-hover:text-[#C9A84C] transition">Tiketara</span>
            </a>
        </div>
        <div>
            <a href="{{ url('/') }}" class="text-xs md:text-sm font-medium border border-[#C9A84C] text-[#C9A84C] px-4 py-1.5 rounded-full hover:bg-[#C9A84C] hover:text-[#020D1A] transition flex items-center gap-2">
                <i class="fa-solid fa-house"></i> Kembali ke Beranda
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 px-4 md:px-8 py-10 md:py-16 max-w-4xl mx-auto w-full">
        <div class="bg-[#031124] border border-[#202020] rounded-2xl p-6 md:p-10 shadow-2xl space-y-8">
            <div class="text-center md:text-left border-b border-[#202020] pb-6">
                <span class="text-[#C9A84C] text-xs font-bold uppercase tracking-widest">INFORMASI HUKUM</span>
                <h1 class="text-3xl md:text-4xl font-['Playfair_Display',_serif] font-bold text-white mt-2">Kebijakan Privasi</h1>
                <p class="text-gray-400 text-xs mt-2">Terakhir diperbarui: 21 Juni 2026</p>
            </div>

            <!-- Section 1 -->
            <div class="space-y-3">
                <h2 class="text-lg font-bold text-[#C9A84C] tracking-wide uppercase flex items-center gap-2">
                    <span class="text-xs bg-[#C9A84C]/10 text-[#C9A84C] w-6 h-6 rounded-full flex items-center justify-center font-bold">1</span>
                    Informasi Yang Kami Kumpulkan
                </h2>
                <p class="text-gray-300 text-sm leading-relaxed font-light">
                    Kami mengumpulkan informasi pribadi yang Anda berikan secara langsung saat melakukan pendaftaran akun, pembelian tiket, atau pengajuan sebagai Promoter. Informasi ini meliputi:
                </p>
                <ul class="list-disc list-inside text-gray-300 text-sm pl-4 space-y-1 font-light">
                    <li>Data Identitas: Nama lengkap, alamat email, nomor telepon, dan sandi akun.</li>
                    <li>Data Transaksi: Detail tiket yang dibeli, riwayat pemesanan, dan metode pembayaran.</li>
                    <li>Data Verifikasi: Dokumen identitas tambahan jika Anda mendaftar sebagai penyelenggara/promoter event.</li>
                </ul>
            </div>

            <!-- Section 2 -->
            <div class="space-y-3">
                <h2 class="text-lg font-bold text-[#C9A84C] tracking-wide uppercase flex items-center gap-2">
                    <span class="text-xs bg-[#C9A84C]/10 text-[#C9A84C] w-6 h-6 rounded-full flex items-center justify-center font-bold">2</span>
                    Bagaimana Kami Menggunakan Informasi Anda
                </h2>
                <p class="text-gray-300 text-sm leading-relaxed font-light">
                    Informasi yang kami kumpulkan digunakan untuk mendukung pengalaman bertransaksi Anda di platform Tiketara, termasuk untuk:
                </p>
                <ul class="list-disc list-inside text-gray-300 text-sm pl-4 space-y-1 font-light">
                    <li>Memproses pemesanan tiket dan memfasilitasi gerbang pembayaran digital.</li>
                    <li>Mengirimkan E-Ticket resmi ke alamat email terdaftar setelah pembayaran terverifikasi.</li>
                    <li>Menghubungi Anda terkait pembaruan status event, perubahan jadwal, atau pembatalan dari pihak Promoter.</li>
                    <li>Melakukan verifikasi akun Promoter dan memproses pengajuan event baru.</li>
                </ul>
            </div>

            <!-- Section 3 -->
            <div class="space-y-3">
                <h2 class="text-lg font-bold text-[#C9A84C] tracking-wide uppercase flex items-center gap-2">
                    <span class="text-xs bg-[#C9A84C]/10 text-[#C9A84C] w-6 h-6 rounded-full flex items-center justify-center font-bold">3</span>
                    Keamanan Transaksi & Data Pembayaran
                </h2>
                <p class="text-gray-300 text-sm leading-relaxed font-light">
                    Seluruh transaksi finansial di Tiketara diproses dengan aman menggunakan integrasi pembayaran resmi melalui <strong>Midtrans</strong> (payment gateway berlisensi). Kami <strong>tidak menyimpan</strong> detail kartu kredit, nomor rekening bank, atau kredensial pembayaran sensitif lainnya di server kami. Keamanan data transaksi sepenuhnya dilindungi dengan enkripsi SSL standar industri demi mencegah penyalahgunaan data.
                </p>
            </div>

            <!-- Section 4 -->
            <div class="space-y-3">
                <h2 class="text-lg font-bold text-[#C9A84C] tracking-wide uppercase flex items-center gap-2">
                    <span class="text-xs bg-[#C9A84C]/10 text-[#C9A84C] w-6 h-6 rounded-full flex items-center justify-center font-bold">4</span>
                    Berbagi Informasi dengan Pihak Ketiga
                </h2>
                <p class="text-gray-300 text-sm leading-relaxed font-light">
                    Kami menghargai privasi Anda dan tidak akan menjual data pribadi Anda. Kami hanya membagikan data kepada pihak ketiga dalam lingkup berikut:
                </p>
                <ul class="list-disc list-inside text-gray-300 text-sm pl-4 space-y-1 font-light">
                    <li><strong>Penyelenggara Event (Promoter)</strong>: Data nama dan email pembeli tiket dibagikan kepada Promoter event terkait untuk kebutuhan check-in dan validasi masuk di lokasi event.</li>
                    <li><strong>Payment Gateway (Midtrans)</strong>: Untuk memproses transaksi pembayaran tiket Anda.</li>
                    <li><strong>Kepatuhan Hukum</strong>: Jika diwajibkan oleh hukum, regulator, atau perintah pengadilan resmi di Indonesia.</li>
                </ul>
            </div>

            <!-- Section 5 -->
            <div class="space-y-3">
                <h2 class="text-lg font-bold text-[#C9A84C] tracking-wide uppercase flex items-center gap-2">
                    <span class="text-xs bg-[#C9A84C]/10 text-[#C9A84C] w-6 h-6 rounded-full flex items-center justify-center font-bold">5</span>
                    Hak Pengguna
                </h2>
                <p class="text-gray-300 text-sm leading-relaxed font-light">
                    Sebagai pengguna, Anda memiliki hak penuh untuk mengakses, memperbarui, atau meminta penghapusan informasi pribadi Anda dari sistem kami dengan menghubungi tim support kami melalui saluran yang tersedia.
                </p>
            </div>

            <!-- Section 6 -->
            <div class="space-y-3">
                <h2 class="text-lg font-bold text-[#C9A84C] tracking-wide uppercase flex items-center gap-2">
                    <span class="text-xs bg-[#C9A84C]/10 text-[#C9A84C] w-6 h-6 rounded-full flex items-center justify-center font-bold">6</span>
                    Hubungi Kami
                </h2>
                <p class="text-gray-300 text-sm leading-relaxed font-light">
                    Apabila Anda memiliki pertanyaan, kendala, atau keluhan terkait Kebijakan Privasi ini, silakan hubungi customer service kami:
                </p>
                <div class="bg-[#020D1A] border border-[#202020] rounded-xl p-4 text-xs space-y-1 text-gray-300">
                    <p class="font-semibold text-white">Tiketara Support Center</p>
                    <p>Alamat: Gedung Creative Hub Jakarta</p>
                    <p>Email: <a href="mailto:support@tiketara.com" class="text-[#C9A84C] hover:underline">support@tiketara.com</a></p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="w-full bg-[#031124] border-t border-[#202020]">
        <div class="max-w-[1500px] mx-auto px-4 md:px-8 py-6 text-center text-xs text-[#DADADA]">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <p>© 2026 Tiketara. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="{{ route('privacy.policy') }}" class="hover:text-[#C9A84C] transition">Privacy Policy</a>
                    <a href="{{ route('terms.service') }}" class="hover:text-[#C9A84C] transition">Terms of Service</a>
                    <a href="#" class="hover:text-[#C9A84C] transition">Support</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
