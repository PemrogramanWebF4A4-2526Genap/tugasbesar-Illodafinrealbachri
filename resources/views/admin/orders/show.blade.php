<x-app-layout>
    <div style="padding:40px; max-width:1000px; margin:auto;">
        <a href="{{ route('admin.orders.index') }}" style="display:inline-block; margin-bottom:20px;">
            ← Kembali
        </a>

        <h1 style="font-size:32px; font-weight:bold; margin-bottom:25px;">
            Detail Pesanan #{{ $order->id }}
        </h1>

        @if(session('success'))
            <div style="background:#d1fae5; padding:15px; border-radius:8px; margin-bottom:20px;">
                {{ session('success') }}
            </div>
        @endif

        <div style="background:white; padding:20px; border-radius:10px; margin-bottom:20px;">
            <p><strong>Buyer:</strong> {{ $order->buyer->name }}</p>
            <p><strong>Email:</strong> {{ $order->buyer->email }}</p>
            <p><strong>Total:</strong> Rp {{ number_format($order->total_amount,0,',','.') }}</p>
            <p><strong>Alamat:</strong> {{ $order->shipping_address }}</p>
            <p><strong>Status Pesanan:</strong> {{ ucfirst($order->status) }}</p>
            <p><strong>Status Pembayaran:</strong> {{ ucfirst(str_replace('_', ' ', $order->payment_status ?? 'unpaid')) }}</p>
        </div>

        <div style="background:white; padding:20px; border-radius:10px; margin-bottom:20px;">
            <h2 style="font-size:22px; font-weight:bold; margin-bottom:15px;">
                Bukti Pembayaran
            </h2>

            @if($order->payment_proof)
                <img src="{{ asset('storage/'.$order->payment_proof) }}"
                     style="max-width:350px; border-radius:10px; margin-bottom:15px;">
            @else
                <p>Buyer belum upload bukti pembayaran.</p>
            @endif

            <form action="{{ route('admin.orders.updatePaymentStatus', $order) }}" method="POST">
                @csrf
                @method('PATCH')

                <select name="payment_status"
                        style="width:100%; border:1px solid #ccc; padding:10px; border-radius:6px; margin-bottom:15px;">
                    <option value="unpaid" {{ $order->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                    <option value="waiting_verification" {{ $order->payment_status == 'waiting_verification' ? 'selected' : '' }}>Waiting Verification</option>
                    <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="rejected" {{ $order->payment_status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>

                <button style="background:black; color:white; padding:10px 20px; border-radius:6px;">
                    Update Status Pembayaran
                </button>
            </form>
        </div>

        <div style="background:white; padding:20px; border-radius:10px; margin-bottom:20px;">
            <h2 style="font-size:22px; font-weight:bold; margin-bottom:15px;">
                Ubah Status Pesanan
            </h2>

            <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                @csrf
                @method('PATCH')

                <select name="status"
                        style="width:100%; border:1px solid #ccc; padding:10px; border-radius:6px; margin-bottom:15px;">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processed" {{ $order->status == 'processed' ? 'selected' : '' }}>Processed</option>
                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>

                <button style="background:black; color:white; padding:10px 20px; border-radius:6px;">
                    Update Status Pesanan
                </button>
            </form>
        </div>

        <div style="background:white; padding:20px; border-radius:10px;">
            <h2 style="font-size:22px; font-weight:bold; margin-bottom:15px;">
                Produk Pesanan
            </h2>

            @foreach($order->items as $item)
                <div style="display:flex; justify-content:space-between; border-bottom:1px solid #ddd; padding:12px 0;">
                    <div>
                        <strong>{{ $item->product->name }}</strong>
                        <p>Qty: {{ $item->quantity }}</p>
                    </div>

                    <div>
                        Rp {{ number_format($item->price * $item->quantity,0,',','.') }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>