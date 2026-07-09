<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>CAFFIN - Fashion Brand</title>
</head>
<body style="margin:0; font-family:Arial, sans-serif; background:#f5f5f5; color:#111;">

<nav style="height:72px; background:#fff; display:flex; align-items:center; justify-content:space-between; padding:0 70px; border-bottom:1px solid #e5e5e5; position:sticky; top:0; z-index:10;">
    <a href="{{ route('home') }}" style="font-size:32px; font-weight:900; letter-spacing:2px; color:#111; text-decoration:none;">CAFFIN</a>

    <div style="display:flex; gap:34px; font-weight:600;">
        <a href="{{ route('public.products.index') }}" style="color:#111; text-decoration:none;">SHOP</a>
        <a href="{{ route('public.products.index') }}" style="color:#111; text-decoration:none;">NEW ARRIVALS</a>
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

<section style="height:620px; background:linear-gradient(120deg,#050505,#222); color:white; display:flex; align-items:center; justify-content:space-between; padding:0 80px;">
    <div style="max-width:620px;">
        <p style="letter-spacing:5px; font-size:13px; color:#bbb;">CAFFIN NEW SEASON</p>

        <h1 style="font-size:72px; line-height:0.95; margin:18px 0; font-weight:900;">
            BUILT FOR DAILY STREETWEAR
        </h1>

        <p style="font-size:18px; color:#ccc; line-height:1.7; margin-bottom:35px;">
            Koleksi fashion kekinian dengan desain clean, simple, dan cocok untuk daily outfit.
        </p>

        <a href="{{ route('public.products.index') }}"
           style="background:white; color:#111; padding:16px 34px; border-radius:3px; text-decoration:none; font-weight:800; letter-spacing:1px;">
            SHOP NOW
        </a>
    </div>

    <div style="width:420px; height:420px; border:2px solid #444; display:flex; align-items:center; justify-content:center; font-size:54px; font-weight:900; letter-spacing:4px;">
        CAFFIN
    </div>
</section>

<section style="padding:70px 80px; background:#fff;">
    <div style="display:flex; justify-content:space-between; align-items:end; margin-bottom:35px;">
        <div>
            <p style="letter-spacing:4px; color:#777;">SHOP BY CATEGORY</p>
            <h2 style="font-size:42px; margin:0;">Explore Collections</h2>
        </div>

        <a href="{{ route('public.products.index') }}" style="color:#111; font-weight:bold;">
            View All Products →
        </a>
    </div>

    <div style="display:grid; grid-template-columns:repeat(5,1fr); gap:18px;">
        @forelse($categories as $category)
            <a href="{{ route('public.products.index', ['category' => $category->id]) }}"
   style="
        height:180px;
        background:linear-gradient(135deg, #111, #333);
        color:white;
        border-radius:8px;
        display:flex;
        flex-direction:column;
        justify-content:end;
        padding:22px;
        font-size:20px;
        font-weight:800;
        text-decoration:none;
        box-shadow:0 8px 20px rgba(0,0,0,0.15);
   ">

    <span style="font-size:13px; letter-spacing:3px; color:#aaa;">
        COLLECTION
    </span>

    <span style="font-size:26px; margin-top:6px;">
        {{ strtoupper($category->name) }}
    </span>
</a>
        @empty
            <p>Belum ada kategori.</p>
        @endforelse
    </div>
</section>

<section style="padding:70px 80px; background:#f5f5f5;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
        <div>
            <p style="letter-spacing:4px; color:#777;">FEATURED</p>
            <h2 style="font-size:42px; margin:0;">Featured Products</h2>
        </div>

        <a href="{{ route('public.products.index') }}" style="font-weight:bold; color:#111;">
            View All →
        </a>
    </div>

    <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:25px;">
        @forelse($featuredProducts as $product)
            <a href="{{ route('public.products.show', $product) }}"
               style="background:white; border:1px solid #ddd; text-decoration:none; color:#111; display:block;">
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}"
                         style="width:100%; height:300px; object-fit:cover;">
                @else
                    <div style="width:100%; height:300px; background:#ddd; display:flex; align-items:center; justify-content:center;">
                        No Image
                    </div>
                @endif

                <div style="padding:15px;">
                    <p style="font-size:12px; color:#777; letter-spacing:2px;">
                        {{ strtoupper($product->category->name) }}
                    </p>

                    <h3 style="font-size:18px; margin:8px 0;">
                        {{ $product->name }}
                    </h3>

                    <p style="font-size:13px; color:#777;">
                        {{ $product->orderItems->sum('quantity') }} terjual
                    </p>

                    <p style="font-weight:bold;">
                        Rp {{ number_format($product->price,0,',','.') }}
                    </p>
                </div>
            </a>
        @empty
            <p>Belum ada produk.</p>
        @endforelse
    </div>
</section>

<section style="padding:80px; background:white; text-align:center;">
    <p style="letter-spacing:4px; color:#777;">ABOUT CAFFIN</p>
    <h2 style="font-size:44px; margin:10px 0;">Wear Your Confidence</h2>
    <p style="max-width:760px; margin:auto; color:#555; font-size:18px; line-height:1.8;">
        CAFFIN adalah brand fashion modern yang menghadirkan outfit simple, clean, dan stylish untuk aktivitas harian.
    </p>
</section>

<footer style="background:#111; color:white; padding:35px 80px; display:flex; justify-content:space-between;">
    <strong>CAFFIN</strong>
    <span>© {{ date('Y') }} CAFFIN. All Rights Reserved.</span>
</footer>

</body>
</html>