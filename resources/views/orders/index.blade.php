<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders — OLIST</title>
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
            --status-pending-bg: rgba(255, 159, 10, 0.15);
            --status-pending-text: #f5a623;
            --status-completed-bg: rgba(48, 209, 88, 0.15);
            --status-completed-text: #248a3d;
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
            filter: blur(100px); z-index: -1; opacity: 0.15;
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

        .page-title {
            font-weight: 800; font-size: 3.5rem; letter-spacing: -2.5px;
            margin-bottom: 40px;
        }

        /* Order Glass Card */
        .order-card { 
            background: var(--glass-white);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 30px; 
            overflow: hidden;
            margin-bottom: 25px;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .order-card:hover { 
            transform: translateY(-5px); 
            background: rgba(255, 255, 255, 0.55);
            box-shadow: 0 20px 40px rgba(0,0,0,0.06); 
        }

        .card-header-olist {
            background: rgba(255, 255, 255, 0.3);
            border-bottom: 1px solid var(--glass-border);
            padding: 20px 28px;
        }

        /* Status Badges */
        .status-badge { 
            border-radius: 12px; padding: 6px 14px; 
            font-size: 0.7rem; font-weight: 800; 
            text-transform: uppercase; letter-spacing: 0.05em;
        }
        .status-pending { background: var(--status-pending-bg); color: var(--status-pending-text); }
        .status-completed { background: var(--status-completed-bg); color: var(--status-completed-text); }
        .status-other { background: rgba(0,0,0,0.05); color: #666; }

        .info-label {
            font-size: 0.65rem; color: var(--text-muted);
            text-transform: uppercase; font-weight: 700;
            margin-bottom: 4px; letter-spacing: 0.05em;
        }

        .info-value { font-weight: 700; font-size: 1.05rem; color: var(--text-main); }

        .btn-detail {
            background: var(--text-main); color: white;
            border-radius: 15px; font-weight: 700; font-size: 0.85rem;
            padding: 12px 24px; transition: 0.3s;
            border: none; text-decoration: none; display: inline-block;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .btn-detail:hover {
            background: #000; transform: scale(1.05); color: white;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .empty-state {
            background: var(--glass-white);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 40px;
            padding: 80px 40px;
            margin-top: 40px;
        }

        .empty-state i {
            font-size: 80px;
            color: var(--accent);
            opacity: 0.2;
            margin-bottom: 24px;
        }
    </style>
</head>
<body>

<div class="orb orb-1"></div>
<div class="orb orb-2"></div>

<nav class="navbar nav-olist sticky-top py-3 mb-5">
    <div class="container">
        <a class="navbar-brand fw-extrabold text-dark" href="{{ url('/') }}" style="font-weight: 800; letter-spacing: -1.5px; font-size: 1.5rem;">olist.</a>
        <a href="{{ url('/') }}" class="btn rounded-pill px-4 fw-bold shadow-sm bg-white" style="border: 1px solid var(--glass-border); font-size: 0.9rem;">
            <i class="fa-solid fa-house me-2"></i> Back to Shop
        </a>
    </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h1 class="page-title text-center text-lg-start">Your Orders.</h1>

            @forelse($orders as $order)
                <div class="order-card">
                    <div class="card-header-olist d-flex justify-content-between align-items-center">
                        <div>
                            <span class="info-label">Reference Number</span>
                            <div class="text-primary fw-extrabold">#{{ $order->order_id }}</div>
                        </div>
                        <div>
                            @if($order->status == 'pending')
                                <span class="status-badge status-pending">Pending Payment</span>
                            @elseif($order->status == 'selesai')
                                <span class="status-badge status-completed">Delivered</span>
                            @else
                                <span class="status-badge status-other">{{ strtoupper($order->status) }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <div class="row align-items-center g-4">
                            <div class="col-md-3 col-6">
                                <div class="info-label">Order Date</div>
                                <div class="info-value">{{ date('d M Y', strtotime($order->created_at)) }}</div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="info-label">Total Amount</div>
                                <div class="info-value">IDR {{ number_format($order->gross_amount, 0, ',', '.') }}</div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="info-label">Shipping To</div>
                                <div class="info-value text-truncate small" style="max-width: 250px;">
                                    {{ Str::limit($order->shipping_address, 45) }}
                                </div>
                            </div>
                            <div class="col-md-2 col-12 text-md-end">
                                <a href="{{ url('/my-orders/'.$order->order_id) }}" class="btn-detail w-100 text-center">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center empty-state">
                    <i class="fa-solid fa-box-open"></i>
                    <h2 class="fw-extrabold mb-3">No orders yet.</h2>
                    <p class="text-muted fs-5 mb-4">When you purchase something, it will appear here.</p>
                    <a href="{{ url('/') }}" class="btn btn-dark rounded-pill px-5 py-3 fw-bold">Explore Collection</a>
                </div>
            @endforelse
        </div>
    </div>
</div>

<footer class="text-center py-5 mt-5">
    <p class="text-muted small opacity-50">© 2026 OLIST Reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>