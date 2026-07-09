<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\Product;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function start(Product $product)
    {
        $conversation = Conversation::firstOrCreate([
            'buyer_id' => auth()->id(),
            'seller_id' => $product->seller_id,
            'product_id' => $product->id,
        ]);

        return redirect()->route('chat.show', $conversation);
    }

    public function show(Conversation $conversation)
    {
        abort_if(
            auth()->id() !== $conversation->buyer_id &&
            auth()->id() !== $conversation->seller_id,
            403
        );

        $conversation->load([
            'buyer',
            'seller',
            'product',
            'messages.sender'
        ]);

        return view('chat.show', compact('conversation'));
    }

    public function send(Request $request, Conversation $conversation)
    {
        abort_if(
            auth()->id() !== $conversation->buyer_id &&
            auth()->id() !== $conversation->seller_id,
            403
        );

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => auth()->id(),
            'message' => $request->message,
        ]);

        return back();
    }

    public function index()
{
    $user = auth()->user();

    if ($user->role === 'seller') {

        $conversations = Conversation::with([
            'buyer',
            'product'
        ])
        ->where('seller_id', $user->id)
        ->latest()
        ->get();

    } else {

        $conversations = Conversation::with([
            'seller',
            'product'
        ])
        ->where('buyer_id', $user->id)
        ->latest()
        ->get();
    }

    return view('chat.index', compact('conversations'));
}
}