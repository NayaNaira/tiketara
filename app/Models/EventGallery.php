<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventGallery extends Model
{
    protected $fillable = [
        'event_id',
        'image_path'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function getImageUrlAttribute()
    {
        if (empty($this->image_path)) {
            return null;
        }
        if (str_starts_with($this->image_path, 'http') || str_starts_with($this->image_path, 'https')) {
            return $this->image_path;
        }
        return asset('storage/' . $this->image_path);
    }
}
