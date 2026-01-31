<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

// --- Public ---
Route::get('/', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'showProduct']);

// --- Auth ---
Route::get('/login', [ProductController::class, 'showLogin'])->name('login');
Route::post('/login', [ProductController::class, 'login']);
Route::get('/register', [ProductController::class, 'showRegister']);
Route::post('/register', [ProductController::class, 'register']);
Route::post('/logout', [ProductController::class, 'logout'])->name('logout');

// --- Authenticated Users ---
Route::middleware(['auth'])->group(function () {
    
    // Cart
    Route::get('/cart', [ProductController::class, 'showCart']);
    Route::post('/add-to-cart', [ProductController::class, 'addToCart']);
    Route::post('/cart/update/{id}', [ProductController::class, 'updateCart']);
    Route::delete('/cart/remove/{id}', [ProductController::class, 'removeFromCart']);
    
    // Checkout & Orders
    Route::get('/shipping-address', [ProductController::class, 'showCheckout']); 
    Route::post('/place-order', [ProductController::class, 'checkout']); 
    Route::get('/my-orders', [ProductController::class, 'myOrders']);
    Route::get('/my-orders/{order_id}', [ProductController::class, 'showOrderDetail']); 
    
    // --- Admin Dashboard & User Management ---
    Route::get('/admin', [ProductController::class, 'admin']);
    Route::post('/admin/add-user', [ProductController::class, 'addAdmin']); 
    
    // Manajemen Admin (Edit & Update)
    Route::get('/admin/user/edit/{id}', [ProductController::class, 'editAdmin']); 
    
    // FIX UPDATE: Mendukung POST dan PUT
    Route::match(['post', 'put'], '/admin/user/update/{id}', [ProductController::class, 'updateAdmin']); 
    
    // FIX DELETE: Mendukung GET dan DELETE
    Route::match(['get', 'delete'], '/admin/user/delete/{id}', [ProductController::class, 'destroyAdmin']); 
    
    // --- Order Status ---
    Route::patch('/admin/order/update-status/{id}', [ProductController::class, 'updateOrderStatus']);

    // --- Manajemen Produk ---
    Route::post('/admin/product/store', [ProductController::class, 'storeProduct']); 
    Route::put('/admin/product/update/{id}', [ProductController::class, 'updateProduct']);
    Route::delete('/admin/product/delete/{id}', [ProductController::class, 'destroyProduct']);
});

// Cache Cleaner & Debug
Route::get('/debug-config', function () {
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    return "🚀 Sistem Segar Kembali!";
});