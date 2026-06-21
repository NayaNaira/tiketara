<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Penjualan Tiket - Tiketara</title>
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
                <span class="text-[#C9A84C] text-xs font-bold uppercase tracking-widest">PANDUAN PROMOTER</span>
                <h1 class="text-3xl md:text-4xl font-['Playfair_Display',_serif] font-bold text-white mt-2">Panduan Penjualan Tiket</h1>
                <p class="text-gray-400 text-sm mt-2 leading-relaxed">
                    Pelajari langkah-langkah mudah membuat event, menerbitkan tiket, dan memantau penghasilan penjualan tiket Anda di Tiketara.
                </p>
            </div>

            <!-- Step 1 -->
            <div class="flex gap-4 md:gap-6 items-start">
                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-[#C9A84C]/10 border border-[#C9A84C]/30 flex items-center justify-center text-[#C9A84C] font-bold text-sm md:text-base">
                    1
                </div>
                <div class="space-y-2">
                    <h2 class="text-lg font-bold text-white tracking-wide uppercase">Mendaftar sebagai Promoter</h2>
                    <p class="text-gray-300 text-sm leading-relaxed font-light">
                        Untuk mulai menjual tiket, Anda perlu mengubah akun pembeli biasa Anda menjadi akun **Promoter**.
                    </p>
                    <ul class="list-disc list-inside text-gray-300 text-xs pl-4 space-y-1 font-light">
                        <li>Buka menu <strong>Profile</strong> akun Anda di pojok kanan atas.</li>
                        <li>Pilih tombol <strong>Daftar Jadi Promoter</strong>.</li>
                        <li>Lengkapi data instansi/organisasi Anda dan tunggu verifikasi persetujuan oleh Super Admin.</li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="flex gap-4 md:gap-6 items-start">
                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-[#C9A84C]/10 border border-[#C9A84C]/30 flex items-center justify-center text-[#C9A84C] font-bold text-sm md:text-base">
                    2
                </div>
                <div class="space-y-2">
                    <h2 class="text-lg font-bold text-white tracking-wide uppercase">Membuat Draft Event Baru</h2>
                    <p class="text-gray-300 text-sm leading-relaxed font-light">
                        Setelah status Promoter aktif, akses **Dashboard Penyelenggara** Anda untuk mendaftarkan event baru.
                    </p>
                    <ul class="list-disc list-inside text-gray-300 text-xs pl-4 space-y-1 font-light">
                        <li>Pilih menu <strong>Event</strong> lalu klik <strong>Buat Event</strong>.</li>
                        <li>Isi informasi detail berupa Judul Event, Deskripsi, Kategori, Tempat (Venue), Tanggal & Jam pelaksanaan, serta Syarat & Ketentuan.</li>
                        <li>Unggah poster utama event beresolusi tinggi beserta beberapa foto pendukung di galeri event.</li>
                    </ul>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="flex gap-4 md:gap-6 items-start">
                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-[#C9A84C]/10 border border-[#C9A84C]/30 flex items-center justify-center text-[#C9A84C] font-bold text-sm md:text-base">
                    3
                </div>
                <div class="space-y-2">
                    <h2 class="text-lg font-bold text-white tracking-wide uppercase">Mengatur Kategori & Harga Tiket</h2>
                    <p class="text-gray-300 text-sm leading-relaxed font-light">
                        Anda dapat membuat satu atau lebih kategori tiket untuk menyesuaikan dengan target pengunjung Anda.
                    </p>
                    <ul class="list-disc list-inside text-gray-300 text-xs pl-4 space-y-1 font-light">
                        <li>Tentukan nama kategori tiket (contoh: <em>VIP</em>, <em>Regular Pass</em>, atau <em>Presale 1</em>).</li>
                        <li>Atur harga tiket per kategori (dalam mata uang Rupiah).</li>
                        <li>Tentukan kuota batas penjualan untuk masing-masing kategori tiket tersebut.</li>
                    </ul>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="flex gap-4 md:gap-6 items-start">
                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-[#C9A84C]/10 border border-[#C9A84C]/30 flex items-center justify-center text-[#C9A84C] font-bold text-sm md:text-base">
                    4
                </div>
                <div class="space-y-2">
                    <h2 class="text-lg font-bold text-white tracking-wide uppercase">Proses Peninjauan (Moderasi)</h2>
                    <p class="text-gray-300 text-sm leading-relaxed font-light">
                        Untuk menjaga keamanan pembeli dari penipuan, setiap event baru wajib melewati proses persetujuan.
                    </p>
                    <ul class="list-disc list-inside text-gray-300 text-xs pl-4 space-y-1 font-light">
                        <li>Super Admin akan meninjau detail kelayakan, validitas poster, dan syarat ketentuan event Anda.</li>
                        <li>Status event akan berubah menjadi <strong>Approved</strong> jika disetujui (langsung tampil di homepage) atau <strong>Rejected</strong> jika ditolak (disertai alasan penolakan agar Anda dapat memperbaikinya).</li>
                    </ul>
                </div>
            </div>

            <!-- Step 5 -->
            <div class="flex gap-4 md:gap-6 items-start">
                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-[#C9A84C]/10 border border-[#C9A84C]/30 flex items-center justify-center text-[#C9A84C] font-bold text-sm md:text-base">
                    5
                </div>
                <div class="space-y-2">
                    <h2 class="text-lg font-bold text-white tracking-wide uppercase">Memantau Penjualan & Pencairan Dana</h2>
                    <p class="text-gray-300 text-sm leading-relaxed font-light">
                        Tiketara menyediakan laporan analitik real-time agar Anda dapat mengoptimalkan kampanye event Anda.
                    </p>
                    <ul class="list-disc list-inside text-gray-300 text-xs pl-4 space-y-1 font-light">
                        <li>Pantau grafik penjualan tiket dan akumulasi pemasukan langsung di ringkasan Dashboard Promoter Anda.</li>
                        <li>Unduh laporan penjualan berformat Excel untuk keperluan rekonsiliasi data.</li>
                        <li>Setelah event selesai berjalan secara sukses, Anda dapat mengajukan permohonan penarikan/pencairan dana hasil penjualan tiket kepada pihak Tiketara.</li>
                    </ul>
                </div>
            </div>

            <!-- Help Section -->
            <div class="border-t border-[#202020] pt-6 space-y-3">
                <h3 class="text-[#C9A84C] text-sm font-bold tracking-wider uppercase">Butuh Bantuan Lebih Lanjut?</h3>
                <p class="text-gray-300 text-sm leading-relaxed font-light">
                    Tim Partnership kami siap membimbing Anda dalam mensukseskan kampanye penjualan tiket konser, festival, seminar, atau kompetisi Anda.
                </p>
                <div class="bg-[#020D1A] border border-[#202020] rounded-xl p-4 text-xs space-y-1 text-gray-300 max-w-md">
                    <p class="font-semibold text-white">Tiketara Creator Support</p>
                    <p>Email: <a href="mailto:creator@tiketara.com" class="text-[#C9A84C] hover:underline">creator@tiketara.com</a></p>
                    <p>WhatsApp: +62 812-3456-7890</p>
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
