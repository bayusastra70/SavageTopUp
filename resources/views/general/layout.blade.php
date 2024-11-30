<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Savage top up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        .product-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .product-card:hover {
            transform: translateY(-5px);
        }
        .product-image {
            border-bottom: 1px solid #ddd;
        }
        .product-title {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .product-price {
            color: #28a745;
            font-size: 1.125rem;
            font-weight: bold;
        }
        .quantity-control {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .pagination .page-link {
    color: #007bff; /* Warna teks */
    border: none;
    font-weight: bold;
    transition: all 0.3s ease-in-out;
}

.pagination .page-link:hover {
    color: white;
    background-color: #007bff;
}

.pagination .active .page-link {
    color: white;
    background-color: #007bff;
    border-radius: 5px;
}

.pagination .disabled .page-link {
    color: #6c757d;
    cursor: not-allowed;
}

    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <!-- Tambahkan Logo dan Brand -->
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <i class="fas fa-gem fa-2x" style="margin-right: 10px;"></i> <!-- Menambahkan jarak -->
                <span style="font-weight: bold; font-size: 1.5rem; color: #FFD700;">Savage Top Up</span>
            </a>


            <!-- Tombol Toggle Navbar (Mobile View) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navigasi -->
<div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a class="nav-link text-light" href="#produk">Produk</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href="#harga-promo">Paket Murah Meriah</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href="#paket-murah">Tentang Kami</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href="#paket-jagoan">FAQ</a>
        </li>
    </ul>
</div>

<!-- Navigasi Authentication dan Ikon -->
<div class="collapse navbar-collapse d-flex justify-content-between align-items-center" id="navbarNavAuth">
    <!-- Navigasi Authentication -->
    <ul class="navbar-nav ms-auto d-flex align-items-center">
        @auth
            <li class="nav-item">
                <form method="GET" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm ms-3">Logout</button>
                </form>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link text-warning ms-3" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-success ms-3" href="{{ route('register') }}">Register</a>
            </li>
        @endauth
    </ul>

    <!-- Profil dan Keranjang -->
    <ul class="navbar-nav d-flex align-items-center ms-4">
        <!-- Icon Profil -->
        <li class="nav-item me-4">
            <a class="nav-link" href="#">
                <i class="fas fa-user-circle fa-2x text-white"></i>
            </a>
        </li>

        <!-- Icon Keranjang -->
        <li class="nav-item position-relative">
            <a href="{{ route('cart.index') }}" class="nav-link">
                <i class="fas fa-shopping-cart fa-2x text-white"></i>
                @if(isset($cartItemCount) && $cartItemCount > 0)
                    <span class="badge bg-danger position-absolute" style="top: 0; right: 0; transform: translate(50%, -50%);">
                        {{ $cartItemCount }}
                    </span>
                @endif
            </a>
        </li>
    </ul>
</div>

        </div>
    </nav>

    <header class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1>Selamat Datang di Savage Top Up</h1>
            <p class="lead">Tempat terbaik untuk membeli diamond Mobile legends dengan harga terbaik!</p>
        </div>
    </header>
  @include('general.halamanproduk.halamanproduk')

    <section id="paket-murah" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Paket Murah Meriah</h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5>Paket 10 Diamond</h5>
                            <p>Harga: Rp 10,000</p>
                            <button class="btn btn-primary">Beli Sekarang</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5>Paket 50 Diamond</h5>
                            <p>Harga: Rp 45,000</p>
                            <button class="btn btn-primary">Beli Sekarang</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5>Paket 100 Diamond</h5>
                            <p>Harga: Rp 85,000</p>
                            <button class="btn btn-primary">Beli Sekarang</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5>Paket 200 Diamond</h5>
                            <p>Harga: Rp 160,000</p>
                            <button class="btn btn-primary">Beli Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; {{ date('Y') }} Jual Beli Diamond. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

</body>
</html>
