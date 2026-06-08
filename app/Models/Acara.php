<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acara extends Model
{
    protected $table = 'acara';
    protected $fillable = [
    'id_promotor',
    'judul',
    'deskripsi',
    'harga',
    'kategori',
    'kuota_tiket',
    'url_poster',
    'syarat_ketentuan',
    'status'
    ];
}
