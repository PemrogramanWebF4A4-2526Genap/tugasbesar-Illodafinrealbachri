<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();

        $featuredProducts = Product::with(['category', 'reviews', 'orderItems'])
            ->latest()
            ->take(4)
            ->get();

        return view('welcome', compact('categories', 'featuredProducts'));
    }
}