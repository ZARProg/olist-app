<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout — OLIST</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <style>
        :root { --bg-body: #ffffff; --bg-card: #f5f5f7; --text-main: #1d1d1f; --text-muted: #86868b; --accent: #0066cc; }
        body { background-color: var(--bg-body); font-family: 'Plus Jakarta Sans', sans-serif; color: var(--text-main); letter-spacing: -0.02em; }
        .checkout-container { padding-top: 60px; padding-bottom: 100px; }
        .section-title { font-weight: 700; font-size: 2rem; margin-bottom: 30px; }
        .form-card { background: #fff; border-radius: 24px; padding: 40px; border: 1px solid #f2f2f2; box-shadow: 0 4px 24px rgba(0,0,0,0.02); }
        .form-label { font-weight: 600; font-size: 0.9rem; color: var(--text-main); }
        .form-control { border-radius: 12px; padding: 12px 15px; border: 1px solid #d2d2d7; background: #fafafa; }
        .form-control:focus { border-color: var(--accent); box-shadow: none; background: #fff; }
        
        #map { height: 350px; border-radius: 18px; margin-bottom: 20px; border: 1px solid #d2d2d7; }
        
        .order-summary-card { background: var(--bg-card); border-radius: 24px; padding: 30px; position: sticky; top: 100px; }
        .summary-item { display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 0.95rem; }
        .total-row { border-top: 1px solid #d2d2d7; padding-top: 20px; margin-top: 20px; font-weight: 700; font-size: 1.3rem; }
        
        .btn-place-order { background: var(--text-main); color: white; border: none; border-radius: 16px; padding: 18px; font-weight: 600; width: 100%; transition: 0.3s; margin-top: 20px; }
        .btn-place-order:hover { background: #000; transform: translateY(-2px); }
        
        .product-mini-list { max-height: 200px; overflow-y: auto; margin-bottom: 20px; }
        .mini-item { display: flex; gap: 15px; align-items: center; margin-bottom: 15px; }
        .mini-img { width: 50px; height: 50px; background: #fff; border-radius: 10px; padding: 5px; object-fit: contain; }
    </style>
</head>
<body>

<nav class="navbar navbar-light bg-white py-3 sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">olist<span class="text-primary">.</span></a>
        <a href="{{ url('/cart') }}" class="text-dark text-decoration-none fw-600"><i class="fa-solid fa-chevron-left me-2"></i>Back to Bag</a>
    </div>
</nav>

<div class="container checkout-container">
    <form action="{{ url('/place-order') }}" method="POST" id="checkoutForm">
        @csrf
        <div class="row g-5">
            <div class="col-lg-7">
                <h2 class="section-title">Where should we send it?</h2>
                
                <div class="form-card">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control" placeholder="John" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control" placeholder="Doe" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Street Address</label>
                            <input type="text" name="address" id="addressInput" class="form-control" placeholder="House number and street name" required>
                        </div>
                        
                        <div class="col-12 mt-4">
                            <label class="form-label">Pin your location</label>
                            <div id="map"></div>
                            <small class="text-muted">Click on the map to set your exact delivery point.</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">City</label>
                            <input type="text" name="city" id="cityInput" class="form-control" placeholder="e.g. Jakarta" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Zip Code</label>
                            <input type="text" name="zip" class="form-control" placeholder="12345" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="order-summary-card">
                    <h4 class="fw-bold mb-4">Order Summary</h4>
                    
                    <div class="product-mini-list">
                        @php $total = 0; @endphp
                        @foreach($cartItems as $item)
                            @php $total += ($item->price * $item->quantity); @endphp
                            <div class="mini-item">
                                <img src="{{ $item->image_url }}" class="mini-img">
                                <div class="flex-grow-1">
                                    <div class="fw-bold small">{{ $item->product_category_name }}</div>
                                    <div class="text-muted small">Qty: {{ $item->quantity }}</div>
                                </div>
                                <div class="small fw-600">IDR {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</div>
                            </div>
                        @endforeach
                    </div>

                    <div class="summary-item">
                        <span class="text-muted">Subtotal</span>
                        <span>IDR {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="summary-item">
                        <span class="text-muted">Shipping</span>
                        <span class="text-success fw-bold">FREE</span>
                    </div>
                    
                    <div class="total-row d-flex justify-content-between">
                        <span>Total</span>
                        <span>IDR {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <button type="submit" class="btn-place-order">
                        Complete Purchase
                    </button>
                    
                    <div class="text-center mt-3">
                        <small class="text-muted"><i class="fa-solid fa-lock me-1"></i> Secure Checkout</small>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    // Inisialisasi Peta (Default ke Jakarta)
    var map = L.map('map').setView([-6.200000, 106.816666], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var marker;

    // Fungsi saat peta diklik
    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        if (marker) {
            marker.setLatLng(e.latlng);
        } else {
            marker = L.marker(e.latlng).addTo(map);
        }

        // Reverse Geocoding Sederhana (Mendapatkan Nama Tempat)
        fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
            .then(response => response.json())
            .then(data => {
                var addr = data.address;
                var displayAddr = data.display_name;
                
                // Isi field form otomatis
                document.getElementById('addressInput').value = displayAddr;
                document.getElementById('cityInput').value = addr.city || addr.town || addr.municipality || '';
            });
    });
</script>
</body>
</html>