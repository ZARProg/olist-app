<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran | OLIST</title>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" 
            data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
</head>
<body class="bg-light">
    <div class="container py-5 text-center">
        <div class="card shadow border-0 p-5 mx-auto" style="max-width: 500px; border-radius: 20px;">
            <h4 class="fw-bold mb-3">Satu Langkah Lagi!</h4>
            <p class="text-muted mb-4">Klik tombol di bawah untuk menyelesaikan pembayaran pesanan <strong>#{{ $orderId }}</strong></p>
            
            <button id="pay-button" class="btn btn-primary btn-lg w-100 rounded-pill shadow">
                BAYAR SEKARANG
            </button>
        </div>
    </div>

    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) { window.location.href = '/my-orders'; },
                onPending: function(result) { window.location.href = '/my-orders'; },
                onError: function(result) { alert("Pembayaran gagal!"); },
                onClose: function() { alert('Anda menutup popup tanpa membayar.'); }
            });
        });
    </script>
</body>
</html>