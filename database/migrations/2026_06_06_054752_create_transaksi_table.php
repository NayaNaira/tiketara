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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->string('id')->primary();

            $table->foreignId('id_user')
                  ->constrained('users');

            $table->foreignId('id_event')
                  ->constrained('acara')
                  ->onDelete('cascade');

            $table->foreignId('id_pembayaran')
                  ->constrained('metode_pembayaran');

            $table->integer('quantitas')->default(1);
            $table->decimal('total_harga', 10, 2);

            $table->enum('status', ['menunggu', 'berhasil', 'expired', 'refunded'])
                  ->default('menunggu');

            $table->dateTime('pembayaran_expired');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
