<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'price',
        'quota',
        'sold',
        'start_sale',
        'end_sale',
        'status'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'start_sale' => 'datetime',
        'end_sale' => 'datetime',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}