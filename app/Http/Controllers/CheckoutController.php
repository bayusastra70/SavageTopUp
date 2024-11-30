<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CheckoutController extends Controller
{
    // Menampilkan halaman checkout
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('general.checkout.pembayaran', compact('cartItems', 'totalPrice'));
    }

    // Proses checkout
    public function processCheckout(Request $request)
    {
        // Validasi input
        $request->validate([
            'payment_method' => 'required|string',
        ]);

        $cartItems = Cart::where('user_id', Auth::id())->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('checkout')->with('error', 'Keranjang Anda kosong.');
        }

        // Simpan informasi pesanan di database atau lakukan proses pembayaran (disesuaikan dengan kebutuhan)
        // Setelah transaksi berhasil, hapus item di keranjang
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('checkout')->with('success', 'Pembayaran berhasil. Terima kasih!');
    }
}
