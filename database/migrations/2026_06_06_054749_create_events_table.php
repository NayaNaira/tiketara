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
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            $table->foreignId('promoter_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->string('title', 150);
            $table->text('description');
            $table->decimal('ticket_price', 10, 2);
            $table->enum('category', ['music_festival',
                'seminar_education',
                'sports',
                'arts_theater_culture',
                'lifestyle_holiday',
                'attraction_tourism']);

            $table->integer('ticket_quota');
            $table->string('poster_url');
            $table->text('terms_and_conditions');

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
