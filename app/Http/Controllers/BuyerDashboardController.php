<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Cart;

class BuyerDashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();

        $totalOrders = Order::where('buyer_id', auth()->id())->count();

        $latestOrders = Order::where('buyer_id', auth()->id())
            ->latest()
            ->take(3)
            ->get();

        $cart = Cart::with('items')
            ->where('buyer_id', auth()->id())
            ->first();

        $cartItems = $cart ? $cart->items->count() : 0;

        return view('buyer.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'latestOrders',
            'cartItems'
        ));
    }
}