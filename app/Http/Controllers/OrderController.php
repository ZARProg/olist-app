<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = DB::table('orders')
                    ->where('user_id', auth()->id())
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('orders.index', compact('orders'));
    }

    public function prosesPembayaran(Request $request) 
    {
        if (!$request->total_price) {
            return redirect('/cart')->with('error', 'Pesanan tidak valid.');
        }

        DB::beginTransaction();
        try {
            // 1. Ambil semua item di keranjang user sebelum dihapus
            $cartItems = DB::table('carts')
                           ->where('user_id', auth()->id())
                           ->get();

            if ($cartItems->isEmpty()) {
                throw new \Exception("Keranjang Anda kosong.");
            }

            // 2. Update Stok Produk secara otomatis
            foreach ($cartItems as $item) {
                // Ambil stok sekarang
                $product = DB::table('products')->where('product_id', $item->product_id)->first();
                
                if (!$product || $product->product_stock_qty < $item->quantity) {
                    throw new \Exception("Stok untuk produk {$product->product_category_name} tidak mencukupi.");
                }

                // Kurangi stok di database
                DB::table('products')->where('product_id', $item->product_id)->decrement('product_stock_qty', $item->quantity);
            }

            // 3. Simpan Alamat User
            DB::table('users')->where('id', auth()->id())->update([
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'updated_at' => now()
            ]);

            // 4. Simpan Pesanan
            $orderId = 'OLIST-' . time();
            DB::table('orders')->insert([
                'user_id' => auth()->id(),
                'order_id' => $orderId,
                'gross_amount' => (int) $request->total_price,
                'snap_token' => 'manual_payment',
                'status' => 'pending', 
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // 5. Kosongkan Keranjang
            DB::table('carts')->where('user_id', auth()->id())->delete();

            DB::commit();
            return redirect('/my-orders')->with('success', 'Pesanan berhasil! Stok produk otomatis diperbarui.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/cart')->with('error', $e->getMessage());
        }
    }
}