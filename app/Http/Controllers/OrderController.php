<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.product')
            ->where('buyer_id', auth()->id())
            ->latest()
            ->get();

        return view('buyer.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        abort_if($order->buyer_id !== auth()->id(), 403, 'Akses ditolak.');

        $order->load('items.product');

        return view('buyer.orders.show', compact('order'));
    }
}