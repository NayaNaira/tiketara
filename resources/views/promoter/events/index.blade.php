<!DOCTYPE html>
<html lang="id">
<head>
    <title>Event Management (CRUD)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        dark: '#020D1A',
                        card: '#041830',
                        gold: '#C9A84C',
                        goldHover: '#e0c068',
                        textMuted: '#DADADA',
                        borderDark: '#202020'
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom scrollbar untuk table & page */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #020D1A; }
        ::-webkit-scrollbar-thumb { background: #202020; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #C9A84C; }
        
        /* Dark mode untuk input date/time */
        input[type="datetime-local"], input[type="time"] { color-scheme: dark; }
    </style>
</head>
<body class="bg-dark text-white font-sans antialiased p-4 md:p-8">

    <div class="max-w-7xl mx-auto space-y-8">
        
        <header>
            <h1 class="text-3xl font-bold text-gold mb-2">Event Management</h1>
            <p class="text-sm text-textMuted">Kelola data event, kategori tiket, dan galeri.</p>
        </header>

        @if ($errors->any())
            <div class="bg-red-500/10 border border-red-500 text-red-500 px-4 py-3 rounded-lg">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-500/10 border border-green-500 text-green-500 px-4 py-3 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-card border border-borderDark rounded-xl p-6 md:p-8 shadow-lg">
            <h2 class="text-xl font-bold text-white mb-6 border-b border-borderDark pb-3">
                @if(isset($editEvent)) Edit Event @else Buat Event Baru @endif
            </h2>

            <form action="{{ isset($editEvent) ? route('promoter.event.update', $editEvent->id) : route('promoter.event.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data" 
                  class="space-y-6">
                
                @csrf
                @if(isset($editEvent)) @method('PUT') @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-textMuted mb-2">Title <span class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ $editEvent->title ?? '' }}" required
                               class="w-full bg-dark border border-borderDark rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-gold transition">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-textMuted mb-2">Category <span class="text-red-500">*</span></label>
                        <select name="category" required class="w-full bg-dark border border-borderDark rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-gold transition">
                            <option value="music_festival" {{ (isset($editEvent) && $editEvent->category == 'music_festival') ? 'selected' : '' }}>Music Festival</option>
                            <option value="seminar_education" {{ (isset($editEvent) && $editEvent->category == 'seminar_education') ? 'selected' : '' }}>Seminar Education</option>
                            <option value="sports" {{ (isset($editEvent) && $editEvent->category == 'sports') ? 'selected' : '' }}>Sports</option>
                            <option value="arts_theater_culture" {{ (isset($editEvent) && $editEvent->category == 'arts_theater_culture') ? 'selected' : '' }}>Arts Theater Culture</option>
                            <option value="lifestyle_holiday" {{ (isset($editEvent) && $editEvent->category == 'lifestyle_holiday') ? 'selected' : '' }}>Lifestyle Holiday</option>
                            <option value="attraction_tourism" {{ (isset($editEvent) && $editEvent->category == 'attraction_tourism') ? 'selected' : '' }}>Attraction Tourism</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-textMuted mb-2">Description <span class="text-red-500">*</span></label>
                        <textarea name="description" rows="3" required
                                  class="w-full bg-dark border border-borderDark rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-gold transition">{{ $editEvent->description ?? '' }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-textMuted mb-2">Venue Name <span class="text-red-500">*</span></label>
                        <input type="text" name="venue_name" value="{{ $editEvent->venue_name ?? '' }}" required
                               class="w-full bg-dark border border-borderDark rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-gold transition">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-textMuted mb-2">City <span class="text-red-500">*</span></label>
                        <input type="text" name="city" value="{{ $editEvent->city ?? '' }}" required
                               class="w-full bg-dark border border-borderDark rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-gold transition">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-textMuted mb-2">Venue Address <span class="text-red-500">*</span></label>
                        <textarea name="address" rows="2" required
                                  class="w-full bg-dark border border-borderDark rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-gold transition">{{ $editEvent->address ?? '' }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-textMuted mb-2">Event Date <span class="text-red-500">*</span></label>
                        <input type="datetime-local" name="event_date" value="{{ $editEvent->event_date ?? '' }}" required
                               class="w-full bg-dark border border-borderDark rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-gold transition">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-textMuted mb-2">Start Time <span class="text-red-500">*</span></label>
                            <input type="time" name="start_time" value="{{ $editEvent->start_time ?? '' }}" required
                                   class="w-full bg-dark border border-borderDark rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-gold transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-textMuted mb-2">End Time <span class="text-red-500">*</span></label>
                            <input type="time" name="end_time" value="{{ $editEvent->end_time ?? '' }}" required
                                   class="w-full bg-dark border border-borderDark rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-gold transition">
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-textMuted mb-2">Terms & Conditions <span class="text-red-500">*</span></label>
                        <textarea name="terms_and_conditions" rows="3" required
                                  class="w-full bg-dark border border-borderDark rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-gold transition">{{ $editEvent->terms_and_conditions ?? '' }}</textarea>
                    </div>
                </div>

                <hr class="border-borderDark">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-dark p-4 rounded-lg border border-borderDark">
                        <label class="block text-sm font-medium text-textMuted mb-3">Poster Event</label>
                        @if(isset($editEvent) && $editEvent->poster_path)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $editEvent->poster_path) }}" class="w-32 rounded-lg object-cover border border-borderDark">
                                <p class="text-xs text-textMuted mt-1">Poster saat ini</p>
                            </div>
                        @endif
                        <input type="file" name="poster" accept="image/*" class="w-full text-sm text-textMuted file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gold file:text-dark hover:file:bg-goldHover">
                        <p class="text-xs text-textMuted mt-2 italic">Biarkan kosong jika tidak ingin mengganti</p>
                    </div>

                    <div class="bg-dark p-4 rounded-lg border border-borderDark">
                        <label class="block text-sm font-medium text-textMuted mb-3">Gallery Images</label>
                        
                        @if(isset($editEvent) && count($editEvent->galleries) > 0)
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($editEvent->galleries as $gallery)
                                    <div class="relative group">
                                        <img src="{{ asset('storage/' . $gallery->image_path) }}" class="w-20 h-20 object-cover rounded-md border border-borderDark">
                                        <button type="button" onclick="removeGallery({{ $gallery->id }}, this)" class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition shadow-lg">✕</button>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <input type="file" name="gallery[]" multiple accept="image/*" id="galleryInput" class="w-full text-sm text-textMuted file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-borderDark file:text-white hover:file:bg-gray-700">
                        <div id="preview" class="flex flex-wrap gap-2 mt-3"></div>
                    </div>
                </div>

                <hr class="border-borderDark">

                <div>
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-white">Kategori Tiket</h3>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-2">
                                <label class="text-sm text-textMuted">Max Tiket/Order:</label>
                                <input type="number" name="max_ticket_per_order" min="1" value="{{ $editEvent->max_ticket_per_order ?? '4' }}" required class="w-16 bg-dark border border-borderDark rounded-md px-2 py-1 text-center text-sm text-white focus:border-gold">
                            </div>
                            <button type="button" onclick="addTicketType()" class="text-sm bg-gold/10 text-gold border border-gold px-3 py-1.5 rounded-full hover:bg-gold hover:text-dark transition">+ Tambah Tiket</button>
                        </div>
                    </div>

                    <div id="ticket-container" class="space-y-3">
                        @if(isset($editEvent))
                            @foreach($editEvent->ticketTypes as $ticket)
                                <div class="ticket-item grid grid-cols-1 md:grid-cols-6 gap-3 items-end bg-dark p-4 rounded-lg border border-borderDark relative group">
                                    <input type="hidden" name="ticket_id[]" value="{{ $ticket->id }}">
                                    <div class="md:col-span-2">
                                        <label class="block text-xs text-textMuted mb-1">Nama Kategori</label>
                                        <input type="text" name="ticket_name[]" value="{{ $ticket->name }}" required class="w-full bg-card border border-borderDark rounded-md px-3 py-2 text-sm text-white focus:border-gold">
                                    </div>
                                    <div>
                                        <label class="block text-xs text-textMuted mb-1">Harga (Rp)</label>
                                        <input type="number" name="ticket_type_price[]" value="{{ $ticket->price }}" required class="w-full bg-card border border-borderDark rounded-md px-3 py-2 text-sm text-white focus:border-gold">
                                    </div>
                                    <div>
                                        <label class="block text-xs text-textMuted mb-1">Kuota</label>
                                        <input type="number" name="ticket_type_quota[]" value="{{ $ticket->quota }}" required class="w-full bg-card border border-borderDark rounded-md px-3 py-2 text-sm text-white focus:border-gold">
                                    </div>
                                    <div>
                                        <label class="block text-xs text-textMuted mb-1">Start Sale</label>
                                        <input type="datetime-local" name="start_sale[]" value="{{ $ticket->start_sale }}" required class="w-full bg-card border border-borderDark rounded-md px-3 py-2 text-xs text-white focus:border-gold">
                                    </div>
                                    <div>
                                        <label class="block text-xs text-textMuted mb-1">End Sale</label>
                                        <input type="datetime-local" name="end_sale[]" value="{{ $ticket->end_sale }}" required class="w-full bg-card border border-borderDark rounded-md px-3 py-2 text-xs text-white focus:border-gold">
                                    </div>
                                    <button type="button" onclick="this.parentElement.remove()" class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition shadow-lg">✕</button>
                                </div>
                            @endforeach
                        @else
                            <div class="ticket-item grid grid-cols-1 md:grid-cols-6 gap-3 items-end bg-dark p-4 rounded-lg border border-borderDark relative group">
                                <div class="md:col-span-2">
                                    <label class="block text-xs text-textMuted mb-1">Nama Kategori</label>
                                    <input type="text" name="ticket_name[]" required class="w-full bg-card border border-borderDark rounded-md px-3 py-2 text-sm text-white focus:border-gold focus:outline-none">
                                </div>
                                <div>
                                    <label class="block text-xs text-textMuted mb-1">Harga (Rp)</label>
                                    <input type="number" name="ticket_type_price[]" min="0" required class="w-full bg-card border border-borderDark rounded-md px-3 py-2 text-sm text-white focus:border-gold focus:outline-none">
                                </div>
                                <div>
                                    <label class="block text-xs text-textMuted mb-1">Kuota</label>
                                    <input type="number" name="ticket_type_quota[]" min="1" required class="w-full bg-card border border-borderDark rounded-md px-3 py-2 text-sm text-white focus:border-gold focus:outline-none">
                                </div>
                                <div>
                                    <label class="block text-xs text-textMuted mb-1">Start Sale</label>
                                    <input type="datetime-local" name="start_sale[]" required class="w-full bg-card border border-borderDark rounded-md px-3 py-2 text-xs text-white focus:border-gold focus:outline-none">
                                </div>
                                <div>
                                    <label class="block text-xs text-textMuted mb-1">End Sale</label>
                                    <input type="datetime-local" name="end_sale[]" required class="w-full bg-card border border-borderDark rounded-md px-3 py-2 text-xs text-white focus:border-gold focus:outline-none">
                                </div>
                                <button type="button" onclick="this.parentElement.remove()" class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition shadow-lg">✕</button>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="px-8 py-3 rounded-lg bg-gold text-dark font-bold hover:bg-goldHover transition shadow-lg">
                        @if(isset($editEvent)) Simpan Perubahan @else Simpan Event Baru @endif
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-card border border-borderDark rounded-xl p-6 md:p-8 shadow-lg overflow-x-auto">
            <h2 class="text-xl font-bold text-white mb-6 border-b border-borderDark pb-3">Daftar Event</h2>
            
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead>
                    <tr class="bg-dark text-textMuted border-b border-borderDark">
                        <th class="p-3 rounded-tl-lg">ID</th>
                        <th class="p-3">Info Event</th>
                        <th class="p-3">Poster / Galeri</th>
                        <th class="p-3">Kategori Tiket</th>
                        <th class="p-3">Status</th>
                        <th class="p-3 rounded-tr-lg">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-borderDark">
                    @foreach($events ?? [] as $event)
                    <tr class="hover:bg-dark/50 transition">
                        <td class="p-3 align-top">{{ $event->id }}</td>
                        <td class="p-3 align-top">
                            <p class="font-bold text-gold">{{ $event->title }}</p>
                            <p class="text-xs text-textMuted mt-1">{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') ?? '' }}</p>
                            <p class="text-xs text-textMuted">{{ $event->venue_name ?? '' }}</p>
                        </td>
                        <td class="p-3 align-top">
                            @if($event->poster_path)
                                <img src="{{ asset('storage/'.$event->poster_path) }}" class="w-16 h-20 object-cover rounded-md border border-borderDark mb-2">
                            @endif
                            <div class="flex gap-1">
                                @foreach($event->galleries as $image)
                                    <img src="{{ asset('storage/'.$image->image_path) }}" class="w-8 h-8 object-cover rounded border border-borderDark">
                                @endforeach
                            </div>
                        </td>
                        <td class="p-3 align-top">
                            <div class="space-y-2">
                                @foreach($event->ticketTypes as $ticket)
                                    <div class="bg-dark p-2 rounded border border-borderDark text-xs">
                                        <p class="font-bold text-white">{{ $ticket->name }}</p>
                                        <p class="text-textMuted">Rp {{ number_format($ticket->price, 0, ',', '.') }} | Qty: {{ $ticket->quota }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td class="p-3 align-top">
                            <span class="px-2 py-1 text-[10px] uppercase font-bold rounded-full 
                                {{ $event->status === 'draft' ? 'bg-gray-500/20 text-gray-400' : ($event->status === 'pending' ? 'bg-yellow-500/20 text-yellow-500' : 'bg-green-500/20 text-green-500') }}">
                                {{ $event->status }}
                            </span>
                        </td>
                        <td class="p-3 align-top">
                            <div class="flex flex-col gap-2">
                                @if($event->status === 'draft')
                                    <form action="{{ route('promoter.event.update', $event->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="status" value="pending">
                                        <input type="hidden" name="max_ticket_per_order" value="{{ $event->max_ticket_per_order }}">
                                        <button type="submit" class="w-full text-xs bg-blue-500/10 text-blue-400 border border-blue-500/30 px-2 py-1.5 rounded hover:bg-blue-500 hover:text-white transition">Ajukan</button>
                                    </form>
                                    <form action="{{ route('promoter.event.edit', $event->id) }}" method="GET">
                                        @csrf
                                        <button type="submit" class="w-full text-xs bg-gold/10 text-gold border border-gold/30 px-2 py-1.5 rounded hover:bg-gold hover:text-dark transition">Edit</button>
                                    </form>
                                @endif
                                <form action="{{ route('promoter.event.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus event ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-full text-xs bg-red-500/10 text-red-500 border border-red-500/30 px-2 py-1.5 rounded hover:bg-red-600 hover:text-white transition">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Preview Multiple Images (Gallery)
        document.getElementById('galleryInput').addEventListener('change', function(event){
            const preview = document.getElementById('preview');
            preview.innerHTML = '';
            Array.from(event.target.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e){
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = "w-16 h-16 object-cover rounded-md border border-borderDark";
                    preview.appendChild(img);
                }
                reader.readAsDataURL(file);
            });
        });

        // Add Dynamic Ticket Type
        function addTicketType() {
            const container = document.getElementById('ticket-container');
            const html = `
                <div class="ticket-item grid grid-cols-1 md:grid-cols-6 gap-3 items-end bg-dark p-4 rounded-lg border border-borderDark relative group">
                    <div class="md:col-span-2">
                        <label class="block text-xs text-textMuted mb-1">Nama Kategori</label>
                        <input type="text" name="ticket_name[]" required class="w-full bg-card border border-borderDark rounded-md px-3 py-2 text-sm text-white focus:border-gold focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs text-textMuted mb-1">Harga (Rp)</label>
                        <input type="number" name="ticket_type_price[]" min="0" required class="w-full bg-card border border-borderDark rounded-md px-3 py-2 text-sm text-white focus:border-gold focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs text-textMuted mb-1">Kuota</label>
                        <input type="number" name="ticket_type_quota[]" min="1" required class="w-full bg-card border border-borderDark rounded-md px-3 py-2 text-sm text-white focus:border-gold focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs text-textMuted mb-1">Start Sale</label>
                        <input type="datetime-local" name="start_sale[]" required class="w-full bg-card border border-borderDark rounded-md px-3 py-2 text-xs text-white focus:border-gold focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs text-textMuted mb-1">End Sale</label>
                        <input type="datetime-local" name="end_sale[]" required class="w-full bg-card border border-borderDark rounded-md px-3 py-2 text-xs text-white focus:border-gold focus:outline-none">
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition shadow-lg">✕</button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        }

        // Delete Gallery via AJAX
        function removeGallery(id, el) {
            if (!confirm("Yakin mau hapus gambar ini?")) return;
            fetch('/gallery/' + id, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    el.parentElement.remove();
                }
            });
        }
    </script>
</body>
</html>