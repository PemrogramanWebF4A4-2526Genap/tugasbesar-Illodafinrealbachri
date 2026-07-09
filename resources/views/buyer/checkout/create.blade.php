<x-app-layout>
    <div style="padding:40px; max-width:900px; margin:auto;">
        <h1 style="font-size:32px; font-weight:bold; margin-bottom:25px;">
            Checkout
        </h1>

        <div style="background:white; padding:20px; border-radius:10px; margin-bottom:25px;">
            <h2 style="font-size:22px; font-weight:bold; margin-bottom:15px;">
                Ringkasan Pesanan
            </h2>

            @php
                $total = 0;
            @endphp

            @foreach($cart->items as $item)
                @php
                    $subtotal = $item->product->price * $item->quantity;
                    $total += $subtotal;
                @endphp

                <div style="display:flex; justify-content:space-between; border-bottom:1px solid #ddd; padding:10px 0;">
                    <div>
                        <strong>{{ $item->product->name }}</strong>
                        <p>Qty: {{ $item->quantity }}</p>
                    </div>

                    <div>
                        Rp {{ number_format($subtotal,0,',','.') }}
                    </div>
                </div>
            @endforeach

            <h3 style="font-size:20px; font-weight:bold; margin-top:15px;">
                Total: Rp {{ number_format($total,0,',','.') }}
            </h3>
        </div>

        <div style="background:white; padding:20px; border-radius:10px;">
            <form action="{{ route('buyer.checkout.store') }}" method="POST">
                @csrf

                <div style="margin-bottom:15px;">
                    <label>Alamat Pengiriman</label>
                    <textarea name="shipping_address" rows="4"
                              style="width:100%; border:1px solid #ccc; padding:10px; border-radius:6px;"
                              placeholder="Masukkan alamat lengkap pengiriman">{{ old('shipping_address') }}</textarea>

                    @error('shipping_address')
                        <p style="color:red;">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        style="background:black; color:white; padding:12px 25px; border-radius:6px;">
                    Buat Pesanan
                </button>

                <a href="{{ route('buyer.cart.index') }}"
                   style="margin-left:10px; background:#ddd; padding:12px 25px; border-radius:6px;">
                    Kembali
                </a>
            </form>
        </div>
    </div>
</x-app-layout>