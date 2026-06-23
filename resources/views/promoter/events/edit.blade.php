@extends('layouts.promoter')
@section('title', 'Edit Acara')

@section('content')
<header class="p-4 lg:p-8 pb-2 lg:pb-4">
    <h1 class="text-2xl font-bold text-[#C9A84C] mb-1">Edit Acara</h1>
    <p class="text-sm text-[#4A9FD4]">Kelola semua acara yang terdaftar di platform</p>
</header>

<div class="flex-1 p-4 lg:p-8 lg:pt-0 pt-0 overflow-y-auto">
    <form action="{{ route('promoter.event.update', $editEvent->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        {{-- LEFT COLUMN --}}
        <div class="lg:col-span-7 space-y-4">
            @if ($errors->any())
                <div class="bg-red-500/10 border border-red-500/50 text-red-500 p-4 rounded-xl text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6 space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-[#DADADA] mb-2 uppercase tracking-wider">Nama Acara</label>
                    <input type="text" name="title" required value="{{ $editEvent->title }}" placeholder="Acara yang Anda Miliki" class="w-full bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-[#C9A84C]">
                </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-[#DADADA] mb-2 uppercase tracking-wider">Rating Acara</label>
                    <select name="age_rating" required class="w-full bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-[#C9A84C] cursor-pointer">
                        <option value="all_ages" {{ $editEvent->age_rating == 'all_ages' ? 'selected' : '' }}>Semua Umur</option>
                        <option value="13_plus" {{ $editEvent->age_rating == '13_plus' ? 'selected' : '' }}>13+</option>
                        <option value="17_plus" {{ $editEvent->age_rating == '17_plus' ? 'selected' : '' }}>17+</option>
                        <option value="18_plus" {{ $editEvent->age_rating == '18_plus' ? 'selected' : '' }}>18+</option>
                        <option value="21_plus" {{ $editEvent->age_rating == '21_plus' ? 'selected' : '' }}>21+</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[#DADADA] mb-2 uppercase tracking-wider">Maks. Tiket / Transaksi</label>
                    <input type="number" name="max_ticket_per_order" required value="{{ $editEvent->max_ticket_per_order }}" min="1" class="w-full bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-[#C9A84C]">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-[#DADADA] mb-2 uppercase tracking-wider">Tanggal Mulai</label>
                    <input type="date" name="event_date" required value="{{ $editEvent->event_date ? $editEvent->event_date->format('Y-m-d') : '' }}" class="w-full bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-[#C9A84C]">
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-semibold text-[#DADADA] mb-2 uppercase tracking-wider">Waktu Mulai</label>
                        <input type="time" name="start_time" required value="{{ $editEvent->start_time }}" class="w-full bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-[#C9A84C]">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-[#DADADA] mb-2 uppercase tracking-wider">Waktu Selesai</label>
                        <input type="time" name="end_time" required value="{{ $editEvent->end_time }}" class="w-full bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-[#C9A84C]">
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-[#DADADA] mb-2 uppercase tracking-wider">Nama Venue</label>
                <input type="text" name="venue_name" required value="{{ $editEvent->venue_name }}" placeholder="INDONESIA ARENA (GBK)" class="w-full bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-[#C9A84C]">
            </div>

            <div>
                <label class="block text-xs font-semibold text-[#DADADA] mb-2 uppercase tracking-wider">Kota</label>
                <input type="text" name="city" required value="{{ $editEvent->city }}" placeholder="Jakarta" class="w-full bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-[#C9A84C]">
            </div>

            <div>
                <label class="block text-xs font-semibold text-[#DADADA] mb-2 uppercase tracking-wider">Alamat Lengkap</label>
                <textarea name="address" required rows="3" placeholder="Jl. Pintu Satu Senayan, Jakarta Pusat..." class="w-full bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-[#C9A84C]">{{ $editEvent->address }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-[#DADADA] mb-2 uppercase tracking-wider">Deskripsi</label>
                <textarea name="description" required rows="4" placeholder="Deskripsi Acara..." class="w-full bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-[#C9A84C]">{{ $editEvent->description }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-[#DADADA] mb-2 uppercase tracking-wider">Kategori Acara</label>
                <select name="category" required class="w-full bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-[#C9A84C] cursor-pointer">
                    <option value="music_festival" {{ $editEvent->category == 'music_festival' ? 'selected' : '' }}>Music Festival</option>
                    <option value="seminar_education" {{ $editEvent->category == 'seminar_education' ? 'selected' : '' }}>Seminar Education</option>
                    <option value="sports" {{ $editEvent->category == 'sports' ? 'selected' : '' }}>Sports</option>
                    <option value="arts_theater_culture" {{ $editEvent->category == 'arts_theater_culture' ? 'selected' : '' }}>Arts Theater Culture</option>
                    <option value="lifestyle_holiday" {{ $editEvent->category == 'lifestyle_holiday' ? 'selected' : '' }}>Lifestyle Holiday</option>
                    <option value="attraction_tourism" {{ $editEvent->category == 'attraction_tourism' ? 'selected' : '' }}>Attraction Tourism</option>
                </select>
            </div>
        </div>
        </div>

        {{-- RIGHT COLUMN --}}
        <div class="lg:col-span-5 space-y-6">
            {{-- Syarat & Ketentuan --}}
            <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6">
                <label class="block text-xs font-semibold text-[#DADADA] mb-2 uppercase tracking-wider">Syarat & Ketentuan</label>
                <textarea name="terms_and_conditions" required rows="4" placeholder="Syarat & Ketentuan..." class="w-full bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-[#C9A84C]">{{ $editEvent->terms_and_conditions }}</textarea>
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
                    <div class="bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-4 flex flex-col items-center justify-center text-center relative hover:bg-[#020D1A]/80 transition cursor-pointer group min-h-[120px]">
                        @if($editEvent->poster_path)
                            <img id="posterPreview" data-original-src="{{ $editEvent->poster_url }}" src="{{ $editEvent->poster_url }}" class="absolute inset-0 w-full h-full object-cover rounded-lg" onerror="this.style.display='none'; this.nextElementSibling.style.display='none'; this.nextElementSibling.nextElementSibling.style.display='flex';">
                            <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 flex flex-col items-center justify-center transition z-0">
                                <i class="fa-solid fa-cloud-arrow-up text-white text-lg"></i>
                                <span class="text-[8px] text-white mt-1">Ganti Poster</span>
                            </div>
                            <div id="posterPlaceholder" style="display:none;" class="absolute inset-0 flex flex-col items-center justify-center text-slate-500 bg-gradient-to-br from-[#0c1e35] to-[#1a3a60] rounded-lg">
                                <i class="fa-solid fa-cloud-arrow-up text-[#C9A84C] text-lg mb-1"></i>
                                <span class="text-[8px] uppercase tracking-wider font-semibold text-slate-300">Ganti Poster</span>
                            </div>
                        @else
                            <div id="posterPlaceholder" class="flex flex-col items-center justify-center w-full h-full">
                                <i class="fa-solid fa-cloud-arrow-up text-[#4A9FD4] text-xl mb-2"></i>
                                <span class="text-[10px] text-white font-medium">Poster Utama</span>
                            </div>
                            <img id="posterPreview" data-original-src="" class="absolute inset-0 w-full h-full object-cover rounded-lg hidden">
                        @endif
                        <input type="file" name="poster" id="posterInput" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                        <button type="button" id="cancelPosterBtn" class="absolute -top-2 -right-2 bg-red-600 hover:bg-red-700 text-white rounded-full w-6 h-6 flex items-center justify-center text-[12px] cursor-pointer hidden z-20 shadow-lg">✕</button>
                    </div>

                    {{-- Hero Banner (Optional Upload) --}}
                    <div class="bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-4 flex flex-col items-center justify-center text-center relative hover:bg-[#020D1A]/80 transition cursor-pointer group min-h-[120px]">
                        @if($editEvent->hero_banner_path)
                            <img id="heroPreview" data-original-src="{{ $editEvent->hero_banner_url }}" src="{{ $editEvent->hero_banner_url }}" class="absolute inset-0 w-full h-full object-cover rounded-lg">
                            <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 flex flex-col items-center justify-center transition z-0">
                                <i class="fa-solid fa-cloud-arrow-up text-white text-lg"></i>
                                <span class="text-[8px] text-white mt-1">Ganti Hero Banner</span>
                            </div>
                            <div id="heroPlaceholder" style="display:none;" class="absolute inset-0 flex flex-col items-center justify-center text-slate-500 bg-gradient-to-br from-[#0c1e35] to-[#1a3a60] rounded-lg">
                                <i class="fa-solid fa-cloud-arrow-up text-[#C9A84C] text-lg mb-1"></i>
                                <span class="text-[8px] uppercase tracking-wider font-semibold text-slate-300">Ganti Hero Banner</span>
                            </div>
                        @else
                            <div id="heroPlaceholder" class="flex flex-col items-center justify-center w-full h-full pointer-events-none z-10">
                                <i class="fa-solid fa-image text-[#4A9FD4] text-xl mb-2"></i>
                                <span class="text-[10px] text-white font-medium">Hero Banner (Opsional)</span>
                                <span class="text-[8px] text-gray-500 mt-1">Upload banner custom atau biarkan kosong (otomatis dari poster)</span>
                            </div>
                            <img id="heroPreview" data-original-src="{{ $editEvent->poster_url }}" src="{{ $editEvent->poster_url }}" class="absolute inset-0 w-full h-full object-cover rounded-lg blur-xs">
                        @endif
                        
                        <input type="file" name="hero_banner" id="heroInput" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                        <input type="hidden" name="remove_hero_banner" id="removeHeroBanner" value="0">
                        <button type="button" id="cancelHeroBtn" class="absolute -top-2 -right-2 bg-red-600 hover:bg-red-700 text-white rounded-full w-6 h-6 flex items-center justify-center text-[12px] cursor-pointer hidden z-20 shadow-lg">✕</button>
                        
                        @if($editEvent->hero_banner_path)
                            <button type="button" id="removeExistingHeroBtn" class="absolute -top-2 -right-2 bg-red-600 hover:bg-red-700 text-white rounded-full w-6 h-6 flex items-center justify-center text-[12px] cursor-pointer z-20 shadow-lg" title="Hapus Hero Banner Custom">✕</button>
                        @endif
                    </div>
                </div>

                {{-- Gallery Foto --}}
                <div class="bg-[#020D1A] border border-[#4A9FD4]/30 rounded-lg p-4 flex flex-col items-center justify-center text-center relative hover:bg-[#020D1A]/80 transition cursor-pointer">
                    <i class="fa-solid fa-images text-[#4A9FD4] text-xl mb-2"></i>
                    <span class="text-[10px] text-white font-medium">Gallery Foto (Opsional)</span>
                    <span class="text-[8px] text-gray-500 mt-1">Pilih multiple foto (max 5)</span>
                    <input type="file" name="gallery[]" multiple accept="image/*" id="galleryInput" class="absolute inset-0 opacity-0 cursor-pointer">
                </div>
                
                {{-- Existing Galleries --}}
                @if(count($editEvent->galleries) > 0)
                    <div class="flex flex-wrap gap-2 mt-3">
                        @foreach($editEvent->galleries as $gallery)
                            <div class="relative group w-12 h-12 rounded border border-[#4A9FD4]/30 overflow-hidden bg-[#020D1A] flex items-center justify-center">
                                <img src="{{ $gallery->image_url }}" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div style="display:none;" class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-[#0c1e35] to-[#1a3a60]">
                                    <i class="fa-regular fa-image text-xs text-[#C9A84C]"></i>
                                </div>
                                <button type="button" onclick="removeGallery({{ $gallery->id }}, this)" class="absolute -top-1.5 -right-1.5 bg-red-600 text-white rounded-full w-4 h-4 flex items-center justify-center text-[8px] opacity-0 group-hover:opacity-100 transition cursor-pointer z-10">✕</button>
                            </div>
                        @endforeach
                    </div>
                @endif
                <div id="preview" class="flex flex-wrap gap-2 mt-3"></div>
            </div>

            {{-- Kategori Tiket --}}
            <div class="bg-[#041830] rounded-xl border border-[#4A9FD4]/30 p-6 space-y-4">
                <h3 class="text-white text-xs font-bold uppercase tracking-wider text-gold">Kategori Tiket</h3>
                
                <div id="ticket-container" class="space-y-3">
                    @forelse($editEvent->ticketTypes as $ticket)
                        <div class="ticket-item bg-[#020D1A] p-4 rounded-lg border border-[#4A9FD4]/20 relative group">
                            <div class="grid grid-cols-3 gap-2">
                                <div>
                                    <label class="block text-[8px] text-gray-400 mb-1 uppercase">Nama</label>
                                    <input type="text" name="ticket_name[]" value="{{ $ticket->name }}" required class="w-full bg-[#041830] border border-[#4A9FD4]/20 rounded p-1 text-[10px] text-white focus:outline-none focus:border-[#C9A84C]">
                                </div>
                                <div>
                                    <label class="block text-[8px] text-gray-400 mb-1 uppercase">Harga</label>
                                    <input type="number" name="ticket_type_price[]" value="{{ round($ticket->price) }}" required class="w-full bg-[#041830] border border-[#4A9FD4]/20 rounded p-1 text-[10px] text-white focus:outline-none focus:border-[#C9A84C]">
                                </div>
                                <div>
                                    <label class="block text-[8px] text-gray-400 mb-1 uppercase">Kuota</label>
                                    <input type="number" name="ticket_type_quota[]" value="{{ $ticket->quota }}" required class="w-full bg-[#041830] border border-[#4A9FD4]/20 rounded p-1 text-[10px] text-white focus:outline-none focus:border-[#C9A84C]">
                                </div>
                            </div>
                            <input type="hidden" name="start_sale[]" value="{{ $ticket->start_sale ? $ticket->start_sale->format('Y-m-d\TH:i') : date('Y-m-d\TH:i') }}">
                            <input type="hidden" name="end_sale[]" value="{{ $ticket->end_sale ? $ticket->end_sale->format('Y-m-d\TH:i') : date('Y-m-d\TH:i', strtotime('+1 month')) }}">
                            <button type="button" onclick="this.parentElement.remove()" class="absolute -top-1.5 -right-1.5 bg-red-600 hover:bg-red-700 text-white rounded-full w-5 h-5 flex items-center justify-center text-[10px] cursor-pointer">✕</button>
                        </div>
                    @empty
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
                            <input type="hidden" name="start_sale[]" value="{{ date('Y-m-d\TH:i') }}">
                            <input type="hidden" name="end_sale[]" value="{{ date('Y-m-d\TH:i', strtotime('+1 month')) }}">
                        </div>
                    @endforelse
                </div>

                <button type="button" onclick="addTicketType()" class="w-full bg-transparent hover:bg-white/5 text-white font-medium py-2 rounded-lg border border-dashed border-[#4A9FD4]/40 text-xs flex items-center justify-center gap-2 transition cursor-pointer">
                    <i class="fa-solid fa-plus"></i> Tambah Kategori Baru
                </button>
            </div>
        </div>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-[#202020]">
            <button type="submit" name="status" value="draft" class="flex-1 border border-[#C9A84C] text-[#C9A84C] hover:bg-[#C9A84C]/10 font-bold py-3.5 px-6 rounded-lg transition text-sm flex items-center justify-center gap-2 cursor-pointer">
                <i class="fa-regular fa-file-lines"></i> Simpan Draft
            </button>
            <button type="submit" id="mainSubmitBtn" name="status" value="pending" class="flex-1 bg-[#C9A84C] hover:bg-[#b09141] text-[#020D1A] font-bold py-3.5 px-6 rounded-lg transition text-sm flex items-center justify-center gap-2 cursor-pointer shadow-[0_0_15px_rgba(201,168,76,0.2)]">
                <i class="fa-solid fa-wallet" id="submitIcon" style="display: {{ $editEvent->hero_banner_path ? 'inline-block' : 'none' }};"></i>
                <i class="fa-regular fa-paper-plane" id="defaultSubmitIcon" style="display: {{ $editEvent->hero_banner_path ? 'none' : 'inline-block' }};"></i>
                <span id="submitBtnText">{{ $editEvent->hero_banner_path ? 'Lanjut ke Pembayaran' : 'Ajukan Persetujuan' }}</span>
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('posterInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('posterPreview').src = e.target.result;
                document.getElementById('posterPreview').style.display = 'block';
                document.getElementById('posterPreview').classList.remove('hidden');
                
                const placeholder = document.getElementById('posterPlaceholder');
                if (placeholder) placeholder.style.display = 'none';
                
                document.getElementById('cancelPosterBtn').classList.remove('hidden');
                
                const hasCustomHero = '{{ $editEvent->hero_banner_path ? "true" : "false" }}' === 'true';
                if (document.getElementById('heroInput').files.length === 0 && (!hasCustomHero || document.getElementById('removeHeroBanner').value === "1")) {
                    document.getElementById('heroPreview').src = e.target.result;
                    document.getElementById('heroPreview').style.display = 'block';
                    document.getElementById('heroPreview').classList.add('blur-xs');
                    document.getElementById('heroPreview').classList.remove('hidden');
                }
            }
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('cancelPosterBtn').addEventListener('click', function(event) {
        event.stopPropagation(); // Prevent triggering the file input click
        document.getElementById('posterInput').value = '';
        
        const posterPreview = document.getElementById('posterPreview');
        const originalSrc = posterPreview.getAttribute('data-original-src');
        const heroPreview = document.getElementById('heroPreview');
        const hasCustomHero = '{{ $editEvent->hero_banner_path ? "true" : "false" }}' === 'true';
        
        if (originalSrc) {
            posterPreview.src = originalSrc;
            if (document.getElementById('heroInput').files.length === 0 && (!hasCustomHero || document.getElementById('removeHeroBanner').value === "1")) {
                heroPreview.src = originalSrc;
            }
        } else {
            posterPreview.src = '';
            posterPreview.classList.add('hidden');
            posterPreview.style.display = '';
            
            if (document.getElementById('heroInput').files.length === 0 && (!hasCustomHero || document.getElementById('removeHeroBanner').value === "1")) {
                heroPreview.src = '';
                heroPreview.classList.add('hidden');
                heroPreview.style.display = '';
            }
            
            const placeholder = document.getElementById('posterPlaceholder');
            if (placeholder) placeholder.style.display = 'flex';
        }
        
        document.getElementById('cancelPosterBtn').classList.add('hidden');
    });

    document.getElementById('heroInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('heroPreview').src = e.target.result;
                document.getElementById('heroPreview').classList.remove('hidden', 'blur-xs');
                document.getElementById('heroPreview').style.display = 'block';
                
                const placeholder = document.getElementById('heroPlaceholder');
                if (placeholder) placeholder.style.display = 'none';
                
                document.getElementById('cancelHeroBtn').classList.remove('hidden');
                
                const removeExistingBtn = document.getElementById('removeExistingHeroBtn');
                if (removeExistingBtn) removeExistingBtn.classList.add('hidden');
                
                document.getElementById('removeHeroBanner').value = "0";

                document.getElementById('submitBtnText').textContent = 'Lanjut ke Pembayaran';
                document.getElementById('defaultSubmitIcon').style.display = 'none';
                document.getElementById('submitIcon').style.display = 'inline-block';
            }
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('cancelHeroBtn').addEventListener('click', function(event) {
        event.stopPropagation();
        document.getElementById('heroInput').value = '';
        
        const heroPreview = document.getElementById('heroPreview');
        const originalSrc = heroPreview.getAttribute('data-original-src');
        const hasCustomOriginal = '{{ $editEvent->hero_banner_path ? "true" : "false" }}' === 'true';
        
        if (hasCustomOriginal) {
            document.getElementById('removeHeroBanner').value = "0";
            heroPreview.src = originalSrc;
            heroPreview.classList.remove('blur-xs');
            const removeExistingBtn = document.getElementById('removeExistingHeroBtn');
            if (removeExistingBtn) removeExistingBtn.classList.remove('hidden');
        } else {
            const posterPreviewSrc = document.getElementById('posterPreview').src;
            if (posterPreviewSrc && !document.getElementById('posterPreview').classList.contains('hidden') && document.getElementById('posterPreview').style.display !== 'none') {
                heroPreview.src = posterPreviewSrc;
                heroPreview.classList.add('blur-xs');
                heroPreview.style.display = 'block';
            } else {
                heroPreview.src = '';
                heroPreview.classList.add('hidden');
            }
            const placeholder = document.getElementById('heroPlaceholder');
            if (placeholder) placeholder.style.display = 'flex';
        }
        document.getElementById('cancelHeroBtn').classList.add('hidden');
        
        const removeHeroBannerVal = document.getElementById('removeHeroBanner').value;
        if (hasCustomOriginal && removeHeroBannerVal === "0") {
            document.getElementById('submitBtnText').textContent = 'Lanjut ke Pembayaran';
            document.getElementById('defaultSubmitIcon').style.display = 'none';
            document.getElementById('submitIcon').style.display = 'inline-block';
        } else {
            document.getElementById('submitBtnText').textContent = 'Ajukan Persetujuan';
            document.getElementById('defaultSubmitIcon').style.display = 'inline-block';
            document.getElementById('submitIcon').style.display = 'none';
        }
    });

    const removeExistingHeroBtn = document.getElementById('removeExistingHeroBtn');
    if (removeExistingHeroBtn) {
        removeExistingHeroBtn.addEventListener('click', function(event) {
            event.stopPropagation();
            document.getElementById('heroInput').value = '';
            document.getElementById('removeHeroBanner').value = "1";
            
            const heroPreview = document.getElementById('heroPreview');
            const posterPreviewSrc = document.getElementById('posterPreview').src;
            if (posterPreviewSrc && !document.getElementById('posterPreview').classList.contains('hidden') && document.getElementById('posterPreview').style.display !== 'none') {
                heroPreview.src = posterPreviewSrc;
                heroPreview.classList.add('blur-xs');
                heroPreview.style.display = 'block';
            } else {
                heroPreview.src = '';
                heroPreview.classList.add('hidden');
            }
            
            removeExistingHeroBtn.classList.add('hidden');
            document.getElementById('cancelHeroBtn').classList.remove('hidden');

            document.getElementById('submitBtnText').textContent = 'Ajukan Persetujuan';
            document.getElementById('defaultSubmitIcon').style.display = 'inline-block';
            document.getElementById('submitIcon').style.display = 'none';
        });
    }

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

    function removeGallery(id, el) {
        if (!confirm("Yakin mau hapus gambar galeri ini secara permanen?")) return;
        fetch('/promoter/gallery/' + id, {
            method: 'DELETE',
            headers: { 
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                el.parentElement.remove();
            } else {
                alert(data.message || 'Gagal menghapus gambar.');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan sistem.');
        });
    }
</script>
@endsection
