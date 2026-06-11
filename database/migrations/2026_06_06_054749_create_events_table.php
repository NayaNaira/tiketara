<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 public function up(): void
  {
    Schema::create('events', function (Blueprint $table) {
     $table->id();

     $table->foreignId('promoter_id')
          ->constrained('users')
          ->cascadeOnDelete();

     // Informasi utama
     $table->string('title', 150);
     $table->text('description');

     // Kategori
     $table->enum('category', [
        'music_festival',
        'seminar_education',
        'sports',
        'arts_theater_culture',
        'lifestyle_holiday',
        'attraction_tourism'
     ]);

     // Lokasi
     $table->string('venue_name');
     $table->text('address');
     $table->string('city');

     // Waktu
     $table->date('event_date');
      $table->time('start_time');
     $table->time('end_time')->nullable();

     // Tiket
      $table->decimal('ticket_price', 12, 2);
     $table->integer('ticket_quota');
     $table->integer('tickets_sold')->default(0);

     // Media
     $table->string('poster_path');

     // Approval
     $table->enum('status', [
        'draft',
        'pending',
        'approved',
        'rejected'
     ])->default('draft');

     // Catatan admin saat reject
      $table->text('rejection_reason')->nullable();

     // Syarat & ketentuan
     $table->text('terms_and_conditions');

     $table->timestamps();
    });
 }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};