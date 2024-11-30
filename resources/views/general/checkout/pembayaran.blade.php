<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Savage Top Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .navbar-brand i {
            color: #FFD700;
        }
        .navbar-brand span {
            font-weight: bold;
            font-size: 1.6rem;
            color: #FFD700;
        }
        .checkout-table th {
            background-color: #f8f9fa;
        }
        .checkout-table tbody tr {
            border-bottom: 1px solid #ddd;
        }
        .checkout-summary {
            border-top: 2px solid #ddd;
            padding-top: 10px;
            margin-top: 20px;
        }
        .btn-custom {
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            font-weight: bold;
        }
        .btn-custom:hover {
            background-color: #218838;
            color: white;
        }
        .alert {
            border-radius: 5px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <i class="fas fa-gem fa-2x" style="margin-right: 10px;"></i>
            <span>Savage Top Up</span>
        </a>
        <div class="collapse navbar-collapse" id="navbarNavAuth">
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <form method="GET" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-warning" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-success" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="mb-4">Halaman Checkout</h1>

    @if(session('success'))
        <div class="alert alert-success" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif

    <h3 class="mb-4">Detail Pesanan</h3>
    <table class="table table-striped checkout-table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Kuantitas</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cartItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>Rp{{ number_format($item->product->price, 2, ',', '.') }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp{{ number_format($item->product->price * $item->quantity, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="checkout-summary">
        <div class="d-flex justify-content-between">
            <h4 class="mb-0">Total Harga:</h4>
            <h4 class="mb-0">Rp{{ number_format($totalPrice, 2, ',', '.') }}</h4>
        </div>
    </div>

    <form action="{{ route('checkout.process') }}" method="POST" class="mt-4">
        @csrf
        <div class="mb-3">
            <label for="payment_method" class="form-label">Metode Pembayaran</label>
            <select name="payment_method" id="payment_method" class="form-select" required>
                <option value="">Pilih metode pembayaran</option>
                <option value="credit_card">Kartu Kredit</option>
                <option value="bank_transfer">Transfer Bank</option>
                <option value="paypal">PayPal</option>
            </select>
        </div>
        <button type="submit" class="btn btn-custom w-100">Proses Pembayaran</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.0.0/js/all.min.js"></script>
</body>
</html>
