<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with('items.product')
            ->firstOrCreate([
                'buyer_id' => auth()->id()
            ]);

        return view('buyer.cart.index', compact('cart'));
    }

    public function add(Product $product)
    {
        $cart = Cart::firstOrCreate([
            'buyer_id' => auth()->id()
        ]);

        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            $item->increment('quantity');
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect()
            ->route('buyer.cart.index')
            ->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function remove(CartItem $item)
    {
        $item->delete();

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}