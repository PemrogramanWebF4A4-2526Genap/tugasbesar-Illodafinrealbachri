<x-app-layout>
    <div style="padding:40px; max-width:1200px; margin:auto;">
        <h1 style="font-size:32px; font-weight:bold; margin-bottom:25px;">
            Kelola Pesanan
        </h1>

        <div style="background:white; border:1px solid #ddd; border-radius:10px; overflow:hidden;">
            <table style="width:100%; border-collapse:collapse;">
                <thead style="background:#f3f4f6;">
                    <tr>
                        <th style="padding:12px; text-align:left;">Order</th>
                        <th style="padding:12px; text-align:left;">Buyer</th>
                        <th style="padding:12px; text-align:left;">Total</th>
                        <th style="padding:12px; text-align:left;">Status</th>
                        <th style="padding:12px; text-align:left;">Tanggal</th>
                        <th style="padding:12px; text-align:left;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
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

                        <tr style="border-top:1px solid #ddd;">
                            <td style="padding:12px;">#{{ $order->id }}</td>
                            <td style="padding:12px;">{{ $order->buyer->name }}</td>
                            <td style="padding:12px;">Rp {{ number_format($order->total_amount,0,',','.') }}</td>
                            <td style="padding:12px;">
                                <span style="background:{{ $statusColor }}; color:white; padding:5px 10px; border-radius:20px; font-size:13px;">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td style="padding:12px;">{{ $order->created_at->format('d M Y H:i') }}</td>
                            <td style="padding:12px;">
                                <a href="{{ route('admin.orders.show', $order) }}"
                                   style="background:black; color:white; padding:8px 14px; border-radius:6px;">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding:20px; text-align:center;">
                                Belum ada pesanan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>