<x-app-layout>
    <div style="padding:40px; max-width:1000px; margin:auto;">
        <h1 style="font-size:32px; font-weight:bold; margin-bottom:25px;">
            Pesanan Saya
        </h1>

        @if(session('success'))
            <div style="background:#d1fae5; padding:15px; border-radius:8px; margin-bottom:20px;">
                {{ session('success') }}
            </div>
        @endif

        @forelse($orders as $order)
            @php
                $colors = [
                    'pending' => '#f59e0b',
                    'processed' => '#3b82f6',
                    'shipped' => '#8b5cf6',
                    'completed' => '#10b981',
                    'cancelled' => '#ef4444',
                ];

                $statusColor = $colors[$order->status] ?? '#6b7280';
            @endphp

            <div style="background:white; padding:20px; border-radius:10px; margin-bottom:15px; border:1px solid #ddd;">
                <h2 style="font-size:20px; font-weight:bold;">
                    Order #{{ $order->id }}
                </h2>

                <p>Total: Rp {{ number_format($order->total_amount,0,',','.') }}</p>

                <p>
                    Status:
                    <span style="background:{{ $statusColor }}; color:white; padding:5px 10px; border-radius:20px; font-size:13px;">
                        {{ ucfirst($order->status) }}
                    </span>
                </p>

                <p>Tanggal: {{ $order->created_at->format('d M Y H:i') }}</p>

                <a href="{{ route('buyer.orders.show', $order) }}"
                   style="display:inline-block; margin-top:10px; background:black; color:white; padding:8px 15px; border-radius:6px;">
                    Detail Pesanan
                </a>
            </div>
        @empty
            <p>Belum ada pesanan.</p>
        @endforelse
    </div>
</x-app-layout>