<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $product->name }} - CAFFIN</title>
</head>
<body style="margin:0; font-family:Arial, sans-serif; background:#f5f5f5; color:#111;">

<nav style="height:72px; background:#fff; display:flex; align-items:center; justify-content:space-between; padding:0 70px; border-bottom:1px solid #e5e5e5;">
    <a href="{{ route('home') }}" style="font-size:32px; font-weight:900; letter-spacing:2px; color:#111; text-decoration:none;">CAFFIN</a>

    <div style="display:flex; gap:34px; font-weight:600;">
        <a href="{{ route('public.products.index') }}" style="color:#111; text-decoration:none;">SHOP</a>
        <a href="{{ route('public.products.index') }}" style="color:#111; text-decoration:none;">COLLECTIONS</a>
    </div>

    <div>
        @auth
            <a href="{{ route('dashboard') }}" style="color:#111; text-decoration:none; font-weight:600;">Dashboard</a>
        @else
            <a href="{{ route('login') }}" style="color:#111; text-decoration:none; font-weight:600;">Login</a>
        @endauth
    </div>
</nav>

<section style="padding:45px 70px;">
    <a href="{{ route('public.products.index') }}" style="display:inline-block; margin-bottom:25px; color:#111; font-weight:bold;">
        ← BACK TO PRODUCTS
    </a>

    <div style="display:grid; grid-template-columns:1.1fr 0.9fr; gap:55px; background:white; padding:35px; border:1px solid #ddd;">
        <div>
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}"
                     style="width:100%; max-height:650px; object-fit:cover; margin-bottom:15px;">
            @else
                <div style="height:560px; display:flex; align-items:center; justify-content:center; background:#ddd; margin-bottom:15px;">
                    No Image
                </div>
            @endif

            @if($product->images->count())
                <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:10px;">
                    @foreach($product->images as $image)
                        <img src="{{ asset('storage/'.$image->image) }}"
                             style="width:100%; height:120px; object-fit:cover; border:1px solid #ddd; border-radius:6px;">
                    @endforeach
                </div>
            @endif
        </div>

        <div>
            <p style="letter-spacing:3px; color:#777;">{{ strtoupper($product->category->name) }}</p>

            <h1 style="font-size:46px; line-height:1.1; margin:12px 0;">
                {{ $product->name }}
            </h1>

            <p style="color:#f59e0b;">
                ⭐ {{ number_format($product->reviews->avg('rating') ?? 0, 1) }}
                <span style="color:#777;">({{ $product->reviews->count() }} review)</span>
            </p>

            <h2 style="font-size:30px; margin:25px 0;">
                Rp {{ number_format($product->price,0,',','.') }}
            </h2>

            <p>Stock: <strong>{{ $product->stock }}</strong></p>
            <p>Terjual: <strong>{{ $product->orderItems->sum('quantity') }}</strong></p>

            <div style="margin:28px 0; color:#555; line-height:1.8;">
                {{ $product->description }}
            </div>

            @guest
                <a href="{{ route('login') }}"
                   style="display:block; background:#111; color:white; padding:16px 28px; text-align:center; text-decoration:none; font-weight:bold; border-radius:4px;">
                    LOGIN UNTUK MEMBELI
                </a>
            @else
                @if(auth()->user()->role === 'buyer')
                    <form action="{{ route('buyer.cart.add', $product) }}" method="POST">
                        @csrf
                        <button type="submit"
                                style="width:100%; background:#111; color:white; padding:16px 28px; border:none; font-weight:bold; border-radius:4px;">
                            + TAMBAH KE KERANJANG
                        </button>
                    </form>

                    <form action="{{ route('chat.start', $product) }}"
                          method="POST"
                          style="margin-top:10px;">
                        @csrf

                        <button type="submit"
                                style="width:100%; background:white; border:1px solid #111; padding:16px; border-radius:4px; font-weight:bold;">
                            CHAT SELLER
                        </button>
                    </form>
                @else
                    <p style="background:#eee; padding:15px; border-radius:4px;">
                        Login sebagai buyer untuk membeli produk ini.
                    </p>
                @endif
            @endguest
        </div>
    </div>

    <div style="background:white; margin-top:35px; padding:30px; border:1px solid #ddd;">
        <h2 style="font-size:28px;">Customer Reviews</h2>

        @forelse($product->reviews as $review)
            <div style="border-bottom:1px solid #ddd; padding:18px 0;">
                <strong>{{ $review->buyer->name }}</strong>
                <p style="color:#f59e0b;">{{ str_repeat('⭐', $review->rating) }}</p>
                <p style="color:#555;">{{ $review->comment }}</p>
            </div>
        @empty
            <p>Belum ada review.</p>
        @endforelse
    </div>
</section>

<footer style="background:#111; color:white; padding:35px 70px; margin-top:50px; display:flex; justify-content:space-between;">
    <strong>CAFFIN</strong>
    <span>Wear Your Confidence.</span>
</footer>

</body>
</html>