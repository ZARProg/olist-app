<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Cek dulu apakah user sudah ada supaya tidak error duplikat
        if (!User::where('email', 'admin@olist.com')->exists()) {
            User::create([
                'name' => 'Admin Olist',
                'email' => 'admin@olist.com',
                'password' => Hash::make('password123'),
            ]);
        }
    }
}