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
        'promoter_status' => 'none',
        'password' => Hash::make('super_admin'),
    ]);

    User::create([
        'name' => 'Promoter',
        'email' => 'promoter@gmail.com',
        'email_verified_at' => now(),
        'status' => 'active',
        'role' => 'promoter',
        'promoter_status' => 'approved',
        'password' => Hash::make('promoter'),
    ]);

    User::create([
        'name' => 'Buyer',
        'email' => 'buyer@gmail.com',
        'email_verified_at' => now(),
        'status' => 'active',
        'role' => 'buyer',
        'promoter_status' => 'none',
        'password' => Hash::make('buyer'),
    ]);

    User::create([
        'name' => 'Promoter2',
        'email' => 'promoter2@gmail.com',
        'email_verified_at' => now(),
        'status' => 'active',
        'role' => 'promoter',
        'promoter_status' => 'approved',
        'password' => Hash::make('promoter2'),
    ]);

    User::create([
        'name' => 'Promoter3',
        'email' => 'promoter3@gmail.com',
        'email_verified_at' => now(),
        'status' => 'active',
        'role' => 'promoter',
        'promoter_status' => 'approved',
        'password' => Hash::make('promoter3'),
    ]);
}
}
