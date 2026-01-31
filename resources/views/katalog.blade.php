<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olist Market | Curated Collection</title>
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
            overflow-x: hidden;
        }

        /* Animated Background Orbs */
        .orb {
            position: fixed; width: 600px; height: 600px; border-radius: 50%;
            filter: blur(100px); z-index: -1; opacity: 0.3;
        }
        .orb-1 { background: #0071e3; top: -200px; left: -200px; }
        .orb-2 { background: #5e5ce6; bottom: -200px; right: -100px; }

        /* Glass Navbar */
        .nav-olist { 
            background: rgba(255, 255, 255, 0.3); 
            backdrop-filter: blur(20px) saturate(180%); 
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid var(--glass-border);
            z-index: 1050;
        }
        .navbar-brand { font-weight: 800; letter-spacing: -2px; font-size: 1.8rem; }
        
        .search-input { 
            background: rgba(255, 255, 255, 0.5); border: 1px solid var(--glass-border); 
            border-radius: 16px; padding: 10px 16px 10px 42px; backdrop-filter: blur(5px);
            transition: all 0.3s ease;
        }
        .search-input:focus { background: white; outline: none; box-shadow: 0 0 0 4px rgba(0, 113, 227, 0.1); }

        /* Hero Section */
        .hero-section { padding: 100px 0 60px; }
        .hero-title { font-weight: 800; font-size: clamp(3rem, 8vw, 5.5rem); letter-spacing: -0.06em; line-height: 0.9; }

        /* Product Card: Glassmorphism Edition */
        .card-product { 
            border: 1px solid var(--glass-border); 
            background: var(--glass-white);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 30px; 
            overflow: hidden;
            position: relative;
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 15px 35px rgba(0,0,0,0.05);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card-product:hover {
            transform: translateY(-12px);
            box-shadow: 0 30px 60px rgba(0,0,0,0.1);
            border-color: var(--accent);
            background: rgba(255, 255, 255, 0.6);
        }

        .img-wrapper {
            width: 100%;
            aspect-ratio: 1/1;
            overflow: hidden;
            position: relative;
            background: #eee;
        }
        .img-wrapper img {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }
        .card-product:hover img { transform: scale(1.08); }

        .card-info {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-title { 
            font-weight: 700; font-size: 1.15rem; color: var(--text-main); 
            text-decoration: none !important; display: block; 
            letter-spacing: -0.3px; line-height: 1.2;
            margin-bottom: 6px;
        }
        .product-price { font-weight: 500; color: var(--accent); font-size: 1rem; }

        .btn-add-glass {
            position: absolute;
            top: 15px; right: 15px;
            width: 40px; height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid var(--glass-border);
            display: flex; align-items: center; justify-content: center;
            color: var(--text-main);
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            z-index: 10;
        }
        .btn-add-glass:hover {
            background: var(--accent);
            color: white;
            transform: scale(1.1);
        }

        .stock-badge {
            position: absolute; top: 15px; left: 15px;
            background: rgba(255, 59, 48, 0.9); color: white;
            padding: 4px 10px; border-radius: 10px; font-size: 0.6rem; font-weight: 800;
            backdrop-filter: blur(5px); z-index: 10;
        }

        footer { padding: 60px 0; margin-top: 50px; background: rgba(255,255,255,0.1); }
    </style>
</head>
<body>

<div class="orb orb-1"></div>
<div class="orb orb-2"></div>

<nav class="navbar navbar-expand-lg nav-olist sticky-top py-3">
    <div class="container">
        <a class="navbar-brand text-dark" href="{{ url('/') }}">olist.</a>
        
        <div class="search-container d-none d-lg-block mx-auto position-relative" style="width: 400px;">
            <form action="{{ url('/') }}" method="GET">
                <i class="fa-solid fa-magnifying-glass position-absolute" style="left:18px; top:50%; transform:translateY(-50%); color:var(--text-muted)"></i>
                <input type="text" name="search" class="form-control search-input" placeholder="Search curated items..." value="{{ request('search') }}">
            </form>
        </div>

        <div class="d-flex align-items-center gap-2">
            @auth
                <div class="dropdown">
                    <button class="btn border-0 fw-bold dropdown-toggle d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                        <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 0.8rem;">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        {{ explode(' ', Auth::user()->name)[0] }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 p-2 mt-3 rounded-4" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(15px); min-width: 200px;">
                        @if(Auth::user()->role === 'admin')
                            <li>
                                <a class="dropdown-item rounded-3 py-2 fw-bold text-primary" href="{{ url('admin') }}">
                                    <i class="fa-solid fa-chart-pie me-2"></i> Seller Hub
                                </a>
                            </li>
                        @else
                            <li>
                                <a class="dropdown-item rounded-3 py-2" href="{{ url('my-orders') }}">
                                    <i class="fa-solid fa-box-open me-2"></i> My Orders
                                </a>
                            </li>
                        @endif
                        <li><hr class="dropdown-divider opacity-50"></li>
                        <li>
                            <form action="{{ url('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger fw-bold rounded-3 py-2">
                                    <i class="fa-solid fa-right-from-bracket me-2"></i> Sign Out
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ url('login') }}" class="text-dark text-decoration-none small fw-bold">Sign In</a>
                <a href="{{ url('register') }}" class="btn btn-dark btn-sm rounded-pill px-4 ms-2">Join</a>
            @endauth
        </div>
    </div>
</nav>

<div class="container mt-4">
    <header class="hero-section text-center">
        <h1 class="hero-title">Beyond<br>essential.</h1>
        <p class="text-muted mt-3 fs-5">Curated objects for a refined lifestyle.</p>
    </header>

    <div class="row g-4 justify-content-center">
        @forelse($products as $p)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card-product">
                @if($p->product_stock_qty > 0 && $p->product_stock_qty <= 5)
                    <span class="stock-badge">Low Stock</span>
                @endif

                @auth
                    @if(Auth::user()->role !== 'admin')
                    <form action="{{ url('add-to-cart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $p->product_id }}">
                        <input type="hidden" name="price" value="{{ $p->price }}">
                        <button type="submit" class="btn-add-glass" {{ $p->product_stock_qty <= 0 ? 'disabled' : '' }}>
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </form>
                    @endif
                @else
                    <a href="{{ url('login') }}" class="btn-add-glass"><i class="fa-solid fa-plus"></i></a>
                @endauth

                <a href="{{ url('product/'.$p->product_id) }}" class="img-wrapper">
                    <img src="{{ $p->image_url }}" alt="Product Image" onerror="this.src='https://placehold.co/600x600/f5f5f7/cccccc?text=Product';">
                </a>

                <div class="card-info text-start">
                    <div>
                        <a href="{{ url('product/'.$p->product_id) }}" class="product-title">
                            {{ ucwords(str_replace('_', ' ', $p->product_category_name)) }}
                        </a>
                    </div>
                    <div class="product-price">Rp {{ number_format($p->price, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="fa-solid fa-box-open fs-1 text-muted opacity-25 mb-3"></i>
                <h4 class="fw-bold">No results found</h4>
                <p class="text-muted">Try a different search term.</p>
            </div>
        @endforelse
    </div>
</div>

<footer class="text-center">
    <div class="container">
        <div class="navbar-brand text-dark mb-2" style="font-size: 1.2rem;">olist.</div>
        <p class="text-muted small opacity-50">© 2026 OLIST. Curated with care.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>