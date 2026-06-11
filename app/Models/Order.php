<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'events_id',
        'ticket_type_id',
        'payment_method_id',
        'quantity',
        'total_amount',
        'status',
        'expired_at',
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'events_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}