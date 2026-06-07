<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      User::create(['name' => 'super_admin', 'email' =>'super_admin@gmail.com', 'status' => 'active', 'role' => 'super_admin', 'password' => 'super_admin']);
      User::create(['name' => 'promotor', 'email' =>'promotor@gmail.com', 'status' => 'active', 'role' => 'promotor', 'password' => 'promotor']);
      User::create(['name' => 'pembeli', 'email' =>'pembeli@gmail.com', 'status' => 'active', 'role' => 'pembeli', 'password' => 'pembeli']);
    }
}
