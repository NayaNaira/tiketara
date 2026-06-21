<?php

namespace App\Http\Controllers\buyer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Menampilkan semua event aktif di halaman utama buyer
    public function index()
    {
        return redirect('/');
    }

    // Halaman pencarian dan filter event
    public function search(Request $request)
    {
        $query = Event::with(['galleries', 'ticketTypes'])->where('events.status', 'approved');

        // Filter: Kata Kunci (Keyword)
        if ($request->has('q') && !empty($request->q)) {
            $q = $request->q;
            $query->where(function($w) use ($q) {
                $w->where('title', 'like', "%{$q}%")
                  ->orWhere('description', 'like', "%{$q}%")
                  ->orWhere('venue_name', 'like', "%{$q}%");
            });
        }

        // Filter: Kategori
        if ($request->has('category') && !empty($request->category) && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // Filter: Kota/Lokasi
        if ($request->has('city') && !empty($request->city) && $request->city !== 'all') {
            $query->where('city', $request->city);
        }

        // Filter: Waktu/Tanggal
        if ($request->has('date') && !empty($request->date) && $request->date !== 'all') {
            $dateFilter = $request->date;
            if ($dateFilter === 'today') {
                $query->whereDate('event_date', today());
            } elseif ($dateFilter === 'tomorrow') {
                $query->whereDate('event_date', today()->addDay());
            } elseif ($dateFilter === 'this_week') {
                $query->whereBetween('event_date', [now()->startOfWeek(), now()->endOfWeek()]);
            } elseif ($dateFilter === 'this_month') {
                $query->whereBetween('event_date', [now()->startOfMonth(), now()->endOfMonth()]);
            }
        }

        // Filter: Harga (Gratis / Berbayar)
        if ($request->has('price') && !empty($request->price) && $request->price !== 'all') {
            if ($request->price === 'free') {
                $query->whereDoesHave('ticketTypes', function($q) {
                    $q->where('price', '>', 0);
                });
            } elseif ($request->price === 'paid') {
                $query->whereHas('ticketTypes', function($q) {
                    $q->where('price', '>', 0);
                });
            }
        }

        // Pengurutan (Sorting)
        $sort = $request->get('sort', 'latest');
        if ($sort === 'latest') {
            $query->latest('event_date');
        } elseif ($sort === 'oldest') {
            $query->oldest('event_date');
        } elseif ($sort === 'price_low') {
            $query->orderBy(
                \App\Models\TicketType::select('price')
                    ->whereColumn('event_id', 'events.id')
                    ->orderBy('price', 'asc')
                    ->limit(1)
            );
        } elseif ($sort === 'price_high') {
            $query->orderByDesc(
                \App\Models\TicketType::select('price')
                    ->whereColumn('event_id', 'events.id')
                    ->orderBy('price', 'desc')
                    ->limit(1)
            );
        } else {
            $query->latest();
        }

        $events = $query->get();

        // Mengambil opsi unik untuk filter dropdown
        $cities = Event::where('status', 'approved')->distinct()->orderBy('city')->pluck('city')->toArray();
        
        // Manual daftar kategori terjemahan/pilihan agar bersih
        $categories = [
            'music_festival' => 'Konser Musik',
            'seminar_education' => 'Seminar & Edukasi',
            'sports' => 'Olahraga & Sports',
            'arts_theater_culture' => 'Seni & Teater',
            'lifestyle_holiday' => 'Lifestyle & Liburan',
            'attraction_tourism' => 'Atraksi & Wisata'
        ];

        return view('user.event.search', compact('events', 'cities', 'categories'));
    }

    // Menampilkan halaman detail event tertentu (detail.blade.php)
    public function show($id)
    {
        $event = Event::with(['galleries', 'ticketTypes'])
            ->where('status', 'approved')
            ->findOrFail($id);

        return view('user.event.detail', compact('event'));
    }

    // STEP 1: Menampilkan halaman form pilihan jenis & jumlah tiket
    public function selectTicket($id)
    {
        $event = Event::with(['ticketTypes'])
            ->where('status', 'approved')
            ->findOrFail($id);

        // Diubah ke user.event.ticket-selection sesuai struktur file kamu
        return view('user.event.ticket-selection', compact('event'));
    }

    // STEP 1 (POST): Menyimpan sementara pilihan kategori tiket ke session
    public function saveTicketSelection(Request $request, $id)
    {
        $request->validate([
            'ticket_type_id' => 'required|exists:ticket_types,id',
            'quantity'       => 'required|integer|min:1|max:4',
        ]);

        session([
            'booking_ticket_type_id' => $request->ticket_type_id,
            'booking_quantity'       => $request->quantity,
        ]);

        return redirect()->route('buyer.checkout.form', $id);
    }

    // STEP 2: Menampilkan halaman form pengisian data pemegang tiket
    public function checkoutForm($id)
    {
        // Proteksi: Jika user melompat langsung tanpa pilih tiket, kembalikan ke Step 1
        if (!session()->has('booking_ticket_type_id')) {
            return redirect()->route('ticket.select', $id)->with('error', 'Silakan pilih kategori tiket terlebih dahulu.');
        }

        $event = Event::where('status', 'approved')->findOrFail($id);

        // Diubah ke user.event.ticket-holder sesuai struktur file kamu
        return view('user.event.ticket-holder', compact('event'));
    }

    // STEP 2 (POST): Memvalidasi data pemegang tiket sebelum masuk ke sistem pembayaran
    public function checkoutStore(Request $request, $id)
    {
        $validated = $request->validate([
            'full_name'       => 'required|string|max:255',
            'email'           => 'required|email|max:255',
            'phone_number'    => 'required|string|max:20',
            'birth_date'      => 'required|date',
            'nationality'     => 'required|string|max:50',
            'city'            => 'required|string|max:100',
            'identity_number' => 'required|string|size:16', // Memastikan NIK KTP pas 16 digit
            'seat_number'     => 'required|string|max:10',
            'special_needs'   => 'nullable|string|max:255',
            'agreement'       => 'required|accepted',
        ]);

        // Simpan data pemegang tiket ke session melengkapi data kuantitas tiket sebelumnya
        session(['booking_user_data' => $validated]);

        // Alihkan ke rute halaman pembayaran (Ubah nama rute 'payment.page' sesuai sistem kamu nanti)
        return redirect()->route('payment.page')->with('success', 'Data berhasil disimpan. Silakan selesaikan pembayaran.');
    }

    public function paymentPage()
    {
        // Proteksi: Pastikan data tiket dan data diri sudah terisi lengkap di session
        if (!session()->has('booking_ticket_type_id') || !session()->has('booking_user_data')) {
            return redirect()->route('buyer.event.index')->with('error', 'Sesi pemesanan Anda telah berakhir.');
        }

        // Ambil data dari session
        $ticketTypeId = session('booking_ticket_type_id');
        $quantity = session('booking_quantity');
        $userData = session('booking_user_data');

        // Cari data kategori tiket beserta detail event-nya
        // Pastikan relasi 'event' sudah terdefinisi di model TicketType
        $ticketType = \App\Models\TicketType::with('event')->findOrFail($ticketTypeId);
        $event = $ticketType->event;

        // Hitung rincian biaya
        $pricePerTicket = $ticketType->price;
        $subtotal = $pricePerTicket * $quantity;
        $tax = $subtotal * 0.11; // Contoh Pajak Hiburan 11%
        $adminFee = 10000; // Biaya admin flat Rp 10.000
        $totalAmount = $subtotal + $tax + $adminFee;

        // Simpan total pembayaran ke session untuk keperluan proses bayar nanti
        session(['booking_total_amount' => $totalAmount]);

        return view('user.event.payment', compact('event', 'ticketType', 'quantity', 'userData', 'subtotal', 'tax', 'adminFee', 'totalAmount'));
    }
}