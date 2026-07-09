<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PublicProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $categoryId = $request->category;
        $sort = $request->sort;

        $categories = Category::orderBy('name')->get();

        $products = Product::with(['category', 'seller', 'reviews', 'orderItems'])
            ->withSum('orderItems as sold_count', 'quantity')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($categoryQuery) use ($search) {
                        $categoryQuery->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->when($categoryId, function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->when($sort === 'price_low', function ($query) {
                $query->orderBy('price', 'asc');
            })
            ->when($sort === 'price_high', function ($query) {
                $query->orderBy('price', 'desc');
            })
            ->when($sort === 'best_selling', function ($query) {
                $query->orderByDesc('sold_count');
            })
            ->when(!$sort || $sort === 'newest', function ($query) {
                $query->latest();
            })
            ->get();

        return view('public.products.index', compact(
            'products',
            'categories',
            'search',
            'categoryId',
            'sort'
        ));
    }

    public function show(Product $product)
    {
        $product->load([
            'category',
            'seller',
            'reviews.buyer',
            'orderItems',
            'images'
        ]);

        return view('public.products.show', compact('product'));
    }
}