<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
    'promoter_id',
    'title',
    'description',
    'category',

    'venue_name',
    'address',
    'city',

    'event_date',
    'start_time',
    'end_time',

    'ticket_price',
    'ticket_quota',
    'max_ticket_per_order',

    'poster_path',

    'status',
    'rejection_reason',
    'terms_and_conditions',
];
    protected $casts = [
        'event_date' => 'date',
        'ticket_price' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function promoter()
    {
        return $this->belongsTo(User::class, 'promoter_id');
    }

    public function galleries()
    {
        return $this->hasMany(EventGallery::class);
    }

    public function transactions()
    {
        return $this->hasMany(Order::class);
    }
}