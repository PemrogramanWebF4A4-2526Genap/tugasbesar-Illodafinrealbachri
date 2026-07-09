<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with('product.category')
            ->where('buyer_id', auth()->id())
            ->latest()
            ->get();

        return view('buyer.wishlist.index', compact('wishlists'));
    }

    public function store(Product $product)
    {
        Wishlist::firstOrCreate([
            'buyer_id' => auth()->id(),
            'product_id' => $product->id,
        ]);

        return back()->with('success', 'Produk ditambahkan ke wishlist.');
    }

    public function destroy(Wishlist $wishlist)
    {
        abort_if($wishlist->buyer_id !== auth()->id(), 403);

        $wishlist->delete();

        return back()->with('success', 'Produk dihapus dari wishlist.');
    }
}