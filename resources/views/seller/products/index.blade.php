<x-app-layout>
    <div style="padding:40px; max-width:1200px; margin:auto;">

        <div style="
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:25px;
        ">
            <div>
                <h1 style="font-size:30px; font-weight:bold; margin:0;">
                    Produk Saya - CAFFIN
                </h1>

                <p style="color:#666; margin-top:8px;">
                    Kelola produk, harga, stok, dan informasi produk.
                </p>
            </div>

            <a href="{{ route('seller.products.create') }}"
               style="
                    background:#111;
                    color:white;
                    padding:11px 20px;
                    border-radius:6px;
                    text-decoration:none;
                    font-weight:bold;
               ">
                + Tambah Produk
            </a>
        </div>

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

        <div style="
            background:white;
            border:1px solid #ddd;
            border-radius:10px;
            overflow:hidden;
        ">
            <table style="width:100%; border-collapse:collapse;">
                <thead style="background:#f3f4f6;">
                    <tr>
                        <th style="padding:14px; text-align:left;">Gambar</th>
                        <th style="padding:14px; text-align:left;">Produk</th>
                        <th style="padding:14px; text-align:left;">Kategori</th>
                        <th style="padding:14px; text-align:left;">Harga</th>
                        <th style="padding:14px; text-align:left;">Stok</th>
                        <th style="padding:14px; text-align:center;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($products as $product)
                        <tr style="border-top:1px solid #ddd;">
                            <td style="padding:12px;">
                                @if($product->image)
                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        style="
                                            width:65px;
                                            height:65px;
                                            object-fit:cover;
                                            border-radius:6px;
                                        "
                                    >
                                @else
                                    <div style="
                                        width:65px;
                                        height:65px;
                                        background:#eee;
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                        border-radius:6px;
                                        font-size:12px;
                                        color:#777;
                                    ">
                                        No Image
                                    </div>
                                @endif
                            </td>

                            <td style="padding:12px;">
                                <strong>{{ $product->name }}</strong>
                            </td>

                            <td style="padding:12px;">
                                {{ $product->category->name ?? '-' }}
                            </td>

                            <td style="padding:12px;">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>

                            <td style="padding:12px;">
                                {{ $product->stock }}
                            </td>

                            <td style="padding:12px;">
                                <div style="
                                    display:flex;
                                    justify-content:center;
                                    gap:8px;
                                    flex-wrap:wrap;
                                ">
                                    <a href="{{ route('seller.products.show', $product) }}"
                                       style="
                                            background:#2563eb;
                                            color:white;
                                            padding:8px 14px;
                                            border-radius:6px;
                                            text-decoration:none;
                                       ">
                                        Detail
                                    </a>

                                    <a href="{{ route('seller.products.edit', $product) }}"
                                       style="
                                            background:#f59e0b;
                                            color:white;
                                            padding:8px 14px;
                                            border-radius:6px;
                                            text-decoration:none;
                                       ">
                                        Edit
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
                                                padding:8px 14px;
                                                border:none;
                                                border-radius:6px;
                                                cursor:pointer;
                                            "
                                        >
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6"
                                style="padding:30px; text-align:center; color:#666;">
                                Belum ada produk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>