<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Products - CAFFIN</title>
</head>
<body style="margin:0; font-family:Arial, sans-serif; background:#f5f5f5; color:#111;">

<nav style="height:72px; background:#fff; display:flex; align-items:center; justify-content:space-between; padding:0 70px; border-bottom:1px solid #e5e5e5;">
    <a href="/" style="font-size:32px; font-weight:900; letter-spacing:2px; color:#111; text-decoration:none;">CAFFIN</a>

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

<section style="background:#111; color:white; padding:55px 70px;">
    <p style="letter-spacing:4px; color:#aaa;">CAFFIN COLLECTION</p>
    <h1 style="font-size:54px; margin:10px 0;">Shop All Products</h1>
    <p style="color:#ccc;">Temukan outfit terbaik dari koleksi fashion CAFFIN.</p>
</section>

<section style="padding:40px 70px;">
    <form action="{{ route('public.products.index') }}" method="GET" style="display:flex; gap:12px; margin-bottom:35px; background:white; padding:18px; border-radius:6px; border:1px solid #ddd;">
        <input type="text" name="search" value="{{ $search }}" placeholder="Search product..."
               style="flex:1; padding:14px; border:1px solid #ccc; border-radius:4px;">

        <select name="category" style="padding:14px; border:1px solid #ccc; border-radius:4px;">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $categoryId == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <button style="background:#111; color:white; padding:14px 28px; border:none; border-radius:4px; font-weight:bold;">
            FILTER
        </button>

        <a href="{{ route('public.products.index') }}" style="background:#e5e5e5; color:#111; padding:14px 22px; border-radius:4px; text-decoration:none; font-weight:bold;">
            RESET
        </a>
    </form>

    <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:28px;">
        @forelse($products as $product)
            @php
                $avgRating = $product->reviews->avg('rating');
                $reviewCount = $product->reviews->count();
            @endphp

            <div style="background:white; border:1px solid #ddd;">
                <a href="{{ route('public.products.show', $product) }}" style="display:block;">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" style="width:100%; height:330px; object-fit:cover;">
                    @else
                        <div style="height:330px; background:#ddd; display:flex; align-items:center; justify-content:center;">No Image</div>
                    @endif
                </a>

                <div style="padding:18px;">
                    <p style="font-size:12px; color:#777; letter-spacing:2px;">{{ strtoupper($product->category->name) }}</p>

                    <h3 style="font-size:18px; margin:8px 0; min-height:45px;">
                        {{ $product->name }}
                    </h3>

                    <p style="color:#f59e0b; margin:8px 0;">
                        ⭐ {{ $avgRating ? number_format($avgRating,1) : '0.0' }}
                        <span style="color:#777;">({{ $reviewCount }})</span>
                    </p>

                    <p style="font-size:18px; font-weight:800;">
                        Rp {{ number_format($product->price,0,',','.') }}
                    </p>
                </div>
            </div>
        @empty
            <p>Produk tidak ditemukan.</p>
        @endforelse
    </div>
</section>

<footer style="background:#111; color:white; padding:35px 70px; margin-top:50px; display:flex; justify-content:space-between;">
    <strong>CAFFIN</strong>
    <span>Wear Your Confidence.</span>
</footer>

</body>
</html>