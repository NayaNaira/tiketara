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
        $events = Event::with(['galleries', 'ticketTypes'])
            ->where('status', 'approved')
            ->latest()
            ->get();

        return view('buyer.event.index', compact('events')); 
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
            return redirect()->route('buyer.events.index')->with('error', 'Sesi pemesanan Anda telah berakhir.');
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