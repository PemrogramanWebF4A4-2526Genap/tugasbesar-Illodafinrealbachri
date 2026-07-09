<x-app-layout>
    <div style="padding:40px; max-width:1200px; margin:auto;">

        <h1 style="font-size:32px; font-weight:bold; margin-bottom:20px;">
            Keranjang Belanja
        </h1>

        @if(session('success'))
            <div style="background:#d1fae5;padding:15px;margin-bottom:20px;border-radius:8px;">
                {{ session('success') }}
            </div>
        @endif

        @php
            $total = 0;
        @endphp

        @forelse($cart->items as $item)
            @php
                $subtotal = $item->product->price * $item->quantity;
                $total += $subtotal;
            @endphp

            <div style="border:1px solid #ddd;padding:20px;margin-bottom:15px;border-radius:8px;">
                <h3 style="font-weight:bold;">{{ $item->product->name }}</h3>

                <p>Harga: Rp {{ number_format($item->product->price,0,',','.') }}</p>
                <p>Qty: {{ $item->quantity }}</p>
                <p>Subtotal: Rp {{ number_format($subtotal,0,',','.') }}</p>

                <form action="{{ route('buyer.cart.remove', $item) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button style="background:red;color:white;padding:8px 12px;border-radius:6px;">
                        Hapus
                    </button>
                </form>
            </div>
        @empty
            <p>Keranjang masih kosong.</p>
        @endforelse

        @if($cart->items->count() > 0)
            <div style="margin-top:25px; background:white; padding:20px; border-radius:10px;">
                <h2 style="font-size:24px; font-weight:bold;">
                    Total: Rp {{ number_format($total,0,',','.') }}
                </h2>

                <a href="{{ route('buyer.checkout.create') }}"
                   style="display:inline-block; margin-top:15px; background:black; color:white; padding:12px 25px; border-radius:6px;">
                    Checkout
                </a>
            </div>
        @endif

    </div>
</x-app-layout>