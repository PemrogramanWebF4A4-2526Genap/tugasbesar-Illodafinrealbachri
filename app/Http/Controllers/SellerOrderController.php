<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class SellerOrderController extends Controller
{
    public function index()
    {
        $sellerId = auth()->id();

        $orderIds = OrderItem::whereHas('product', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->pluck('order_id')->unique();

        $orders = Order::with('buyer')
            ->whereIn('id', $orderIds)
            ->latest()
            ->get();

        return view('seller.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $sellerId = auth()->id();

        $items = $order->items()
            ->with('product')
            ->whereHas('product', function ($query) use ($sellerId) {
                $query->where('seller_id', $sellerId);
            })
            ->get();

        abort_if($items->count() === 0, 403);

        $order->load('buyer');

        return view('seller.orders.show', compact('order', 'items'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:processed,shipped,completed',
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status pengiriman berhasil diperbarui.');
    }
}