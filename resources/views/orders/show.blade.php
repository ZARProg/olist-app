<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->order_id }} | Olist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <style>
        :root {
            --apple-gray: #f5f5f7;
            --apple-blue: #0066cc;
        }

        body { 
            background-color: #fbfbfb; 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            color: #1d1d1f;
        }

        .invoice-wrapper {
            max-width: 850px;
            margin: 50px auto;
        }

        .invoice-card {
            border: none;
            border-radius: 32px;
            background: white;
            box-shadow: 0 20px 60px rgba(0,0,0,0.03);
            overflow: hidden;
        }

        .invoice-header {
            padding: 60px 60px 40px;
        }

        .invoice-body {
            padding: 0 60px 40px;
        }

        .status-badge {
            border-radius: 12px;
            padding: 8px 16px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .status-pending { background: #fff4e5; color: #b7791f; }
        .status-selesai { background: #e6f4ea; color: #1e7e34; }

        .label-muted {
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 600;
            color: #86868b;
            margin-bottom: 8px;
            display: block;
        }

        .product-row {
            padding: 20px 0;
            border-bottom: 1px solid #f2f2f2;
        }

        .product-img {
            width: 70px;
            height: 70px;
            border-radius: 16px;
            object-fit: cover;
            background: var(--apple-gray);
        }

        .total-section {
            background: #fafafa;
            padding: 40px 60px;
            border-top: 1px solid #f2f2f2;
        }

        .btn-print {
            background: #1d1d1f;
            color: white;
            border-radius: 14px;
            padding: 12px 24px;
            font-weight: 600;
            border: none;
            transition: 0.3s;
        }

        .btn-print:hover {
            background: #000;
            transform: scale(1.02);
            color: white;
        }

        @media print {
            .no-print { display: none !important; }
            body { background: white; }
            .invoice-wrapper { margin: 0; width: 100%; max-width: 100%; }
            .invoice-card { box-shadow: none; border: 1px solid #eee; }
        }
    </style>
</head>
<body>

<div class="container invoice-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4 no-print px-3">
        <a href="{{ url('/my-orders') }}" class="text-decoration-none text-dark fw-bold">
            <i class="fa-solid fa-chevron-left me-2"></i> My Orders
        </a>
        <button onclick="window.print()" class="btn btn-print">
            <i class="fa-solid fa-print me-2"></i> Save as PDF
        </button>
    </div>

    <div class="card invoice-card">
        <div class="invoice-header d-flex justify-content-between align-items-start">
            <div>
                <h2 class="fw-bold mb-1">olist<span class="text-primary">.</span></h2>
                <p class="text-muted small">Electronic Transaction Receipt</p>
                <div class="mt-4">
                    <span class="label-muted">Order ID</span>
                    <h5 class="fw-bold">#{{ $order->order_id }}</h5>
                </div>
            </div>
            <div class="text-end">
                <span class="status-badge status-{{ $order->status }}">
                    {{ $order->status }}
                </span>
                <div class="mt-4">
                    <span class="label-muted">Date</span>
                    <h5 class="fw-bold">{{ date('d M Y, H:i', strtotime($order->created_at)) }}</h5>
                </div>
            </div>
        </div>

        <div class="invoice-body">
            <div class="row mb-5">
                <div class="col-md-6">
                    <span class="label-muted">Billed To</span>
                    <p class="fw-semibold mb-0">{{ Auth::user()->name }}</p>
                    <p class="text-muted small">{{ Auth::user()->email }}</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <span class="label-muted">Shipping Address</span>
                    <p class="fw-semibold small" style="line-height: 1.6;">{{ $order->shipping_address }}</p>
                </div>
            </div>

            <h6 class="fw-bold mb-4">Order Summary</h6>
            @foreach($items as $item)
            <div class="product-row d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img src="{{ $item->image_url }}" class="product-img me-3">
                    <div>
                        <div class="fw-bold">{{ str_replace('_', ' ', $item->product_category_name) }}</div>
                        <div class="text-muted small">Quantity: 1</div>
                    </div>
                </div>
                <div class="fw-bold text-end">
                    Rp {{ number_format($item->price, 0, ',', '.') }}
                </div>
            </div>
            @endforeach
        </div>

        <div class="total-section">
            <div class="row justify-content-end">
                <div class="col-md-5">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small fw-bold">SUBTOTAL</span>
                        <span class="fw-bold">Rp {{ number_format($order->gross_amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted small fw-bold">TAX (0%)</span>
                        <span class="fw-bold">Rp 0</span>
                    </div>
                    <div class="d-flex justify-content-between border-top pt-3">
                        <span class="fw-bold fs-5">TOTAL</span>
                        <span class="fw-bold fs-5 text-primary">Rp {{ number_format($order->gross_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            
            <div class="mt-5 pt-4 text-center border-top">
                <p class="text-muted small mb-0">If you have any questions regarding this receipt, please contact support@olist.com</p>
                <p class="fw-bold small text-primary mt-2">Thank you for your business!</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>