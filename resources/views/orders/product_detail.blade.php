<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucwords(str_replace('_', ' ', $product->product_category_name)) }} — OLIST</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <style>
        :root { 
            --glass-white: rgba(255, 255, 255, 0.45);
            --glass-border: rgba(255, 255, 255, 0.6);
            --text-main: #1d1d1f; 
            --text-muted: #6e6e73;
            --accent: #0071e3;
        }
        
        body { 
            background: linear-gradient(135deg, #f5f5f7 0%, #e8f0ff 100%);
            font-family: 'Plus Jakarta Sans', sans-serif; 
            color: var(--text-main);
            min-height: 100vh;
        }

        /* Background Orbs */
        .orb {
            position: fixed; width: 600px; height: 600px; border-radius: 50%;
            filter: blur(100px); z-index: -1; opacity: 0.2;
        }
        .orb-1 { background: #0071e3; top: -200px; right: -200px; }
        .orb-2 { background: #5e5ce6; bottom: -200px; left: -100px; }

        /* Glass Navbar */
        .nav-olist { 
            background: rgba(255, 255, 255, 0.3); 
            backdrop-filter: blur(20px) saturate(180%); 
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid var(--glass-border);
            z-index: 1050;
        }

        /* Glass Container Card */
        .glass-card {
            background: var(--glass-white);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 40px;
            padding: 40px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
        }

        .product-gallery { 
            background: rgba(255, 255, 255, 0.4);
            border-radius: 30px; 
            aspect-ratio: 1/1;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden; 
            border: 1px solid var(--glass-border);
        }
        .product-gallery img { 
            width: 85%; height: auto; 
            object-fit: contain; 
            transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .product-gallery:hover img { transform: scale(1.05); }
        
        .badge-arrival { 
            background: var(--accent); color: white; 
            padding: 6px 14px; border-radius: 12px;
            font-weight: 700; font-size: 0.75rem; 
            letter-spacing: 0.05em; display: inline-block;
        }

        .price-tag { 
            font-size: 2.2rem; font-weight: 700; 
            color: var(--text-main); margin: 20px 0; 
            letter-spacing: -1px; 
        }
        
        .btn-add-glass { 
            background: var(--text-main); color: white; border-radius: 20px; 
            padding: 18px 30px; font-weight: 700; border: none; width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }
        .btn-add-glass:hover { 
            background: #000; transform: translateY(-3px); 
            box-shadow: 0 15px 30px rgba(0,0,0,0.2); 
        }
        .btn-add-glass:disabled { 
            background: #d2d2d7; color: #86868b; cursor: not-allowed; transform: none; box-shadow: none;
        }

        .feature-item {
            background: rgba(255, 255, 255, 0.3);
            border: 1px solid var(--glass-border);
            border-radius: 18px;
            padding: 15px;
            margin-bottom: 12px;
            display: flex; align-items: center; gap: 15px;
            transition: 0.3s;
        }
        .feature-item:hover { background: rgba(255, 255, 255, 0.5); }
        .feature-item i { color: var(--accent); font-size: 1.2rem; }
        .feature-text { font-size: 0.9rem; font-weight: 500; color: var(--text-muted); }

        .back-link {
            color: var(--text-muted); text-decoration: none;
            font-weight: 600; font-size: 0.9rem;
            display: inline-flex; align-items: center; gap: 8px;
            margin-bottom: 25px; transition: 0.3s;
        }
        .back-link:hover { color: var(--accent); transform: translateX(-5px); }
    </style>
</head>
<body>

<div class="orb orb-1"></div>
<div class="orb orb-2"></div>

<nav class="navbar nav-olist sticky-top py-3">
    <div class="container">
        <a class="navbar-brand fw-extrabold text-dark" href="{{ url('/') }}" style="font-weight: 800; letter-spacing: -1.5px; font-size: 1.5rem;">olist.</a>
        
        {{-- Sembunyikan icon bag jika admin --}}
        @if(!Auth::check() || Auth::user()->role !== 'admin')
        <a href="{{ url('cart') }}" class="btn rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; border: 1px solid var(--glass-border);">
            <i class="fa-solid fa-bag-shopping text-dark"></i>
        </a>
        @endif
    </div>
</nav>

<div class="container my-5">
    <a href="{{ url('/') }}" class="back-link">
        <i class="fa-solid fa-arrow-left"></i> Back to Collection
    </a>

    <div class="glass-card">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="product-gallery">
                    <img src="{{ $product->image_url ?? 'https://placehold.co/600x600/f5f5f7/cccccc?text=Product' }}" alt="Product Image">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="ps-lg-4">
                    <span class="badge-arrival text-uppercase">New Arrival</span>
                    <h1 class="display-5 fw-extrabold mt-3 mb-3" style="font-weight: 800; letter-spacing: -1px;">
                        {{ ucwords(str_replace('_', ' ', $product->product_category_name)) }}
                    </h1>
                    <p class="text-muted fs-5 mb-4">Experience the perfect blend of modern design and everyday functionality.</p>
                    
                    <div class="price-tag">IDR {{ number_format($product->price, 0, ',', '.') }}</div>

                    {{-- Tombol Add to Bag hanya untuk customer/guest --}}
                    @if(!Auth::check() || Auth::user()->role !== 'admin')
                    <form action="{{ url('add-to-cart') }}" method="POST" class="mb-5">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                        <input type="hidden" name="price" value="{{ $product->price }}">
                        
                        <button type="submit" class="btn-add-glass" {{ $product->product_stock_qty <= 0 ? 'disabled' : '' }}>
                            @if($product->product_stock_qty > 0)
                                <i class="fa-solid fa-cart-plus me-2"></i> Add to Bag
                            @else
                                <i class="fa-solid fa-circle-xmark me-2"></i> Out of Stock
                            @endif
                        </button>
                    </form>
                    @else
                    <div class="alert alert-info rounded-4 border-0 bg-light-subtle mb-5">
                        <i class="fa-solid fa-user-shield me-2"></i> Mode Admin: Keranjang dinonaktifkan.
                    </div>
                    @endif

                    <div class="features mt-4">
                        <div class="feature-item">
                            <i class="fa-solid fa-truck-fast"></i>
                            <span class="feature-text">Free, fast delivery on all orders</span>
                        </div>
                        <div class="feature-item">
                            <i class="fa-solid fa-shield-halved"></i>
                            <span class="feature-text">1-year official OLIST warranty</span>
                        </div>
                        <div class="feature-item">
                            <i class="fa-solid fa-rotate-left"></i>
                            <span class="feature-text">Easy 30-day return policy</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="text-center py-5 mt-4">
    <p class="text-muted small opacity-50">© 2026 OLIST. Minimalist Design Concept.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>