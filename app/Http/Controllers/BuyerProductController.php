<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class BuyerProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $products = Product::with(['category', 'seller', 'reviews'])
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhereHas('category', function ($categoryQuery) use ($search) {
                          $categoryQuery->where('name', 'like', '%' . $search . '%');
                      });
            })
            ->latest()
            ->get();

        return view('buyer.products.index', compact('products', 'search'));
    }

    public function show(Product $product)
    {
        $product->load([
            'category',
            'seller',
            'reviews.buyer'
        ]);

        return view('buyer.products.show', compact('product'));
    }
}