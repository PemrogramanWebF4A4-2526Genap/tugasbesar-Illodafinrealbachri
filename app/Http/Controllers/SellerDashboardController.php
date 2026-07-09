<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Product;

class SellerDashboardController extends Controller
{
    public function index()
    {
        $sellerId = auth()->id();

        $totalProducts = Product::where('seller_id', $sellerId)->count();

        $totalSold = OrderItem::whereHas('product', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->sum('quantity');

        $totalRevenue = OrderItem::whereHas('product', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->sum(\DB::raw('quantity * price'));

        $totalOrders = OrderItem::whereHas('product', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->distinct('order_id')->count('order_id');

        $bestProducts = Product::where('seller_id', $sellerId)
            ->withSum('orderItems as sold_count', 'quantity')
            ->orderByDesc('sold_count')
            ->take(5)
            ->get();

        return view('seller.dashboard', compact(
            'totalProducts',
            'totalSold',
            'totalRevenue',
            'totalOrders',
            'bestProducts'
        ));
    }
}