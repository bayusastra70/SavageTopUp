@extends('admin.layout')
@section('content')
<div class="container mt-5">
    <h1>Product List</h1>
    <div class="mb-3">
        <!-- Button Create Product -->
        <a href="{{ route('products.create') }}" class="btn btn-primary">Create Product</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->name }}</td>
        <td>Rp{{ number_format($product->price, 2) }}</td>
        <td>{{ $product->quantity }}</td>
        <td>
            @if ($product->image_path)
                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" width="50">
            @else
                <span class="text-muted">No image</span>
            @endif
        </td>
        <td>
            {{-- <!-- View Button -->
            <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">View</a>

            <!-- Edit Button -->
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a> --}}

            <!-- Delete Button -->
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center">No products available.</td>
    </tr>
@endforelse
        </tbody>
    </table>
</div>

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Deleted!',
            text: '{{ session('success') }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif

@endsection



