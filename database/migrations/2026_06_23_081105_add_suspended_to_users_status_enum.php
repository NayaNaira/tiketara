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
        Schema::table('users', function (Blueprint $table) {
            if (\Illuminate\Support\Facades\DB::getDriverName() === 'mysql') {
                \Illuminate\Support\Facades\DB::statement("ALTER TABLE users MODIFY COLUMN status ENUM('verify', 'active', 'suspended', 'banned') NOT NULL DEFAULT 'verify'");
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (\Illuminate\Support\Facades\DB::getDriverName() === 'mysql') {
                \Illuminate\Support\Facades\DB::statement("ALTER TABLE users MODIFY COLUMN status ENUM('verify', 'active', 'banned') NOT NULL DEFAULT 'verify'");
            }
        });
    }
};
