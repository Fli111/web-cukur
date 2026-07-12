<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr. Hartono - Payment</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .payment-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0a0a0a;
            flex-direction: column;
            gap: 20px;
        }
        .payment-box {
            background: #1a1a1a;
            border: 1px solid #c9a84c;
            border-radius: 12px;
            padding: 40px;
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        .payment-box h2 {
            color: #c9a84c;
            margin-bottom: 10px;
            font-size: 22px;
            letter-spacing: 2px;
        }
        .payment-box p {
            color: #aaa;
            margin-bottom: 6px;
            font-size: 14px;
        }
        .total-amount {
            color: #fff;
            font-size: 28px;
            font-weight: bold;
            margin: 20px 0;
        }
        .btn-pay {
            background: #c9a84c;
            color: #000;
            border: none;
            padding: 14px 32px;
            font-size: 15px;
            font-weight: bold;
            letter-spacing: 2px;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            transition: background 0.2s;
        }
        .btn-pay:hover { background: #e0bf6a; }
        .btn-back {
            color: #666;
            text-decoration: none;
            font-size: 13px;
            margin-top: 10px;
            display: inline-block;
        }
        .btn-back:hover { color: #aaa; }
        .order-id {
            font-size: 12px;
            color: #555;
            margin-top: 16px;
        }
    </style>
</head>
<body>
    <div class="payment-wrapper">
        <div class="payment-box">
            <h2>SELESAIKAN PEMBAYARAN</h2>
            <p>Order ID: <strong style="color:#c9a84c;">{{ $orderId }}</strong></p>
            <div class="total-amount">
                Rp {{ number_format($total, 0, ',', '.') }}
            </div>
            <p style="margin-bottom:24px;">Klik tombol di bawah untuk memilih metode pembayaran</p>

            <button id="btn-pay" class="btn-pay">BAYAR SEKARANG</button>
            <br>
            <a href="/ecommerceCartPage" class="btn-back">← Kembali ke Keranjang</a>
        </div>
    </div>

    {{-- Midtrans Snap JS --}}
    @if(env('MIDTRANS_IS_PRODUCTION'))
        <script src="https://app.midtrans.com/snap/snap.js"
                data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    @else
        <script src="https://app.sandbox.midtrans.com/snap/snap.js"
                data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    @endif

    <script>
        // Auto buka popup langsung saat halaman dimuat
        window.addEventListener('load', function() {
            bukaSnap();
        });

        function bukaSnap() {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    window.location.href = "{{ route('ecommerceCheckoutFinish') }}??transaction_status=" + result.transaction_status + "&order_id=" + result.order_id;
                },
                onPending: function(result) {
                    window.location.href = "{{ route('ecommerceCheckoutFinish') }}?transaction_status=pending&order_id=" + result.order_id;
                },
                onError: function(result) {
                    alert('Pembayaran gagal. Silakan coba lagi.');
                },
                onClose: function() {
                    // User tutup popup, biarkan di halaman ini
                }
            });
        }

        // Tombol untuk buka ulang popup kalau user sempat menutupnya
        document.getElementById('btn-pay').addEventListener('click', bukaSnap);
    </script>
</body>
</html>