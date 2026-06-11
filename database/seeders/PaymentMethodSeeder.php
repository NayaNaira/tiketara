<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;



class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

public function run(): void
{
     PaymentMethod::insert([
        [
            'name' => 'QRIS',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'Bank Transfer',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'E-Wallet',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ]);
}
}
