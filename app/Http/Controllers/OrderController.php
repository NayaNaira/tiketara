<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\TicketType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'events_id' => 'required|exists:events,id',
            'ticket_type_id' => 'required|exists:ticket_types,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'quantity' => 'required|integer|min:1',
        ]);

        try {

            $order = DB::transaction(function () use ($validated) {

                // Lock ticket biar gabisa ambil barengan
                $ticketType = TicketType::where('id', $validated['ticket_type_id'])
                    ->lockForUpdate()
                    ->first();

                // cek stok
                $available = $ticketType->quota - $ticketType->sold;

                if ($validated['quantity'] > $available) {
                    throw new \Exception('Tiket tidak mencukupi');
                }

                // optional safety check
                if ($ticketType->status !== 'active') {
                    throw new \Exception('Tiket tidak tersedia');
                }

                // cek waktu penjualan
                if ($ticketType->start_sale && now()->lt($ticketType->start_sale)) {
                    throw new \Exception('Tiket belum mulai dijual');
                }

                if ($ticketType->end_sale && now()->gt($ticketType->end_sale)) {
                    throw new \Exception('Penjualan tiket sudah ditutup');
                }

                // hitung total
                $total = $ticketType->price * $validated['quantity'];

                // buat order
                $order = Order::create([
                    'id' => Str::uuid(),
                    'user_id' => Auth::id(),
                    'events_id' => $validated['events_id'],
                    'ticket_type_id' => $validated['ticket_type_id'],
                    'payment_method_id' => $validated['payment_method_id'],
                    'quantity' => $validated['quantity'],
                    'total_amount' => $total,
                    'status' => 'pending',
                    'expired_at' => now()->addMinutes(15),
                ]);

                // update sold 
                $ticketType->increment('sold', $validated['quantity']);

                return $order;
            });

            return response()->json([
                'success' => true,
                'message' => 'Order berhasil dibuat',
                'data' => $order
            ], 201);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}