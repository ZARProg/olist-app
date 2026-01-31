<?php

public function run(): void
{
    // Buat User Admin
    User::factory()->create([
        'name' => 'Admin Olist',
        'email' => 'admin@olist.com',
        'password' => bcrypt('password123'),
    ]);

    // Tambahkan Data Produk Manual (Contoh)
    \App\Models\Product::create([
        'name' => 'Minimalist Mechanical Keyboard',
        'price' => 1500000,
        'description' => 'Aesthetic glassmorphism design keyboard.',
        'image' => 'product1.png', // Pastikan file ada di public/
        'stock' => 10
    ]);
    
    // Atau jika kamu sudah buat Factory untuk Product:
    // \App\Models\Product::factory(10)->create();
}