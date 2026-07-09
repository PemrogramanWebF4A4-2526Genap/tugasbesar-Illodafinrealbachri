<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function create()
    {
        $cart = Cart::with('items.product')
            ->where('buyer_id', auth()->id())
            ->first();

        if (!$cart || $cart->items->count() === 0) {
            return redirect()->route('buyer.cart.index')->with('success', 'Keranjang masih kosong.');
        }

        return view('buyer.checkout.create', compact('cart'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|min:10',
        ]);

        $cart = Cart::with('items.product')
            ->where('buyer_id', auth()->id())
            ->firstOrFail();

        if ($cart->items->count() === 0) {
            return redirect()->route('buyer.cart.index')->with('success', 'Keranjang masih kosong.');
        }

        foreach ($cart->items as $item) {
            if ($item->quantity > $item->product->stock) {
                return redirect()->route('buyer.cart.index')
                    ->with('success', 'Stok produk ' . $item->product->name . ' tidak cukup.');
            }
        }

        DB::transaction(function () use ($cart, $request) {
            $total = 0;

            foreach ($cart->items as $item) {
                $total += $item->product->price * $item->quantity;
            }

            $order = Order::create([
                'buyer_id' => auth()->id(),
                'total_amount' => $total,
                'shipping_address' => $request->shipping_address,
                'payment_status' => 'unpaid',
                'status' => 'pending',
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);

                $item->product->decrement('stock', $item->quantity);
            }

            $cart->items()->delete();
        });

        return redirect()->route('buyer.orders.index')
            ->with('success', 'Checkout berhasil. Silakan upload bukti pembayaran.');
    }
}