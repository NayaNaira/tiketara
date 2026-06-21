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

    'max_ticket_per_order',

    'poster_path',

    'status',
    'rejection_reason',
    'terms_and_conditions',
];
    protected $casts = [
        'event_date' => 'date',
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

    public function ticketTypes()
    {
        return $this->hasMany(TicketType::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'events_id');
    }

    public function getPosterUrlAttribute()
    {
        if (empty($this->poster_path)) {
            return null;
        }
        if (str_starts_with($this->poster_path, 'http') || str_starts_with($this->poster_path, 'https')) {
            return $this->poster_path;
        }
        return asset('storage/' . $this->poster_path);
    }
}