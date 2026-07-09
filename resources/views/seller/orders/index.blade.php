<x-app-layout>
    <div style="padding:40px; max-width:1200px; margin:auto;">
        <h1 style="font-size:32px; font-weight:bold; margin-bottom:25px;">
            Pesanan Produk Saya
        </h1>

        @forelse($orders as $order)
            <div style="background:white; padding:20px; border-radius:10px; margin-bottom:15px; border:1px solid #ddd;">
                <h2 style="font-size:20px; font-weight:bold;">Order #{{ $order->id }}</h2>
                <p>Buyer: {{ $order->buyer->name }}</p>
                <p>Status Pesanan: {{ ucfirst($order->status) }}</p>
                <p>Status Pembayaran: {{ ucfirst(str_replace('_', ' ', $order->payment_status ?? 'unpaid')) }}</p>

                <a href="{{ route('seller.orders.show', $order) }}"
                   style="display:inline-block; background:black; color:white; padding:10px 18px; border-radius:6px; margin-top:10px;">
                    Detail Pesanan
                </a>
            </div>
        @empty
            <p>Belum ada pesanan untuk produk kamu.</p>
        @endforelse
    </div>
</x-app-layout>