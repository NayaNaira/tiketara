<?php

namespace App\Http\Controllers\buyer;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\TicketType;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use Illuminate\Support\Facades\Route;

class OrderController extends Controller
{
    // Fungsi inisialisasi konfigurasi Midtrans
    protected function initMidtrans()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION') === 'true';
        Config::$isSanitized = env('MIDTRANS_IS_SANITIZED') === 'true';
        Config::$is3ds = env('MIDTRANS_IS_3DS') === 'true';
    }

    public function index()
    {
        $orders = Order::with([
            'user',
            'event',
            'ticketType'
        ])->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $orders
        ]);
    }

    /**
     * Pintu Masuk Form 1: LANGSUNG SIMPAN KE DATABASE USER
     */
    public function checkoutStore(Request $request, $eventId)
    {
        // 1. Validasi Input Form dengan pengecekan UNIQUE NIK & Email
        $request->validate([
            'full_name'    => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email,' . Auth::id(),
            'phone_number' => 'required|string|max:20',
            // Cek apakah NIK sudah dipakai orang lain, kecuali akun user ini sendiri
            'nik'          => 'required|string|size:16|unique:users,nik,' . Auth::id(),
            'agreement'    => 'required',
        ], [
            // Custom pesan error bahasa Indonesia
            'nik.unique'   => 'Nomor ID / NIK KTP ini sudah terdaftar di sistem dengan akun lain.',
            'email.unique' => 'Alamat email ini sudah digunakan oleh akun lain.',
            'nik.size'     => 'NIK KTP harus tepat 16 digit.',
            'agreement.required' => 'Anda harus menyetujui syarat dan ketentuan yang berlaku.',
        ]);

        // 2. Jika lolos validasi, langsung simpan permanen ke tabel users
        $user = User::find(Auth::id());
        if ($user) {
            $user->update([
                'name'         => $request->full_name,
                'email'        => $request->email,
                'phone_number' => $request->phone_number,
                'nik'          => $request->nik,
            ]);
        }

        // 3. Alihkan ke halaman Ringkasan Transaksi (Summary)
        return redirect()->route('buyer.order.review', $eventId);
    }

    /**
     * STEP 3: Menampilkan Halaman Ringkasan Pesanan (Summary)
     */
    public function reviewOrder($eventId)
    {
        // 1. Ambil data pilihan tiket dari session (pastikan masih ada)
        if (!session()->has('booking_ticket_type_id') || !session()->has('booking_quantity')) {
            return redirect()->route('buyer.ticket.select', $eventId)->with('error', 'Sesi habis, silakan pilih kategori tiket kembali.');
        }

        $ticketTypeId = session('booking_ticket_type_id');
        $quantity = session('booking_quantity');

        // 2. Tarik data asli dari database
        $event = Event::findOrFail($eventId);
        $ticketType = TicketType::findOrFail($ticketTypeId);
        $user = Auth::user();

        // 3. Hitung total biaya
        $subtotal = $ticketType->price * $quantity;
        $biayaLayanan = 0; 
        $totalAmount = $subtotal + $biayaLayanan;

        session(['booking_total_amount' => $totalAmount]);

        // Ambil data buyer langsung dari database user yang sudah diperbarui tadi
        $buyerData = [
            'full_name'    => $user->name,
            'email'        => $user->email,
            'phone_number' => $user->phone_number,
            'nik'          => $user->nik,
        ];

        return view('user.event.order-summary', compact('event', 'ticketType', 'quantity', 'biayaLayanan', 'totalAmount', 'buyerData'));
    }

    /**
     * STEP 4: Proses Pembuatan Invoice Order & Generate Token Midtrans
     */
    public function store(Request $request, $eventId)
    {
        // Pengaman ekstra: Jika session hilang, baca langsung dari hidden input data Form Summary!
        $ticketTypeId = session('booking_ticket_type_id') ?? $request->input('ticket_type_id');
        $quantity = session('booking_quantity') ?? $request->input('quantity');

        if (!$ticketTypeId || !$quantity) {
            return redirect()->route('buyer.ticket.select', $eventId)->with('error', 'Sesi pemilihan tiket habis atau tidak valid.');
        }

        try {
            // Jalankan DB Transaction untuk mengunci kuota tiket
            $order = DB::transaction(function () use ($eventId, $ticketTypeId, $quantity) {
                
                $ticketType = TicketType::where('id', $ticketTypeId)
                    ->lockForUpdate()
                    ->firstOrFail();

                // Cek sisa stok kuota
                $available = $ticketType->quota - $ticketType->sold;
                if ($quantity > $available) {
                    throw new \Exception('Kuantitas tiket yang diminta melebihi sisa kuota tersedia.');
                }

                if ($ticketType->status !== 'active') {
                    throw new \Exception('Kategori tiket ini sedang tidak aktif.');
                }

                $total = $ticketType->price * $quantity;

                // Buat data order baru menggunakan UUID
                $order = Order::create([
                    'id'                => Str::uuid(),
                    'user_id'           => Auth::id(),
                    'events_id'         => $eventId,
                    'ticket_type_id'    => $ticketTypeId,
                    'payment_method_id' => \App\Models\PaymentMethod::where('is_active', true)->first()->id ?? 1, 
                    'quantity'          => $quantity,
                    'total_amount'      => $total,
                    'status'            => 'pending',
                    'expired_at'        => now()->addMinutes(15),
                ]);

                // Update total tiket terjual
                $ticketType->increment('sold', $quantity);

                return $order;
            });

            // Hapus session pemesanan tiket karena data pesanan sudah aman masuk database tabel orders
            session()->forget(['booking_ticket_type_id', 'booking_quantity', 'booking_total_amount']);

            return redirect()->route('buyer.order.payment', $order->id);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * STEP 5: Menampilkan Halaman Pembayaran Pop-Up QRIS Midtrans
     */
    public function paymentPage($id)
    {
        $order = Order::with(['event', 'ticketType', 'user'])->findOrFail($id);
        $fallbackRoute = Route::has('buyer.home') ? 'buyer.home' : 'buyer.event.index';

        if ($order->status === 'paid') {
            return redirect()->route($fallbackRoute)->with('success', 'Pembayaran berhasil, tiket Anda sudah lunas!');
        }

        // Jika server key tidak diset di .env, aktifkan mode simulasi lokal agar transaksi tidak crash
        $serverKey = env('MIDTRANS_SERVER_KEY');
        if (empty($serverKey)) {
            $isMock = true;
            $snapToken = 'mock_snap_token_' . Str::random(10);
            return view('user.payment.payment', compact('order', 'snapToken', 'isMock'));
        }

        $this->initMidtrans();
        $params = [
            'transaction_details' => [
                'order_id'     => $order->id,
                'gross_amount' => (int) $order->total_amount,
            ],
            'customer_details' => [
                'first_name' => $order->user->name,
                'email'      => $order->user->email,
                'phone'      => $order->user->phone_number,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            $isMock = false;
            return view('user.payment.payment', compact('order', 'snapToken', 'isMock'));
        } catch (\Exception $e) {
            return redirect()->route($fallbackRoute)->with('error', 'Gagal memuat sistem pembayaran: ' . $e->getMessage());
        }
    }

    /**
     * SIMULASI SUKSES LOKAL (Digunakan jika API Key Midtrans di .env kosong)
     */
    public function simulateSuccess($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'paid']);

        return redirect()->route('buyer.order.ticket', $order->id)->with('success', 'Simulasi Pembayaran Berhasil! E-Tiket Anda telah terbit.');
    }

    public function paymentNotification(Request $request)
    {
        $this->initMidtrans();

        try {
            $notif = new Notification();
            $transactionStatus = $notif->transaction_status;
            $orderId = $notif->order_id;

            $order = Order::findOrFail($orderId);

            if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
                $order->update(['status' => 'paid']);
            } elseif ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
                $order->update(['status' => 'failed']);
                $order->ticketType()->decrement('sold', $order->quantity);
            }

            return response()->json(['message' => 'Notification Success Processed']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function viewTicket($id)
    {
        $order = Order::with(['event', 'ticketType', 'user'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        $fallbackRoute = Route::has('buyer.home') ? 'buyer.home' : 'buyer.event.index';

        if ($order->status !== 'paid') {
            return redirect()->route($fallbackRoute)->with('error', 'Tiket belum lunas atau transaksi gagal.');
        }

        return view('user.order.ticket', compact('order'));
    }

    public function viewOfflineTicket($id)
    {
        $order = Order::with(['event', 'ticketType', 'user'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        $fallbackRoute = Route::has('buyer.home') ? 'buyer.home' : 'buyer.event.index';

        if ($order->status !== 'paid') {
            return redirect()->route($fallbackRoute)->with('error', 'Tiket belum lunas atau transaksi gagal.');
        }

        return view('user.order.ticket-offline', compact('order'));
    }

    public function checkStatus($id)
    {
        $order = Order::findOrFail($id);
        return response()->json([
            'status' => $order->status
        ]);
    }
}