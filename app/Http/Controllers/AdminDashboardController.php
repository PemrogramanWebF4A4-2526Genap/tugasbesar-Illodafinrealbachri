<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalSellers = User::where('role', 'seller')->count();
        $totalBuyers = User::where('role', 'buyer')->count();
        $totalOrders = Order::count();

        $totalRevenue = Order::where('payment_status', 'paid')
            ->sum('total_amount');

        $latestOrders = Order::with('buyer')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalSellers',
            'totalBuyers',
            'totalOrders',
            'totalRevenue',
            'latestOrders'
        ));
    }
}