<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Savage Top Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        .content {
            margin-top: 20px; /* Memberikan jarak antara navbar dan konten */
        }
        .product-img {
            max-width: 50px; /* Batasan ukuran gambar */
            max-height: 50px;
            object-fit: cover; /* Menyesuaikan proporsi gambar */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <!-- Tambahkan Logo dan Brand -->
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <i class="fas fa-gem fa-2x" style="margin-right: 10px;"></i>
                <span style="font-weight: bold; font-size: 1.5rem; color: #FFD700;">Savage Top Up</span>
            </a>

            <!-- Tombol Toggle Navbar (Mobile View) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAuth" aria-controls="navbarNavAuth" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigasi Authentication -->
            <div class="collapse navbar-collapse" id="navbarNavAuth">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
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

    <div class="container content">
        <h1 class="mb-4">Keranjang Belanja</h1>

        <!-- Notifikasi -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Tabel Keranjang -->
        <table class="table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Kuantitas</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cartItems as $item)
                    <tr>
                        <td>
                            @if(file_exists(public_path('storage/' . $item->product->image_path)))
                                <img src="{{ asset('storage/' . $item->product->image_path) }}" alt="{{ $item->product->name }}" class="product-img">
                            @else
                                <img src="{{ asset('images/no-image.png') }}" alt="No Image" class="product-img">
                            @endif
                        </td>
                        <td>{{ $item->product->name }}</td>
                        <td>Rp{{ number_format($item->product->price, 2, ',', '.') }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp{{ number_format($item->product->price * $item->quantity, 2, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Keranjang Anda kosong.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Hitung total harga -->
@if($cartItems->isNotEmpty())
@php
    $totalPrice = $cartItems->sum(function ($item) {
        return $item->product->price * $item->quantity;
    });
@endphp

<div class="d-flex justify-content-between mt-3">
    <h4>Total Harga:</h4>
    <h4>Rp{{ number_format($totalPrice, 2, ',', '.') }}</h4>
</div>

<!-- Tombol Checkout -->
<div class="d-flex justify-content-end mt-2">
    <a href="{{ route('checkout') }}" class="btn btn-success">Checkout</a>
</div>
@endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</body>
</html>
