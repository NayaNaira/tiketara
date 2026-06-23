<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
    'promoter_id',
    'slug',
    'title',
    'description',
    'category',
    'age_rating',

    'venue_name',
    'address',
    'city',

    'event_date',
    'start_time',
    'end_time',

    'max_ticket_per_order',

    'poster_path',
    'hero_banner_path',

    'status',
    'rejection_reason',
    'terms_and_conditions',
];
    protected $casts = [
        'event_date' => 'date',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = static::generateUniqueSlug($event->title);
            }
        });

        static::updating(function ($event) {
            if ($event->isDirty('title')) {
                $event->slug = static::generateUniqueSlug($event->title, $event->id);
            }
        });
    }

    public static function generateUniqueSlug($title, $ignoreId = 0)
    {
        $baseSlug = \Illuminate\Support\Str::slug($title);
        $randomStr = \Illuminate\Support\Str::random(6);
        $slug = "{$baseSlug}-{$randomStr}";
        $originalSlug = $slug;
        $count = 1;

        while (static::where('slug', $slug)->where('id', '!=', $ignoreId)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        return $slug;
    }

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

    public function getHeroBannerUrlAttribute()
    {
        if (empty($this->hero_banner_path)) {
            // Fallback to poster
            return $this->poster_url;
        }
        if (str_starts_with($this->hero_banner_path, 'http') || str_starts_with($this->hero_banner_path, 'https')) {
            return $this->hero_banner_path;
        }
        return asset('storage/' . $this->hero_banner_path);
    }
}