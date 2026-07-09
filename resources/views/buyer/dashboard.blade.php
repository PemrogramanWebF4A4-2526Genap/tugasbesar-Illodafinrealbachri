<x-app-layout>
    <div style="padding:40px; max-width:1200px; margin:auto;">
        <h1 style="font-size:34px; font-weight:bold; margin-bottom:8px;">
            Dashboard Buyer CAFFIN
        </h1>

        <p style="color:#666; margin-bottom:30px;">
            Temukan outfit fashion kekinian dan pantau pesanan kamu.
        </p>

        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:20px; margin-bottom:35px;">
            <div style="background:#111; color:white; padding:25px; border-radius:14px;">
                <p>Total Produk</p>
                <h2 style="font-size:32px; font-weight:bold;">{{ $totalProducts }}</h2>
            </div>

            <div style="background:white; padding:25px; border-radius:14px; border:1px solid #ddd;">
                <p>Isi Keranjang</p>
                <h2 style="font-size:32px; font-weight:bold;">{{ $cartItems }}</h2>
            </div>

            <div style="background:white; padding:25px; border-radius:14px; border:1px solid #ddd;">
                <p>Total Pesanan</p>
                <h2 style="font-size:32px; font-weight:bold;">{{ $totalOrders }}</h2>
            </div>
        </div>

        <div style="display:flex; gap:20px; margin-bottom:30px;">
            <a href="{{ route('buyer.products.index') }}"
               style="background:black; color:white; padding:12px 20px; border-radius:8px; text-decoration:none;">
                Lihat Produk
            </a>

            <a href="{{ route('buyer.cart.index') }}"
               style="background:#e5e7eb; color:#111; padding:12px 20px; border-radius:8px; text-decoration:none;">
                Keranjang
            </a>

            <a href="{{ route('buyer.orders.index') }}"
               style="background:#e5e7eb; color:#111; padding:12px 20px; border-radius:8px; text-decoration:none;">
                Pesanan Saya
            </a>
        </div>

        <div style="background:white; border:1px solid #ddd; border-radius:14px; padding:25px;">
            <h2 style="font-size:24px; font-weight:bold; margin-bottom:20px;">
                Pesanan Terbaru
            </h2>

            @forelse($latestOrders as $order)
                <div style="display:flex; justify-content:space-between; padding:15px 0; border-bottom:1px solid #eee;">
                    <div>
                        <strong>Order #{{ $order->id }}</strong>
                        <p style="color:#666;">{{ $order->created_at->format('d M Y H:i') }}</p>
                    </div>

                    <div style="text-align:right;">
                        <p>Rp {{ number_format($order->total_amount,0,',','.') }}</p>
                        <strong>{{ ucfirst($order->status) }}</strong>
                    </div>
                </div>
            @empty
                <p>Belum ada pesanan.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>