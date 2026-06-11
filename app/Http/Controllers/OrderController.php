<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\TicketType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with([
            'user',
            'event',
            'ticketType'
        ])->get();

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


        $ticketType = TicketType::findOrFail(
            $validated['ticket_type_id']
        );

        $available =
            $ticketType->quota - $ticketType->sold;

        if ($validated['quantity'] > $available) {

            return response()->json([
                'success' => false,
                'message' => 'Tiket tidak mencukupi'
            ], 400);
        }

        $total =
            $ticketType->price *
            $validated['quantity'];

        $order = Order::create([
            'id' => Str::uuid(),

            'user_id' => Auth::id(),

            'events_id' =>
                $validated['events_id'],

            'ticket_type_id' =>
                $validated['ticket_type_id'],

            'payment_method_id' =>
                $validated['payment_method_id'],

            'quantity' =>
                $validated['quantity'],

            'total_amount' =>
                $total,

            'expired_at' =>
                now()->addMinutes(15),
        ]);

        $ticketType->increment(
            'sold',
            $validated['quantity']
        );

        return response()->json([
            'success' => true,
            'message' => 'Order berhasil dibuat',
            'data' => $order
        ], 201);
        }
}
