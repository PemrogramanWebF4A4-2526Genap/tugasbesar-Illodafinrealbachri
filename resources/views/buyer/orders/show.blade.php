<x-app-layout>
    <div style="padding:40px; max-width:1000px; margin:auto;">

        <a href="{{ route('buyer.orders.index') }}"
           style="display:inline-block; margin-bottom:20px; color:#111;">
            ← Kembali
        </a>

        <h1 style="font-size:32px; font-weight:bold; margin-bottom:25px;">
            Detail Pesanan #{{ $order->id }}
        </h1>

        @if(session('success'))
            <div style="
                background:#d1fae5;
                color:#065f46;
                padding:15px;
                border-radius:8px;
                margin-bottom:20px;
            ">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="
                background:#fee2e2;
                color:#991b1b;
                padding:15px;
                border-radius:8px;
                margin-bottom:20px;
            ">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div style="
                background:#fee2e2;
                color:#991b1b;
                padding:15px;
                border-radius:8px;
                margin-bottom:20px;
            ">
                <ul style="margin:0; padding-left:20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
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

        <div style="
            background:white;
            padding:25px;
            border-radius:12px;
            border:1px solid #ddd;
            margin-bottom:20px;
        ">
            <h2 style="font-size:24px; font-weight:bold; margin-bottom:20px;">
                Tracking Pesanan
            </h2>

            <div style="
                display:grid;
                grid-template-columns:repeat(4,1fr);
                gap:12px;
            ">
                @foreach($statusOrder as $index => $status)
                    <div style="
                        padding:18px 10px;
                        border-radius:10px;
                        text-align:center;
                        background:{{ $index <= $currentIndex ? '#111' : '#e5e7eb' }};
                        color:{{ $index <= $currentIndex ? '#fff' : '#555' }};
                    ">
                        <div style="font-size:24px; margin-bottom:8px;">
                            {{ $index <= $currentIndex ? '✓' : '○' }}
                        </div>

                        <strong>{{ $steps[$status] }}</strong>
                    </div>
                @endforeach
            </div>

            @if($order->status === 'cancelled')
                <p style="color:#dc2626; font-weight:bold; margin-top:20px;">
                    Pesanan ini telah dibatalkan.
                </p>
            @endif
        </div>

        <div style="
            background:white;
            padding:22px;
            border-radius:12px;
            border:1px solid #ddd;
            margin-bottom:20px;
        ">
            <p>
                <strong>Total:</strong>
                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
            </p>

            <p>
                <strong>Status Pesanan:</strong>
                {{ ucfirst($order->status) }}
            </p>

            <p>
                <strong>Status Pembayaran:</strong>
                {{ ucfirst(str_replace('_', ' ', $order->payment_status ?? 'unpaid')) }}
            </p>

            <p>
                <strong>Alamat Pengiriman:</strong>
                {{ $order->shipping_address }}
            </p>
        </div>

        <div style="
            background:white;
            padding:22px;
            border-radius:12px;
            border:1px solid #ddd;
            margin-bottom:20px;
        ">
            <h2 style="font-size:24px; font-weight:bold; margin-bottom:18px;">
                Pembayaran
            </h2>

            @if($order->payment_proof)
                <p>Bukti pembayaran:</p>

                <img
                    src="{{ asset('storage/' . $order->payment_proof) }}"
                    alt="Bukti Pembayaran"
                    style="
                        max-width:300px;
                        max-height:350px;
                        object-fit:contain;
                        border:1px solid #ddd;
                        border-radius:10px;
                        margin-bottom:15px;
                    "
                >
            @endif

            @if(($order->payment_status ?? 'unpaid') !== 'paid')
                <form
                    action="{{ route('buyer.orders.payment', $order) }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf

                    <input
                        type="file"
                        name="payment_proof"
                        accept="image/*"
                        required
                    >

                    <br><br>

                    <button
                        type="submit"
                        style="
                            background:#111;
                            color:white;
                            border:none;
                            padding:11px 20px;
                            border-radius:6px;
                            cursor:pointer;
                        "
                    >
                        Upload Bukti Pembayaran
                    </button>
                </form>
            @else
                <p style="color:#15803d; font-weight:bold;">
                    Pembayaran telah dikonfirmasi.
                </p>
            @endif
        </div>

        <div style="
            background:white;
            padding:22px;
            border-radius:12px;
            border:1px solid #ddd;
        ">
            <h2 style="font-size:24px; font-weight:bold; margin-bottom:18px;">
                Produk Dibeli
            </h2>

            @forelse($order->items as $item)
                <div style="
                    border-bottom:1px solid #ddd;
                    padding:18px 0;
                ">
                    <div style="display:flex; justify-content:space-between; gap:20px;">
                        <div>
                            <h3 style="font-size:18px; margin:0 0 8px;">
                                {{ $item->product->name }}
                            </h3>

                            <p style="margin:4px 0;">
                                Qty: {{ $item->quantity }}
                            </p>

                            <p style="margin:4px 0;">
                                Harga:
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </p>

                            <p style="margin:4px 0; font-weight:bold;">
                                Subtotal:
                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    @if($order->status === 'completed')
                        @php
                            $existingReview = \App\Models\Review::where(
                                'buyer_id',
                                auth()->id()
                            )
                            ->where('product_id', $item->product_id)
                            ->first();
                        @endphp

                        @if($existingReview)
                            <div style="
                                background:#f3f4f6;
                                padding:15px;
                                border-radius:8px;
                                margin-top:15px;
                            ">
                                <strong>Review kamu:</strong>

                                <p style="color:#f59e0b; font-size:20px; margin:8px 0;">
                                    {{ str_repeat('★', $existingReview->rating) }}
                                    {{ str_repeat('☆', 5 - $existingReview->rating) }}
                                </p>

                                <p style="margin:0;">
                                    {{ $existingReview->comment }}
                                </p>
                            </div>
                        @else
                            <div style="
                                background:#fafafa;
                                border:1px solid #ddd;
                                padding:18px;
                                border-radius:10px;
                                margin-top:15px;
                            ">
                                <h4 style="font-size:18px; margin:0 0 15px;">
                                    Berikan Rating dan Review
                                </h4>

                                <form
                                    action="{{ route('buyer.products.review', $item->product) }}"
                                    method="POST"
                                >
                                    @csrf

                                    <div style="margin-bottom:15px;">
                                        <label
                                            for="rating-{{ $item->id }}"
                                            style="display:block; font-weight:bold; margin-bottom:6px;"
                                        >
                                            Rating
                                        </label>

                                        <select
                                            id="rating-{{ $item->id }}"
                                            name="rating"
                                            required
                                            style="
                                                width:100%;
                                                padding:10px;
                                                border:1px solid #ccc;
                                                border-radius:6px;
                                            "
                                        >
                                            <option value="">Pilih Rating</option>
                                            <option value="5">★★★★★ - Sangat Baik</option>
                                            <option value="4">★★★★☆ - Baik</option>
                                            <option value="3">★★★☆☆ - Cukup</option>
                                            <option value="2">★★☆☆☆ - Kurang</option>
                                            <option value="1">★☆☆☆☆ - Sangat Kurang</option>
                                        </select>
                                    </div>

                                    <div style="margin-bottom:15px;">
                                        <label
                                            for="comment-{{ $item->id }}"
                                            style="display:block; font-weight:bold; margin-bottom:6px;"
                                        >
                                            Review
                                        </label>

                                        <textarea
                                            id="comment-{{ $item->id }}"
                                            name="comment"
                                            rows="4"
                                            minlength="5"
                                            maxlength="1000"
                                            placeholder="Ceritakan pengalaman kamu menggunakan produk ini..."
                                            required
                                            style="
                                                width:100%;
                                                padding:10px;
                                                border:1px solid #ccc;
                                                border-radius:6px;
                                                box-sizing:border-box;
                                            "
                                        ></textarea>
                                    </div>

                                    <button
                                        type="submit"
                                        style="
                                            background:#111;
                                            color:white;
                                            border:none;
                                            padding:11px 20px;
                                            border-radius:6px;
                                            cursor:pointer;
                                        "
                                    >
                                        Kirim Review
                                    </button>
                                </form>
                            </div>
                        @endif
                    @else
                        <div style="
                            background:#fff7ed;
                            color:#9a3412;
                            padding:12px;
                            border-radius:8px;
                            margin-top:15px;
                        ">
                            Rating dan review dapat diberikan setelah status pesanan selesai.
                        </div>
                    @endif
                </div>
            @empty
                <p>Produk pada pesanan ini tidak ditemukan.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>