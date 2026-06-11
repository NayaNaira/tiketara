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
        Schema::create('orders', function (Blueprint $table) {
            $table->string('id')->primary();

            $table->foreignId('user_id')
                  ->constrained('users');

            $table->foreignId('events_id')
                  ->constrained('events')
                  ->onDelete('cascade');

            $table->foreignId('payment_method_id')
                  ->constrained('payment_methods');

            $table->integer('quantity')->default(1);
            $table->decimal('total_amount', 10, 2);

            $table->enum('status', [ 'pending',
                                     'paid',
                                     'expired',
                                     'refunded'])
                  ->default('pending');

            $table->dateTime('expired_at');

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
