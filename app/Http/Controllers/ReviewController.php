<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:5|max:1000',
        ], [
            'rating.required' => 'Rating wajib dipilih.',
            'rating.min' => 'Rating minimal 1 bintang.',
            'rating.max' => 'Rating maksimal 5 bintang.',
            'comment.required' => 'Review wajib diisi.',
            'comment.min' => 'Review minimal 5 karakter.',
            'comment.max' => 'Review maksimal 1000 karakter.',
        ]);

        $buyerId = auth()->id();

        $hasPurchased = Order::where('buyer_id', $buyerId)
            ->where('status', 'completed')
            ->whereHas('items', function ($query) use ($product) {
                $query->where('product_id', $product->id);
            })
            ->exists();

        if (!$hasPurchased) {
            return back()->with(
                'error',
                'Kamu hanya dapat memberikan review setelah pesanan produk ini selesai.'
            );
        }

        $alreadyReviewed = Review::where('buyer_id', $buyerId)
            ->where('product_id', $product->id)
            ->exists();

        if ($alreadyReviewed) {
            return back()->with(
                'error',
                'Kamu sudah pernah memberikan review untuk produk ini.'
            );
        }

        Review::create([
            'buyer_id' => $buyerId,
            'product_id' => $product->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Rating dan review berhasil dikirim.');
    }
}