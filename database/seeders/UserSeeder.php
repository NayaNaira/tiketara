<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

public function run(): void
{
    User::create([
        'name' => 'Super Admin',
        'email' => 'super_admin@gmail.com',
        'email_verified_at' => now(),
        'status' => 'active',
        'role' => 'super_admin',
        'password' => Hash::make('super_admin'),
    ]);

    User::create([
        'name' => 'Promoter',
        'email' => 'promoter@gmail.com',
        'email_verified_at' => now(),
        'status' => 'active',
        'role' => 'promoter',
        'is_promoter_approved' => true,
        'password' => Hash::make('promoter'),
    ]);

    User::create([
        'name' => 'Buyer',
        'email' => 'buyer@gmail.com',
        'email_verified_at' => now(),
        'status' => 'active',
        'role' => 'buyer',
        'password' => Hash::make('buyer'),
    ]);
}
}
