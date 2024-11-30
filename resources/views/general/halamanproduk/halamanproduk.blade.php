<div class="container my-5">
    <h2 class="mb-4 text-center">Produk Kami</h2>
    <div class="row g-4">
        @foreach ($products as $product)
            <div class="col-md-4">
                <div class="product-card border rounded p-2 text-center">
                    <div class="product-image mb-2">
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="Gambar Produk {{ $product->name }}" class="img-fluid" style="max-width: 100%; height: 200px; object-fit: cover;">
                    </div>
                    <h5 class="product-title mb-2">{{ $product->name }}</h5>
                    <p class="product-price mb-3">Rp {{ number_format($product->price, 2, ',', '.') }}</p>
                    <div class="product-actions">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mb-2">
                            @csrf
                            <input type="number" name="quantity" min="1" max="{{ $product->quantity }}" required>
                            <button type="submit" class="btn btn-primary w-100">Tambahkan ke Keranjang</button>
                        </form>

                        <button class="btn btn-success w-100">
                            <i class="fas fa-credit-card"></i> Beli Sekarang
                        </button>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-4">
        <ul class="pagination">
            @if ($products->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">
                        <i class="fas fa-angle-left"></i> Sebelumnya
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $products->previousPageUrl() }}" aria-label="Previous">
                        <i class="fas fa-angle-left"></i> Sebelumnya
                    </a>
                </li>
            @endif

            @foreach ($products->links()->elements[0] as $page => $url)
                <li class="page-item {{ $products->currentPage() == $page ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            @if ($products->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $products->nextPageUrl() }}" aria-label="Next">
                        Berikutnya <i class="fas fa-angle-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">
                        Berikutnya <i class="fas fa-angle-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </div>

</div>
