@extends('layouts.admin')
@section('title', 'Detail Transaksi')

@section('content')
<header class="p-8 pb-4">
    <h1 class="text-2xl font-bold text-[#C9A84C] mb-1">Detail Transaksi - #07483648</h1>
    <p class="text-sm text-[#4A9FD4]">Kelola semua transaksi yang masuk di platform</p>
</header>

<div class="flex-1 p-8 pt-0 overflow-y-auto space-y-6">

        <div class="bg-[#041830] border border-green-500 rounded-xl p-4 flex justify-between items-center relative overflow-hidden">
        <div class="absolute left-0 top-0 bottom-0 w-1 bg-green-500"></div>
        <div class="flex gap-4 items-center z-10">
            <div class="w-8 h-8 rounded-md bg-green-500 flex items-center justify-center text-white shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <div>
                <h3 class="text-green-500 font-bold tracking-wide">TRANSAKSI BERHASIL / LUNAS</h3>
                <p class="text-xs text-[#4A9FD4]">Pembayaran dikonfirmasi pada 15 Februari 2026, 14:32 WIB via BCA Virtual Account</p>
            </div>
        </div>
        <div class="text-sm text-[#DADADA] z-10 font-medium">
            Kode: <span class="text-white">#07483648</span>
        </div>
    </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
                <div class="space-y-6">
                        <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6">
                <h3 class="text-white font-bold mb-4 border-b border-[#202020] pb-2">Data Pembeli</h3>
                
                <div class="flex items-center gap-4 mb-6">
                    <img src="https://ui-avatars.com/api/?name=Zara&background=C9A84C&color=fff" class="w-12 h-12 rounded-full border-2 border-[#4A9FD4]">
                    <div>
                        <h4 class="text-white font-bold text-lg leading-tight">Zara</h4>
                        <p class="text-xs text-gray-400 flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg> zara@gmail.com</p>
                        <p class="text-xs text-gray-400 flex items-center gap-1 mt-0.5"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg> +62 821-1234-5678</p>
                    </div>
                </div>

                <table class="w-full text-sm text-[#DADADA]">
                    <tbody class="divide-y divide-[#202020]">
                        <tr>
                            <td class="py-2.5 w-1/3">Terdaftar sejak</td>
                            <td class="py-2.5 text-white">15 Februari 2026</td>
                        </tr>
                        <tr>
                            <td class="py-2.5">Total transaksi</td>
                            <td class="py-2.5 text-white">2 transaksi</td>
                        </tr>
                        <tr>
                            <td class="py-2.5">Total spending</td>
                            <td class="py-2.5 text-white">Rp 3,030,000</td>
                        </tr>
                        <tr>
                            <td class="py-2.5 border-b-0">Kota asal</td>
                            <td class="py-2.5 border-b-0 text-white">Solo</td>
                        </tr>
                    </tbody>
                </table>
            </div>

                        <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6">
                <h3 class="text-white font-bold mb-4 border-b border-[#202020] pb-2">Ringkasan Pembayaran</h3>
                
                <div class="space-y-3 text-sm text-[#DADADA] mb-4">
                    <div class="flex justify-between">
                        <span>Harga tiket (2x)</span>
                        <span class="text-white">Rp 3,000,000</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Biaya layanan</span>
                        <span class="text-white">Rp 30,000</span>
                    </div>
                </div>
                
                <div class="flex justify-between text-white font-bold text-lg mb-6 border-t border-[#202020] pt-3">
                    <span>TOTAL DIBAYAR</span>
                    <span class="text-[#C9A84C]">Rp 3,030,000</span>
                </div>

                <div class="bg-[#4A9FD4]/10 border border-[#4A9FD4]/30 rounded-lg p-3 flex items-center gap-3">
                    <div class="bg-[#4A9FD4] text-[#020D1A] text-[10px] font-bold px-2 py-1 rounded">QRIS</div>
                    <p class="text-sm text-white font-medium">BCA Virtual Account <span class="text-xs text-[#DADADA] font-normal ml-2">No: 1276-4738-1463</span></p>
                </div>
            </div>
        </div>

                <div class="space-y-6">
                        <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6">
                <h3 class="text-white font-bold mb-4 border-b border-[#202020] pb-2">Informasi Konser</h3>
                
                <div class="flex gap-4 mb-6">
                    <img src="https://images.unsplash.com/photo-1516280440502-120042784eb4?q=80&w=200&auto=format&fit=crop" class="w-24 h-16 object-cover rounded-md">
                    <div>
                        <h4 class="text-white font-bold text-sm">SZA SOS World Tour 2026</h4>
                        <p class="text-xs text-[#C9A84C] italic mb-1">Save Or Ship World Tour</p>
                        <p class="text-[10px] text-gray-400 flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> 14 Juli 2026 • 19:30 WIB</p>
                        <p class="text-[10px] text-gray-400 flex items-center gap-1 mt-0.5"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg> GBK, Jakarta Selatan</p>
                    </div>
                </div>

                <table class="w-full text-sm text-[#DADADA]">
                    <tbody class="divide-y divide-[#202020]">
                        <tr>
                            <td class="py-2.5 w-1/3">Organizer</td>
                            <td class="py-2.5 text-white">MyMusic Entertainment</td>
                        </tr>
                        <tr>
                            <td class="py-2.5">Kategori Tiket</td>
                            <td class="py-2.5 text-white">VIP</td>
                        </tr>
                        <tr>
                            <td class="py-2.5">Jumlah Tiket</td>
                            <td class="py-2.5 text-white">2 tiket</td>
                        </tr>
                        <tr>
                            <td class="py-2.5 border-b-0">Harga per Tiket</td>
                            <td class="py-2.5 border-b-0 text-white">Rp 1,500,000</td>
                        </tr>
                    </tbody>
                </table>
            </div>

                        <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6">
                <h3 class="text-white font-bold mb-4 border-b border-[#202020] pb-2">Detail Tiket</h3>
                
                <div class="space-y-4">
                                        <div class="relative pl-4">
                        <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-[#C9A84C] rounded-full"></div>
                        <h4 class="text-white font-bold text-sm mb-2 tracking-wide">TIKET #1 — VIP Zone A</h4>
                        <div class="grid grid-cols-2 text-xs text-[#DADADA] gap-y-1">
                            <p>Seat: <span class="text-white font-medium">A10</span> • Gate: <span class="text-white font-medium">B2</span></p>
                            <p>Nama: <span class="text-white font-medium">Zara</span></p>
                            <p class="col-span-2">QR Code ID: <span class="font-mono text-[#4A9FD4]">CW-VIP-00142851</span></p>
                        </div>
                    </div>
                    
                    <div class="h-px bg-[#202020]"></div>

                                        <div class="relative pl-4">
                        <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-[#4A9FD4] rounded-full"></div>
                        <h4 class="text-white font-bold text-sm mb-2 tracking-wide">TIKET #2 — VIP Zone A</h4>
                        <div class="grid grid-cols-2 text-xs text-[#DADADA] gap-y-1">
                            <p>Seat: <span class="text-white font-medium">A11</span> • Gate: <span class="text-white font-medium">B2</span></p>
                            <p>Nama: <span class="text-white font-medium">Alisa (Ditambahkan)</span></p>
                            <p class="col-span-2">QR Code ID: <span class="font-mono text-[#4A9FD4]">CW-VIP-00142852</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
