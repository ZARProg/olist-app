<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Order; 
use Carbon\Carbon;

class ProductController extends Controller
{
    // --- HELPER UNTUK LOG ---
    private function addLog($action, $details) {
        DB::table('activity_logs')->insert([
            'admin_name' => Auth::user()->name ?? 'System',
            'action' => $action,
            'details' => $details,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    // --- KATALOG & USER ---
    public function index(Request $request)
    {
        $query = DB::table('products');
        if ($request->search) {
            $query->where('product_category_name', 'like', '%' . $request->search . '%')
                  ->orWhere('product_id', 'like', '%' . $request->search . '%');
        }
        $products = $query->orderBy('product_id', 'asc')->get();
        return view('katalog', compact('products'));
    }

    public function showProduct($id)
    {
        $product = DB::table('products')->where('product_id', $id)->first();
        if (!$product) return redirect('/')->with('error', 'Produk tidak ditemukan.');
        return view('orders.product_detail', compact('product'));
    }

    public function myOrders() {
        if (!Auth::check()) return redirect('login');
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('orders.index', compact('orders'));
    }

    public function showOrderDetail($order_id)
    {
        if (!Auth::check()) return redirect('login');

        $order = Order::where('order_id', $order_id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$order) return redirect('/my-orders')->with('error', 'Pesanan tidak ditemukan.');

        $items = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.product_id')
            ->where('order_items.order_id', $order_id)
            ->select('order_items.*', 'products.product_category_name', 'products.image_url')
            ->get();

        return view('orders.show', compact('order', 'items'));
    }

    public function showCart() {
        if (!Auth::check()) return redirect('login');
        $cartItems = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.product_id')
            ->where('user_id', Auth::id())
            ->select('carts.*', 'products.product_category_name', 'products.image_url')
            ->get();
        return view('cart', compact('cartItems'));
    }

    public function addToCart(Request $request) {
        if (!Auth::check()) return redirect('login');
        
        $existing = DB::table('carts')
            ->where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($existing) {
            DB::table('carts')->where('id', $existing->id)->increment('quantity', 1);
        } else {
            DB::table('carts')->insert([
                'user_id' => Auth::id(), 
                'product_id' => $request->product_id,
                'price' => $request->price, 
                'quantity' => 1, 
                'created_at' => now()
            ]);
        }
        return redirect('cart');
    }

    public function updateCart(Request $request, $id) {
        DB::table('carts')->where('id', $id)->update(['quantity' => $request->quantity, 'updated_at' => now()]);
        return back();
    }

    public function removeFromCart($id) {
        DB::table('carts')->where('id', $id)->delete();
        return back();
    }

    // --- CHECKOUT FLOW ---
    public function showCheckout() {
        if (!Auth::check()) return redirect('login');
        $cartItems = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.product_id')
            ->where('user_id', Auth::id())
            ->select('carts.*', 'products.product_category_name', 'products.image_url')
            ->get();
        if($cartItems->isEmpty()) return redirect('/cart')->with('error', 'Keranjang kosong!');
        return view('checkout', compact('cartItems')); 
    }

    public function checkout(Request $request) {
        if (!Auth::check()) return redirect('login');
        $cartItems = DB::table('carts')->where('user_id', Auth::id())->get();
        if($cartItems->isEmpty()) return redirect('/')->with('error', 'Keranjang kosong!');
        
        $orderIdStr = 'OLIST-' . strtoupper(Str::random(10));
        $totalGross = $cartItems->sum(fn($item) => $item->price * $item->quantity);
        $alamatLengkap = "Penerima: $request->first_name $request->last_name | Alamat: $request->address, $request->city, $request->zip";

        DB::transaction(function () use ($orderIdStr, $totalGross, $cartItems, $alamatLengkap) {
            DB::table('orders')->insert([
                'user_id' => Auth::id(), 
                'order_id' => $orderIdStr,
                'gross_amount' => $totalGross, 
                'status' => 'pending', 
                'shipping_address' => $alamatLengkap, 
                'created_at' => now()
            ]);

            foreach ($cartItems as $item) {
                DB::table('order_items')->insert([
                    'order_id' => $orderIdStr, 
                    'product_id' => $item->product_id, 
                    'price' => $item->price, 
                    'seller_id' => 'OFFICIAL', 
                    'created_at' => now()
                ]);
                DB::table('products')->where('product_id', $item->product_id)->decrement('product_stock_qty', $item->quantity);
            }
            DB::table('carts')->where('user_id', Auth::id())->delete();
        });

        return redirect('/my-orders')->with('success', 'Pesanan berhasil dibuat!');
    }

    // --- ADMIN LOGIC ---
    public function admin() {
        if (!Auth::check() || Auth::user()->role !== 'admin') return redirect('/')->with('error', 'Akses ditolak!');
        
        $transactions = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name as buyer_name')
            ->orderBy('orders.created_at', 'desc')
            ->get()
            ->map(function($order) {
                $order->created_at = Carbon::parse($order->created_at);
                return $order;
            });
            
        $products = DB::table('products')->orderBy('product_id', 'asc')->get();
        $totalGrossRevenue = DB::table('orders')->where('status', 'selesai')->sum('gross_amount') ?? 0;
        $admins = DB::table('users')->where('role', 'admin')->get();
        $totalProducts = DB::table('products')->count();

        $revenueReport = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.product_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.order_id')
            ->where('orders.status', 'selesai')
            ->select(
                'products.product_id',
                'products.product_category_name as kategori',
                DB::raw('COUNT(order_items.product_id) as total_terjual'),
                DB::raw('SUM(order_items.price) as total_pendapatan')
            )
            ->groupBy('products.product_id', 'products.product_category_name')
            ->get();

        $logs = DB::table('activity_logs')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get()
            ->map(function($log) {
                $log->created_at = Carbon::parse($log->created_at);
                return $log;
            });

        return view('admin', compact('transactions', 'products', 'admins', 'totalGrossRevenue', 'totalProducts', 'revenueReport', 'logs'));
    }

    public function updateOrderStatus(Request $request, $id) {
        $order = DB::table('orders')->where('id', $id)->first();
        $newStatus = $request->status;
        if ($newStatus == 'batal' && $order->status != 'batal') {
            $items = DB::table('order_items')->where('order_id', $order->order_id)->get();
            foreach ($items as $item) { DB::table('products')->where('product_id', $item->product_id)->increment('product_stock_qty', 1); }
        }
        DB::table('orders')->where('id', $id)->update(['status' => $newStatus, 'updated_at' => now()]);
        
        $this->addLog("Update Order", "Status Order #$order->order_id diubah ke $newStatus");
        
        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    public function storeProduct(Request $request) {
        $lastProduct = DB::table('products')->orderBy('product_id', 'desc')->first();
        $nextId = 'P001';
        if ($lastProduct) {
            $lastIdNum = intval(substr($lastProduct->product_id, 1));
            $nextId = 'P' . str_pad($lastIdNum + 1, 3, '0', STR_PAD_LEFT);
        }

        DB::table('products')->insert([
            'product_id' => $nextId, 
            'product_category_name' => $request->product_category_name,
            'price' => $request->price, 
            'product_stock_qty' => $request->product_stock_qty,
            'image_url' => $request->image_url ?? 'https://placehold.co/400x400?text=No+Image',
            'created_at' => now(), 
            'updated_at' => now()
        ]);

        $this->addLog("Tambah Produk", "Menambahkan produk $nextId ($request->product_category_name)");

        return back()->with('success', 'Produk baru berhasil ditambahkan!');
    }

    public function updateProduct(Request $request, $id) {
        DB::table('products')->where('product_id', $id)->update([
            'product_category_name' => $request->product_category_name, 
            'price' => $request->price,
            'product_stock_qty' => $request->product_stock_qty, 
            'image_url' => $request->image_url, 
            'updated_at' => now()
        ]);
        
        $this->addLog("Update Produk", "Mengedit produk ID: $id");

        return redirect('/admin')->with('success', 'Produk ' . $id . ' berhasil diperbarui');
    }

    public function destroyProduct($id) { 
        DB::table('products')->where('product_id', $id)->delete(); 
        $this->addLog("Hapus Produk", "Menghapus produk ID: $id");
        return back()->with('success', 'Produk berhasil dihapus!'); 
    }

    // --- AUTH & USER MANAGEMENT ---
    public function showLogin() { return view('auth.login'); }
    public function showRegister() { return view('auth.register'); }
    
    public function login(Request $request) {
        $user = DB::table('users')->where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) { 
            Auth::loginUsingId($user->id); 
            return redirect('/'); 
        }
        return back()->with('error', 'Login gagal! Periksa email dan password Anda.');
    }

    public function register(Request $request) {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'name' => 'required'
        ]);
        $id = DB::table('users')->insertGetId([
            'name' => $request->name, 
            'email' => $request->email, 
            'password' => Hash::make($request->password), 
            'role' => 'user', 
            'created_at' => now()
        ]);
        Auth::loginUsingId($id); 
        return redirect('/');
    }

    public function logout(Request $request) { 
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/'); 
    }

    public function addAdmin(Request $request) {
        DB::table('users')->insert([
            'name' => $request->name, 
            'email' => $request->email, 
            'password' => Hash::make($request->password), 
            'role' => 'admin', 
            'created_at' => now()
        ]);
        $this->addLog("Tambah Admin", "Mendaftarkan admin baru: $request->email");
        return back()->with('success', 'Admin baru berhasil ditambahkan!');
    }

    // --- MANAJEMEN ADMIN (EDIT & DELETE) ---
    public function editAdmin($id) {
        $admin = DB::table('users')->where('id', $id)->first();
        if (!$admin) return redirect('/admin')->with('error', 'Admin tidak ditemukan.');
        return view('auth.edit_admin', compact('admin')); 
    }

    public function updateAdmin(Request $request, $id) {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'updated_at' => now()
        ];
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        DB::table('users')->where('id', $id)->update($data);
        $this->addLog("Update Admin", "Mengubah data admin: $request->email");
        return redirect('/admin')->with('success', 'Data admin berhasil diperbarui!');
    }

    public function destroyAdmin($id) {
        if (Auth::id() == $id) {
            return back()->with('error', 'Anda tidak bisa menghapus akun sendiri!');
        }
        $user = DB::table('users')->where('id', $id)->first();
        if ($user) {
            DB::table('users')->where('id', $id)->delete();
            $this->addLog("Hapus Admin", "Menghapus admin: " . $user->email);
            return back()->with('success', 'Admin berhasil dihapus!');
        }
        return back()->with('error', 'Admin tidak ditemukan!');
    }
}