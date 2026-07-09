<x-app-layout>
    <div style="padding:40px; max-width:1000px; margin:auto;">
        <a href="{{ route('seller.orders.index') }}">← Kembali</a>

        <h1 style="font-size:32px; font-weight:bold; margin:25px 0;">
            Detail Pesanan #{{ $order->id }}
        </h1>

        @if(session('success'))
            <div style="background:#d1fae5; padding:15px; border-radius:8px; margin-bottom:20px;">
                {{ session('success') }}
            </div>
        @endif

        <div style="background:white; padding:20px; border-radius:10px; margin-bottom:20px;">
            <p><strong>Buyer:</strong> {{ $order->buyer->name }}</p>
            <p><strong>Status Pesanan:</strong> {{ ucfirst($order->status) }}</p>
            <p><strong>Status Pembayaran:</strong> {{ ucfirst(str_replace('_', ' ', $order->payment_status ?? 'unpaid')) }}</p>
            <p><strong>Alamat:</strong> {{ $order->shipping_address }}</p>
        </div>

        <div style="background:white; padding:20px; border-radius:10px; margin-bottom:20px;">
            <h2 style="font-size:22px; font-weight:bold; margin-bottom:15px;">
                Konfirmasi Pengiriman
            </h2>

            <form action="{{ route('seller.orders.updateStatus', $order) }}" method="POST">
                @csrf
                @method('PATCH')

                <select name="status" style="width:100%; border:1px solid #ccc; padding:10px; border-radius:6px; margin-bottom:15px;">
                    <option value="processed" {{ $order->status == 'processed' ? 'selected' : '' }}>Diproses</option>
                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Dikirim</option>
                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                </select>

                <button style="background:black; color:white; padding:10px 20px; border-radius:6px;">
                    Update Status
                </button>
            </form>
        </div>

        <div style="background:white; padding:20px; border-radius:10px;">
            <h2 style="font-size:22px; font-weight:bold; margin-bottom:15px;">
                Produk Saya dalam Pesanan Ini
            </h2>

            @foreach($items as $item)
                <div style="border-bottom:1px solid #ddd; padding:12px 0;">
                    <strong>{{ $item->product->name }}</strong>
                    <p>Qty: {{ $item->quantity }}</p>
                    <p>Subtotal: Rp {{ number_format($item->price * $item->quantity,0,',','.') }}</p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>