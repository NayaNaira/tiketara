@extends('layouts.promoter')
@section('title', 'Daftarkan Acara')

@section('content')
<header class="p-4 lg:p-8 pb-2 lg:pb-4">
    <h1 class="text-2xl font-bold text-[#C9A84C] mb-1">Daftarkan Acara</h1>
    <p class="text-sm text-[#4A9FD4]">Kelola semua acara yang terdaftar di platform</p>
</header>

<div class="flex-1 p-4 lg:p-8 lg:pt-0 pt-0 overflow-y-auto">
    <form action="{{ route('promoter.event.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        @csrf

        {{-- LEFT COLUMN --}}
        <div class="lg:col-span-7 bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6 space-y-4">
            <div>
                <label class="block text-xs font-semibold text-[#DADADA] mb-2 uppercase tracking-wider">Nama Acara</label>
                <input type="text" name="title" required placeholder="Acara yang Anda Miliki" class="w-full bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-[#C9A84C]">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-[#DADADA] mb-2 uppercase tracking-wider">Artis</label>
                    <input type="text" name="artist_dummy" placeholder="SZA" class="w-full bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-[#C9A84C]">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[#DADADA] mb-2 uppercase tracking-wider">Genre</label>
                    <input type="text" name="genre_dummy" placeholder="R&B" class="w-full bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-[#C9A84C]">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-[#DADADA] mb-2 uppercase tracking-wider">Tanggal Mulai</label>
                    <input type="date" name="event_date" required class="w-full bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-[#C9A84C]">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[#DADADA] mb-2 uppercase tracking-wider">Waktu</label>
                    <input type="time" name="start_time" required class="w-full bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-[#C9A84C]">
                    <input type="hidden" name="end_time" value="23:59">
                    <input type="hidden" name="max_ticket_per_order" value="4">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-[#DADADA] mb-2 uppercase tracking-wider">Nama Venue</label>
                <input type="text" name="venue_name" required placeholder="INDONESIA ARENA (GBK)" class="w-full bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-[#C9A84C]">
            </div>

            <div>
                <label class="block text-xs font-semibold text-[#DADADA] mb-2 uppercase tracking-wider">Kota</label>
                <input type="text" name="city" required placeholder="Jakarta" class="w-full bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-[#C9A84C]">
            </div>

            <div>
                <label class="block text-xs font-semibold text-[#DADADA] mb-2 uppercase tracking-wider">Alamat Lengkap</label>
                <textarea name="address" required rows="3" placeholder="Jl. Pintu Satu Senayan, Jakarta Pusat..." class="w-full bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-[#C9A84C]"></textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-[#DADADA] mb-2 uppercase tracking-wider">Deskripsi</label>
                <textarea name="description" required rows="4" placeholder="Deskripsi Acara..." class="w-full bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-[#C9A84C]"></textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-[#DADADA] mb-2 uppercase tracking-wider">Kategori Acara</label>
                <select name="category" required class="w-full bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-[#C9A84C] cursor-pointer">
                    <option value="music_festival">Music Festival</option>
                    <option value="seminar_education">Seminar Education</option>
                    <option value="sports">Sports</option>
                    <option value="arts_theater_culture">Arts Theater Culture</option>
                    <option value="lifestyle_holiday">Lifestyle Holiday</option>
                    <option value="attraction_tourism">Attraction Tourism</option>
                </select>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" name="action" value="draft" class="flex-1 border border-[#C9A84C] text-[#C9A84C] hover:bg-[#C9A84C]/10 font-bold py-3 px-6 rounded-lg transition text-sm flex items-center justify-center gap-2 cursor-pointer">
                    <i class="fa-regular fa-file-lines"></i> Draft
                </button>
                <button type="submit" class="flex-1 bg-[#C9A84C] hover:bg-[#b09141] text-[#020D1A] font-bold py-3 px-6 rounded-lg transition text-sm flex items-center justify-center gap-2 cursor-pointer">
                    <i class="fa-regular fa-paper-plane"></i> Ajukan Persetujuan
                </button>
            </div>
        </div>

        {{-- RIGHT COLUMN --}}
        <div class="lg:col-span-5 space-y-6">
            {{-- Syarat & Ketentuan --}}
            <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6">
                <label class="block text-xs font-semibold text-[#DADADA] mb-2 uppercase tracking-wider">Syarat & Ketentuan</label>
                <textarea name="terms_and_conditions" required rows="4" placeholder="Syarat & Ketentuan..." class="w-full bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-[#C9A84C]"></textarea>
            </div>

            {{-- Metode Pembayaran (Visual Dummy) --}}
            <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6">
                <label class="block text-xs font-semibold text-[#DADADA] mb-2 uppercase tracking-wider">Metode Pembayaran</label>
                <input type="text" readonly value="Midtrans Payment (Otomatis)" class="w-full bg-[#020D1A]/50 border border-[#4A9FD4]/30 rounded-lg p-2.5 text-sm text-gray-400 focus:outline-none">
            </div>

            {{-- Poster & Gallery --}}
            <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6 space-y-4">
                <h3 class="text-white text-xs font-bold uppercase tracking-wider mb-2 text-gold">Poster & Gallery</h3>
                
                <div class="grid grid-cols-2 gap-4">
                    {{-- Poster Utama --}}
                    <div class="bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-4 flex flex-col items-center justify-center text-center relative hover:bg-[#020D1A]/80 transition cursor-pointer group">
                        <i class="fa-solid fa-cloud-arrow-up text-[#4A9FD4] text-xl mb-2"></i>
                        <span class="text-[10px] text-white font-medium">Poster Utama</span>
                        <span class="text-[8px] text-gray-500 mt-1">Upload foto max 2MB (JPG/PNG)</span>
                        <input type="file" name="poster" required accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer">
                    </div>

                    {{-- Hero Banner (Dummy Visual) --}}
                    <div class="bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-4 flex flex-col items-center justify-center text-center relative hover:bg-[#020D1A]/80 transition cursor-pointer group">
                        <i class="fa-solid fa-image text-[#4A9FD4] text-xl mb-2"></i>
                        <span class="text-[10px] text-white font-medium">Hero Banner</span>
                        <span class="text-[8px] text-gray-500 mt-1">Diambil otomatis dari poster</span>
                    </div>
                </div>

                {{-- Gallery Foto --}}
                <div class="bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-4 flex flex-col items-center justify-center text-center relative hover:bg-[#020D1A]/80 transition cursor-pointer">
                    <i class="fa-solid fa-images text-[#4A9FD4] text-xl mb-2"></i>
                    <span class="text-[10px] text-white font-medium">Gallery Foto</span>
                    <span class="text-[8px] text-gray-500 mt-1">Pilih multiple foto (max 5)</span>
                    <input type="file" name="gallery[]" multiple accept="image/*" id="galleryInput" class="absolute inset-0 opacity-0 cursor-pointer">
                </div>
                <div id="preview" class="flex flex-wrap gap-2 mt-3"></div>
            </div>

            {{-- Kategori Tiket --}}
            <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6 space-y-4">
                <h3 class="text-white text-xs font-bold uppercase tracking-wider text-gold">Kategori Tiket</h3>
                
                <div id="ticket-container" class="space-y-3">
                    <div class="ticket-item bg-[#020D1A] p-4 rounded-lg border border-[#4A9FD4]/20 relative group">
                        <div class="grid grid-cols-3 gap-2">
                            <div>
                                <label class="block text-[8px] text-gray-400 mb-1 uppercase">Nama</label>
                                <input type="text" name="ticket_name[]" placeholder="VVIP" required class="w-full bg-[#041830] border border-[#4A9FD4]/20 rounded p-1 text-[10px] text-white focus:outline-none focus:border-[#C9A84C]">
                            </div>
                            <div>
                                <label class="block text-[8px] text-gray-400 mb-1 uppercase">Harga</label>
                                <input type="number" name="ticket_type_price[]" placeholder="2500000" required class="w-full bg-[#041830] border border-[#4A9FD4]/20 rounded p-1 text-[10px] text-white focus:outline-none focus:border-[#C9A84C]">
                            </div>
                            <div>
                                <label class="block text-[8px] text-gray-400 mb-1 uppercase">Kuota</label>
                                <input type="number" name="ticket_type_quota[]" placeholder="4000" required class="w-full bg-[#041830] border border-[#4A9FD4]/20 rounded p-1 text-[10px] text-white focus:outline-none focus:border-[#C9A84C]">
                            </div>
                        </div>
                        <input type="hidden" name="start_sale[]" value="{{ date('Y-m-d\TH:i') }}">
                        <input type="hidden" name="end_sale[]" value="{{ date('Y-m-d\TH:i', strtotime('+1 month')) }}">
                    </div>
                </div>

                <button type="button" onclick="addTicketType()" class="w-full bg-transparent hover:bg-white/5 text-white font-medium py-2 rounded-lg border border-dashed border-[#4A9FD4]/40 text-xs flex items-center justify-center gap-2 transition cursor-pointer">
                    <i class="fa-solid fa-plus"></i> Tambah Kategori Baru
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById('galleryInput').addEventListener('change', function(event){
        const preview = document.getElementById('preview');
        preview.innerHTML = '';
        Array.from(event.target.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e){
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = "w-12 h-12 object-cover rounded border border-[#4A9FD4]/30";
                preview.appendChild(img);
            }
            reader.readAsDataURL(file);
        });
    });

    function addTicketType() {
        const container = document.getElementById('ticket-container');
        const defaultStart = "{{ date('Y-m-d\TH:i') }}";
        const defaultEnd = "{{ date('Y-m-d\TH:i', strtotime('+1 month')) }}";
        const html = `
            <div class="ticket-item bg-[#020D1A] p-4 rounded-lg border border-[#4A9FD4]/20 relative group">
                <div class="grid grid-cols-3 gap-2">
                    <div>
                        <label class="block text-[8px] text-gray-400 mb-1 uppercase">Nama</label>
                        <input type="text" name="ticket_name[]" required class="w-full bg-[#041830] border border-[#4A9FD4]/20 rounded p-1 text-[10px] text-white focus:outline-none focus:border-[#C9A84C]">
                    </div>
                    <div>
                        <label class="block text-[8px] text-gray-400 mb-1 uppercase">Harga</label>
                        <input type="number" name="ticket_type_price[]" required class="w-full bg-[#041830] border border-[#4A9FD4]/20 rounded p-1 text-[10px] text-white focus:outline-none focus:border-[#C9A84C]">
                    </div>
                    <div>
                        <label class="block text-[8px] text-gray-400 mb-1 uppercase">Kuota</label>
                        <input type="number" name="ticket_type_quota[]" required class="w-full bg-[#041830] border border-[#4A9FD4]/20 rounded p-1 text-[10px] text-white focus:outline-none focus:border-[#C9A84C]">
                    </div>
                </div>
                <input type="hidden" name="start_sale[]" value="${defaultStart}">
                <input type="hidden" name="end_sale[]" value="${defaultEnd}">
                <button type="button" onclick="this.parentElement.remove()" class="absolute -top-1.5 -right-1.5 bg-red-600 hover:bg-red-700 text-white rounded-full w-5 h-5 flex items-center justify-center text-[10px] cursor-pointer">✕</button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
    }
</script>
@endsection
