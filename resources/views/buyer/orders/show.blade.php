<x-app-layout>
    <div style="padding:40px; max-width:1000px; margin:auto;">
        <a href="{{ route('buyer.orders.index') }}" style="display:inline-block; margin-bottom:20px;">
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

        @php
            $steps = [
                'pending' => 'Pesanan Dibuat',
                'processed' => 'Diproses',
                'shipped' => 'Dikirim',
                'completed' => 'Selesai',
            ];

            $statusOrder = ['pending', 'processed', 'shipped', 'completed'];
            $currentIndex = array_search($order->status, $statusOrder);
            if ($currentIndex === false) {
                $currentIndex = 0;
            }
        @endphp

        <div style="background:white; padding:25px; border-radius:12px; margin-bottom:20px; border:1px solid #ddd;">
            <h2 style="font-size:24px; font-weight:bold; margin-bottom:20px;">
                Tracking Pesanan
            </h2>

            <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:15px;">
                @foreach($statusOrder as $index => $status)
                    <div style="
                        padding:18px;
                        border-radius:10px;
                        text-align:center;
                        background:{{ $index <= $currentIndex ? '#111' : '#e5e7eb' }};
                        color:{{ $index <= $currentIndex ? 'white' : '#555' }};
                    ">
                        <div style="font-size:24px; margin-bottom:8px;">
                            {{ $index <= $currentIndex ? '✓' : '○' }}
                        </div>

                        <strong>{{ $steps[$status] }}</strong>
                    </div>
                @endforeach
            </div>

            @if($order->status === 'cancelled')
                <p style="margin-top:20px; color:red; font-weight:bold;">
                    Pesanan ini dibatalkan.
                </p>
            @endif
        </div>

        <div style="background:white; padding:20px; border-radius:10px; margin-bottom:20px;">
            <p><strong>Total:</strong> Rp {{ number_format($order->total_amount,0,',','.') }}</p>
            <p><strong>Status Pesanan:</strong> {{ ucfirst($order->status) }}</p>
            <p><strong>Status Pembayaran:</strong> {{ ucfirst(str_replace('_', ' ', $order->payment_status ?? 'unpaid')) }}</p>
            <p><strong>Alamat:</strong> {{ $order->shipping_address }}</p>
        </div>

        <div style="background:white; padding:20px; border-radius:10px; margin-bottom:20px;">
            <h2 style="font-size:22px; font-weight:bold; margin-bottom:15px;">
                Upload Bukti Pembayaran
            </h2>

            @if($order->payment_proof)
                <p style="margin-bottom:10px;">Bukti pembayaran saat ini:</p>
                <img src="{{ asset('storage/'.$order->payment_proof) }}"
                     style="max-width:300px; border-radius:10px; margin-bottom:15px;">
            @endif

            <form action="{{ route('buyer.orders.payment', $order) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                <input type="file" name="payment_proof" required>

                @error('payment_proof')
                    <p style="color:red;">{{ $message }}</p>
                @enderror

                <br><br>

                <button type="submit"
                        style="background:black;color:white;padding:10px 20px;border-radius:6px;">
                    Upload Bukti
                </button>
            </form>
        </div>

        <div style="background:white; padding:20px; border-radius:10px;">
            <h2 style="font-size:22px; font-weight:bold; margin-bottom:15px;">
                Produk Dibeli
            </h2>

            @foreach($order->items as $item)
                <div style="padding:10px 0; border-bottom:1px solid #ddd;">
                    <strong>{{ $item->product->name }}</strong><br>
                    Qty: {{ $item->quantity }}<br>
                    Rp {{ number_format($item->price,0,',','.') }}
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>