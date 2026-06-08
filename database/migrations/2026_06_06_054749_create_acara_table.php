<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('acara', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_promotor')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->string('judul', 150);
            $table->text('deskripsi');
            $table->decimal('harga', 10, 2);
            $table->enum('kategori', ['Musik & Festival', 'Seminar & Edukasi', 'Olahraga', 'Seni, Teater & Budaya', 'Gaya Hidup & Liburan', 'Atraksi & Wisata']);
            $table->integer('kuota_tiket');
            $table->string('url_poster');
            $table->text('syarat_ketentuan');

            $table->enum('status', ['pending', 'approved', 'rejected'])
                  ->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acara');
    }
};
