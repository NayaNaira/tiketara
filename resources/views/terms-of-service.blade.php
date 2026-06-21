<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syarat & Ketentuan Layanan - Tiketara</title>
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
                <span class="text-[#C9A84C] text-xs font-bold uppercase tracking-widest">PERJANJIAN LAYANAN</span>
                <h1 class="text-3xl md:text-4xl font-['Playfair_Display',_serif] font-bold text-white mt-2">Syarat & Ketentuan Layanan</h1>
                <p class="text-gray-400 text-xs mt-2">Terakhir diperbarui: 21 Juni 2026</p>
            </div>

            <!-- Section 1 -->
            <div class="space-y-3">
                <h2 class="text-lg font-bold text-[#C9A84C] tracking-wide uppercase flex items-center gap-2">
                    <span class="text-xs bg-[#C9A84C]/10 text-[#C9A84C] w-6 h-6 rounded-full flex items-center justify-center font-bold">1</span>
                    Penerimaan Ketentuan
                </h2>
                <p class="text-gray-300 text-sm leading-relaxed font-light">
                    Dengan mengakses, menggunakan, atau mendaftar di platform Tiketara, Anda setuju untuk terikat secara hukum oleh Syarat dan Ketentuan Layanan ini. Jika Anda tidak menyetujui salah satu dari ketentuan ini, Anda disarankan untuk tidak menggunakan platform ini.
                </p>
            </div>

            <!-- Section 2 -->
            <div class="space-y-3">
                <h2 class="text-lg font-bold text-[#C9A84C] tracking-wide uppercase flex items-center gap-2">
                    <span class="text-xs bg-[#C9A84C]/10 text-[#C9A84C] w-6 h-6 rounded-full flex items-center justify-center font-bold">2</span>
                    Registrasi Akun & Keamanan
                </h2>
                <p class="text-gray-300 text-sm leading-relaxed font-light">
                    Untuk melakukan transaksi pembelian tiket atau mengelola event sebagai Promoter, Anda wajib memiliki akun yang sah. Anda bertanggung jawab penuh atas:
                </p>
                <ul class="list-disc list-inside text-gray-300 text-sm pl-4 space-y-1 font-light">
                    <li>Kebenaran data pribadi yang dimasukkan selama registrasi.</li>
                    <li>Menjaga kerahasiaan kata sandi akun Anda.</li>
                    <li>Seluruh aktivitas yang terjadi di bawah nama akun Anda.</li>
                </ul>
            </div>

            <!-- Section 3 -->
            <div class="space-y-3">
                <h2 class="text-lg font-bold text-[#C9A84C] tracking-wide uppercase flex items-center gap-2">
                    <span class="text-xs bg-[#C9A84C]/10 text-[#C9A84C] w-6 h-6 rounded-full flex items-center justify-center font-bold">3</span>
                    Pembelian Tiket & Kebijakan Pembatalan
                </h2>
                <p class="text-gray-300 text-sm leading-relaxed font-light">
                    Transaksi pemesanan tiket bersifat mengikat setelah transaksi diverifikasi oleh sistem pembayaran gateway kami (Midtrans). Ketentuan transaksi meliputi:
                </p>
                <ul class="list-disc list-inside text-gray-300 text-sm pl-4 space-y-1 font-light">
                    <li><strong>Final Sale</strong>: Tiket yang sudah sukses dibeli bersifat final dan <strong>tidak dapat dibatalkan, di-refund, atau diuangkan kembali</strong> kecuali event tersebut resmi dibatalkan oleh pihak Promoter.</li>
                    <li><strong>E-Ticket</strong>: Setelah pembayaran berhasil, E-Ticket resmi akan otomatis dikirimkan ke email terdaftar. Pembeli wajib menunjukkan E-Ticket saat memasuki area event.</li>
                    <li><strong>Maksimal Pemesanan</strong>: Pembelian tiket dibatasi dengan jumlah maksimal per transaksi sesuai kebijakan masing-masing event.</li>
                </ul>
            </div>

            <!-- Section 4 -->
            <div class="space-y-3">
                <h2 class="text-lg font-bold text-[#C9A84C] tracking-wide uppercase flex items-center gap-2">
                    <span class="text-xs bg-[#C9A84C]/10 text-[#C9A84C] w-6 h-6 rounded-full flex items-center justify-center font-bold">4</span>
                    Ketentuan Khusus Penyelenggara (Promoter)
                </h2>
                <p class="text-gray-300 text-sm leading-relaxed font-light">
                    Promoter wajib mematuhi ketentuan pendaftaran event berikut:
                </p>
                <ul class="list-disc list-inside text-gray-300 text-sm pl-4 space-y-1 font-light">
                    <li>Semua event baru yang diajukan akan melalui proses verifikasi dan moderasi oleh tim Super Admin Tiketara sebelum ditayangkan secara publik.</li>
                    <li>Promoter bertanggung jawab penuh atas pelaksanaan event, kepatuhan jadwal, dan penanganan keluhan pengunjung di lokasi.</li>
                    <li>Apabila event dibatalkan, Promoter berkewajiban penuh menyelesaikan pengembalian dana tiket (*refund*) kepada pembeli melalui mekanisme yang disepakati.</li>
                </ul>
            </div>

            <!-- Section 5 -->
            <div class="space-y-3">
                <h2 class="text-lg font-bold text-[#C9A84C] tracking-wide uppercase flex items-center gap-2">
                    <span class="text-xs bg-[#C9A84C]/10 text-[#C9A84C] w-6 h-6 rounded-full flex items-center justify-center font-bold">5</span>
                    Batasan Tanggung Jawab
                </h2>
                <p class="text-gray-300 text-sm leading-relaxed font-light">
                    Tiketara adalah platform perantara penjualan tiket dan <strong>tidak bertanggung jawab</strong> atas kerugian, kerusakan, cedera fisik, atau pembatalan sepihak yang timbul selama pelaksanaan event di lokasi. Tanggung jawab hukum atas kualitas dan keamanan event sepenuhnya berada pada pihak Penyelenggara/Promoter event tersebut.
                </p>
            </div>

            <!-- Section 6 -->
            <div class="space-y-3">
                <h2 class="text-lg font-bold text-[#C9A84C] tracking-wide uppercase flex items-center gap-2">
                    <span class="text-xs bg-[#C9A84C]/10 text-[#C9A84C] w-6 h-6 rounded-full flex items-center justify-center font-bold">6</span>
                    Perubahan Syarat & Ketentuan
                </h2>
                <p class="text-gray-300 text-sm leading-relaxed font-light">
                    Kami berhak mengubah atau memperbarui Syarat & Ketentuan Layanan ini sewaktu-waktu tanpa pemberitahuan sebelumnya. Perubahan akan berlaku segera setelah ditayangkan di halaman ini. Anda dianjurkan untuk memeriksa halaman ini secara berkala.
                </p>
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
