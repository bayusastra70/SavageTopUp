<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('general.cart.cart', compact('cartItems'));
    }

    public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        // Validasi stok
        if ($request->quantity > $product->quantity) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi.');
        }

        // Cek apakah produk sudah ada di keranjang
        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            // Update kuantitas
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            // Tambahkan produk baru ke keranjang
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => $request->quantity,
            ]);
        }

        // Kurangi stok produk
        $product->quantity -= $request->quantity;
        $product->save();

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function removeFromCart($id)
    {
        $cartItem = Cart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $product = $cartItem->product;

        // Kembalikan stok produk
        $product->quantity += $cartItem->quantity;
        $product->save();

        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    // public function showCart()
    // {
    //     // Menghitung jumlah barang di keranjang
    //     $cartItemCount = Cart::count(); // Sesuaikan jika menggunakan package berbeda atau cara lain

    //     return view('cart.index', compact('cartItemCount'));
    // }
}
