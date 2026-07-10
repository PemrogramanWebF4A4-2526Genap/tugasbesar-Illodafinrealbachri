<x-app-layout>
    <div style="padding:40px; max-width:1100px; margin:auto;">

        <a href="{{ route('seller.products.index') }}"
           style="
                display:inline-block;
                margin-bottom:20px;
                color:#111;
                text-decoration:none;
                font-weight:bold;
           ">
            ← Kembali ke Produk Saya
        </a>

        <div style="
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:35px;
            background:white;
            border:1px solid #ddd;
            border-radius:12px;
            padding:25px;
        ">

            <div>
                @if($product->image)
                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        style="
                            width:100%;
                            max-height:520px;
                            object-fit:cover;
                            border-radius:10px;
                            border:1px solid #ddd;
                        "
                    >
                @else
                    <div style="
                        width:100%;
                        height:450px;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        background:#eee;
                        color:#777;
                        border-radius:10px;
                    ">
                        Belum ada gambar utama
                    </div>
                @endif

                @if($product->images->count() > 0)
                    <div style="
                        display:grid;
                        grid-template-columns:repeat(4,1fr);
                        gap:10px;
                        margin-top:15px;
                    ">
                        @foreach($product->images as $image)
                            <img
                                src="{{ asset('storage/' . $image->image) }}"
                                alt="Gallery {{ $product->name }}"
                                style="
                                    width:100%;
                                    height:110px;
                                    object-fit:cover;
                                    border-radius:7px;
                                    border:1px solid #ddd;
                                "
                            >
                        @endforeach
                    </div>
                @endif
            </div>

            <div>
                <p style="
                    font-size:13px;
                    letter-spacing:3px;
                    color:#777;
                    text-transform:uppercase;
                    margin-bottom:8px;
                ">
                    {{ $product->category->name ?? 'Tanpa Kategori' }}
                </p>

                <h1 style="
                    font-size:38px;
                    line-height:1.2;
                    margin:0 0 20px;
                    font-weight:bold;
                ">
                    {{ $product->name }}
                </h1>

                <h2 style="
                    font-size:28px;
                    margin-bottom:22px;
                ">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </h2>

                <div style="
                    display:grid;
                    grid-template-columns:1fr 1fr;
                    gap:12px;
                    margin-bottom:25px;
                ">
                    <div style="
                        background:#f3f4f6;
                        padding:15px;
                        border-radius:8px;
                    ">
                        <small style="color:#666;">Stok</small>

                        <div style="font-size:22px; font-weight:bold;">
                            {{ $product->stock }}
                        </div>
                    </div>

                    <div style="
                        background:#f3f4f6;
                        padding:15px;
                        border-radius:8px;
                    ">
                        <small style="color:#666;">Terjual</small>

                        <div style="font-size:22px; font-weight:bold;">
                            {{ $product->orderItems->sum('quantity') }}
                        </div>
                    </div>
                </div>

                <div style="margin-bottom:28px;">
                    <h3 style="font-size:20px; margin-bottom:10px;">
                        Deskripsi Produk
                    </h3>

                    <p style="
                        color:#555;
                        line-height:1.8;
                        white-space:pre-line;
                    ">
                        {{ $product->description ?: 'Belum ada deskripsi produk.' }}
                    </p>
                </div>

                <div style="
                    display:flex;
                    gap:10px;
                    flex-wrap:wrap;
                ">
                    <a href="{{ route('seller.products.edit', $product) }}"
                       style="
                            background:#f59e0b;
                            color:white;
                            padding:11px 20px;
                            border-radius:6px;
                            text-decoration:none;
                            font-weight:bold;
                       ">
                        Edit Produk
                    </a>

                    <form
                        action="{{ route('seller.products.destroy', $product) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            style="
                                background:#dc2626;
                                color:white;
                                padding:11px 20px;
                                border:none;
                                border-radius:6px;
                                cursor:pointer;
                                font-weight:bold;
                            "
                        >
                            Hapus Produk
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div style="
            background:white;
            border:1px solid #ddd;
            border-radius:12px;
            padding:25px;
            margin-top:25px;
        ">
            <h2 style="font-size:24px; margin-bottom:20px;">
                Review Produk
            </h2>

            @forelse($product->reviews as $review)
                <div style="
                    border-bottom:1px solid #eee;
                    padding:15px 0;
                ">
                    <strong>
                        {{ $review->buyer->name ?? 'Buyer' }}
                    </strong>

                    <p style="
                        color:#f59e0b;
                        font-size:20px;
                        margin:7px 0;
                    ">
                        {{ str_repeat('★', $review->rating) }}
                        {{ str_repeat('☆', 5 - $review->rating) }}
                    </p>

                    <p style="color:#555; margin:0;">
                        {{ $review->comment }}
                    </p>
                </div>
            @empty
                <p style="color:#666;">
                    Belum ada review untuk produk ini.
                </p>
            @endforelse
        </div>

    </div>
</x-app-layout>