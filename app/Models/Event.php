<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'acara';
    protected $fillable = [
    'promoter_id',
    'title',
    'description',
    'ticket_price',
    'category',
    'ticket_quota',
    'poster_url',
    'terms_and_conditions',
    'status'
    ];
}
