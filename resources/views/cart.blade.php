<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bag — OLIST</title>
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
            --danger: #ff3b30;
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

        /* Header Section */
        .cart-header { padding: 50px 0 30px; }
        .cart-title { font-weight: 800; font-size: 3.5rem; letter-spacing: -2px; }

        /* Cart Item Glass Card */
        .cart-item { 
            background: var(--glass-white);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 35px;
            padding: 25px;
            margin-bottom: 20px;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .cart-item:hover { 
            transform: translateY(-5px); 
            background: rgba(255, 255, 255, 0.55);
            box-shadow: 0 20px 40px rgba(0,0,0,0.05); 
        }

        .product-thumb { 
            background: rgba(255, 255, 255, 0.5); 
            border-radius: 24px; 
            width: 100%;
            aspect-ratio: 1/1;
            display: flex; align-items: center; justify-content: center; 
            overflow: hidden; 
            border: 1px solid var(--glass-border);
        }
        .product-thumb img { width: 80%; height: 80%; object-fit: contain; mix-blend-mode: multiply; }

        .item-name { font-weight: 700; font-size: 1.3rem; color: var(--text-main); text-decoration: none; }
        .item-price { color: var(--text-muted); font-size: 0.95rem; font-weight: 500; }

        /* Modern Glass Qty Controls */
        .qty-wrapper { 
            display: inline-flex; 
            align-items: center; 
            background: rgba(255, 255, 255, 0.5); 
            border-radius: 15px; 
            padding: 5px;
            border: 1px solid var(--glass-border);
        }
        .qty-btn { 
            border: none; background: white; 
            width: 32px; height: 32px; border-radius: 12px; 
            display: flex; align-items: center; justify-content: center; 
            color: var(--text-main); font-size: 0.8rem;
            transition: 0.2s; box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .qty-btn:hover { background: var(--text-main); color: white; }
        .qty-input { width: 40px; border: none; background: transparent; text-align: center; font-weight: 700; }

        /* Summary Sidebar Glass */
        .summary-box { 
            background: var(--glass-white);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border: 1px solid var(--glass-border);
            padding: 40px; 
            border-radius: 40px; 
            position: sticky; top: 110px; 
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
        }
        .summary-row { display: flex; justify-content: space-between; margin-bottom: 20px; font-weight: 500; }
        .summary-total { border-top: 1px solid rgba(0,0,0,0.08); padding-top: 25px; margin-top: 25px; font-weight: 800; font-size: 1.6rem; letter-spacing: -1px; }

        /* Action Buttons */
        .btn-checkout { 
            background: var(--text-main); color: white; 
            border: none; border-radius: 20px; 
            padding: 20px; font-weight: 700; font-size: 1.1rem; 
            width: 100%; transition: all 0.3s; 
            display: block; text-decoration: none; text-align: center;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .btn-checkout:hover { 
            background: #000; transform: translateY(-3px); 
            box-shadow: 0 15px 30px rgba(0,0,0,0.2); color: white;
        }
        .btn-checkout.disabled { background: #d2d2d7; color: #86868b; transform: none; box-shadow: none; cursor: not-allowed; }

        .btn-remove { 
            color: var(--danger); font-size: 0.85rem; 
            text-decoration: none; font-weight: 700; 
            background: rgba(255, 59, 48, 0.1); border: none; 
            padding: 6px 15px; border-radius: 10px; transition: 0.3s;
        }
        .btn-remove:hover { background: var(--danger); color: white; }

        .empty-state {
            background: var(--glass-white);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 40px;
            padding: 80px 40px;
        }
    </style>
</head>
<body>

<div class="orb orb-1"></div>
<div class="orb orb-2"></div>

<nav class="navbar nav-olist sticky-top py-3">
    <div class="container">
        <a class="navbar-brand fw-extrabold text-dark" href="{{ url('/') }}" style="font-weight: 800; letter-spacing: -1.5px; font-size: 1.5rem;">olist.</a>
        <a href="{{ url('/') }}" class="btn rounded-pill px-4 fw-bold shadow-sm bg-white" style="border: 1px solid var(--glass-border); font-size: 0.9rem;">
            <i class="fa-solid fa-arrow-left me-2"></i> Continue Shopping
        </a>
    </div>
</nav>

<div class="container pb-5">
    <div class="cart-header">
        <h1 class="cart-title">Your Bag.</h1>
        <p class="fs-5 text-muted fw-medium">Review your items and checkout when you're ready.</p>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            @php $total = 0; @endphp
            @forelse($cartItems as $item)
            @php $total += ($item->price * $item->quantity); @endphp
            <div class="cart-item">
                <div class="row align-items-center g-4">
                    <div class="col-4 col-md-3">
                        <div class="product-thumb">
                            <img src="{{ $item->image_url ?? 'https://placehold.co/400x400/f5f5f7/cccccc?text=Product' }}" alt="Product">
                        </div>
                    </div>
                    <div class="col-8 col-md-9">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h3 class="item-name mb-1">{{ ucwords(str_replace('_', ' ', $item->product_category_name)) }}</h3>
                                <div class="item-price">IDR {{ number_format($item->price, 0, ',', '.') }}</div>
                            </div>
                            <div class="text-end d-none d-md-block">
                                <div class="fw-extrabold fs-5">IDR {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</div>
                            </div>
                        </div>

                        <div class="mt-4 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <form action="{{ url('cart/update/'.$item->id) }}" method="POST" class="d-flex align-items-center">
                                    @csrf
                                    <div class="qty-wrapper">
                                        <button type="button" class="qty-btn" onclick="this.nextElementSibling.stepDown(); this.closest('form').submit();">
                                            <i class="fa-solid fa-minus"></i>
                                        </button>
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="qty-input" readonly>
                                        <button type="button" class="qty-btn" onclick="this.previousElementSibling.stepUp(); this.closest('form').submit();">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                    </div>
                                </form>

                                <form action="{{ url('cart/remove/'.$item->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-remove">
                                        <i class="fa-regular fa-trash-can me-1"></i> Remove
                                    </button>
                                </form>
                            </div>
                            <div class="fw-bold d-md-none">IDR {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-state text-center">
                <div class="mb-4 opacity-25 text-primary"><i class="fa-solid fa-bag-shopping fa-5x"></i></div>
                <h2 class="fw-extrabold mb-3">Your bag is empty.</h2>
                <p class="text-muted mb-4 px-lg-5">Looks like you haven't made your choice yet. Explore our latest collections and find something you love.</p>
                <a href="{{ url('/') }}" class="btn btn-dark rounded-pill px-5 py-3 fw-bold">Start Shopping</a>
            </div>
            @endforelse
        </div>

        <div class="col-lg-4">
            <div class="summary-box">
                <h4 class="fw-extrabold mb-4" style="letter-spacing: -1px;">Summary</h4>
                <div class="summary-row">
                    <span class="text-muted">Subtotal</span>
                    <span class="fw-bold">IDR {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="summary-row">
                    <span class="text-muted">Shipping</span>
                    <span class="text-success fw-bold text-uppercase small">Free</span>
                </div>
                <div class="summary-row">
                    <span class="text-muted">Estimated Tax</span>
                    <span class="text-muted">IDR 0</span>
                </div>
                
                <div class="summary-total">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Total</span>
                        <span>IDR {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <a href="{{ url('/shipping-address') }}" class="btn-checkout mt-4 {{ $total == 0 ? 'disabled' : '' }}">
                    Check Out
                </a>

                <div class="mt-4 p-3 rounded-4" style="background: rgba(255,255,255,0.3); border: 1px solid var(--glass-border);">
                    <div class="d-flex gap-3 align-items-center">
                        <i class="fa-solid fa-shield-check text-primary fs-4"></i>
                        <div class="small text-muted">Secure checkout with SSL encryption.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="text-center py-5 mt-4">
    <p class="text-muted small opacity-50">© 2026 OLIST Reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>