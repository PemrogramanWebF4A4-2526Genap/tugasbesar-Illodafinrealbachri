<x-app-layout>
    <div style="padding:40px; max-width:1200px; margin:auto;">
        <h1 style="font-size:34px; font-weight:bold;">Dashboard Seller</h1>
        <p style="color:#666; margin-bottom:30px;">Ringkasan penjualan produk CAFFIN.</p>

        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:20px; margin-bottom:35px;">
            <div style="background:#111; color:white; padding:25px; border-radius:14px;">
                <p>Total Produk</p>
                <h2 style="font-size:32px;">{{ $totalProducts }}</h2>
            </div>

            <div style="background:white; padding:25px; border-radius:14px; border:1px solid #ddd;">
                <p>Total Pesanan</p>
                <h2 style="font-size:32px;">{{ $totalOrders }}</h2>
            </div>

            <div style="background:white; padding:25px; border-radius:14px; border:1px solid #ddd;">
                <p>Produk Terjual</p>
                <h2 style="font-size:32px;">{{ $totalSold }}</h2>
            </div>

            <div style="background:white; padding:25px; border-radius:14px; border:1px solid #ddd;">
                <p>Pendapatan</p>
                <h2 style="font-size:24px;">Rp {{ number_format($totalRevenue,0,',','.') }}</h2>
            </div>
        </div>

        <div style="background:white; padding:25px; border-radius:14px; border:1px solid #ddd;">
            <h2 style="font-size:24px; font-weight:bold; margin-bottom:20px;">Produk Terlaris</h2>

            @forelse($bestProducts as $product)
                <div style="display:flex; justify-content:space-between; border-bottom:1px solid #eee; padding:14px 0;">
                    <strong>{{ $product->name }}</strong>
                    <span>{{ $product->sold_count ?? 0 }} terjual</span>
                </div>
            @empty
                <p>Belum ada penjualan.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>