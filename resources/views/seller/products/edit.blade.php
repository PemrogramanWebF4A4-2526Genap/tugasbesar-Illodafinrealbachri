<x-app-layout>
    <div style="padding:40px; max-width:800px; margin:auto;">

        <a href="{{ route('seller.products.index') }}"
           style="
                display:inline-block;
                color:#111;
                margin-bottom:20px;
           ">
            ← Kembali ke Produk Saya
        </a>

        <h1 style="font-size:30px; font-weight:bold; margin-bottom:25px;">
            Edit Produk
        </h1>

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

        <form
            action="{{ route('seller.products.update', $product) }}"
            method="POST"
            enctype="multipart/form-data"
            style="
                background:white;
                padding:25px;
                border:1px solid #ddd;
                border-radius:12px;
            "
        >
            @csrf
            @method('PUT')

            <div style="margin-bottom:18px;">
                <label style="display:block; font-weight:bold; margin-bottom:7px;">
                    Kategori
                </label>

                <select
                    name="category_id"
                    required
                    style="
                        width:100%;
                        padding:11px;
                        border:1px solid #ccc;
                        border-radius:6px;
                        box-sizing:border-box;
                    "
                >
                    <option value="">Pilih Kategori</option>

                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block; font-weight:bold; margin-bottom:7px;">
                    Nama Produk
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $product->name) }}"
                    required
                    style="
                        width:100%;
                        padding:11px;
                        border:1px solid #ccc;
                        border-radius:6px;
                        box-sizing:border-box;
                    "
                >
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block; font-weight:bold; margin-bottom:7px;">
                    Deskripsi
                </label>

                <textarea
                    name="description"
                    rows="6"
                    style="
                        width:100%;
                        padding:11px;
                        border:1px solid #ccc;
                        border-radius:6px;
                        box-sizing:border-box;
                    "
                >{{ old('description', $product->description) }}</textarea>
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block; font-weight:bold; margin-bottom:7px;">
                    Harga
                </label>

                <input
                    type="number"
                    name="price"
                    value="{{ old('price', $product->price) }}"
                    min="0"
                    step="1"
                    required
                    style="
                        width:100%;
                        padding:11px;
                        border:1px solid #ccc;
                        border-radius:6px;
                        box-sizing:border-box;
                    "
                >

                <small style="color:#666;">
                    Contoh: masukkan 149000 untuk harga Rp149.000.
                </small>
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block; font-weight:bold; margin-bottom:7px;">
                    Stok
                </label>

                <input
                    type="number"
                    name="stock"
                    value="{{ old('stock', $product->stock) }}"
                    min="0"
                    required
                    style="
                        width:100%;
                        padding:11px;
                        border:1px solid #ccc;
                        border-radius:6px;
                        box-sizing:border-box;
                    "
                >
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block; font-weight:bold; margin-bottom:7px;">
                    Gambar Utama Saat Ini
                </label>

                @if($product->image)
                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        style="
                            width:180px;
                            height:180px;
                            object-fit:cover;
                            border-radius:8px;
                            border:1px solid #ddd;
                            margin-bottom:10px;
                        "
                    >
                @else
                    <p style="color:#777;">Belum ada gambar utama.</p>
                @endif
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block; font-weight:bold; margin-bottom:7px;">
                    Ganti Gambar Utama
                </label>

                <input
                    type="file"
                    name="image"
                    accept="image/*"
                >

                <small style="display:block; color:#666; margin-top:6px;">
                    Kosongkan jika gambar tidak ingin diganti.
                </small>
            </div>

            <div style="margin-bottom:22px;">
                <label style="display:block; font-weight:bold; margin-bottom:7px;">
                    Tambah Gambar Gallery
                </label>

                <input
                    type="file"
                    name="images[]"
                    multiple
                    accept="image/*"
                >

                <small style="display:block; color:#666; margin-top:6px;">
                    Opsional, maksimal 10 gambar tambahan.
                </small>
            </div>

            @if($product->images->count() > 0)
                <div style="margin-bottom:22px;">
                    <label style="display:block; font-weight:bold; margin-bottom:10px;">
                        Gallery Saat Ini
                    </label>

                    <div style="
                        display:grid;
                        grid-template-columns:repeat(4, 1fr);
                        gap:10px;
                    ">
                        @foreach($product->images as $image)
                            <img
                                src="{{ asset('storage/' . $image->image) }}"
                                alt="Gallery {{ $product->name }}"
                                style="
                                    width:100%;
                                    height:120px;
                                    object-fit:cover;
                                    border-radius:6px;
                                    border:1px solid #ddd;
                                "
                            >
                        @endforeach
                    </div>
                </div>
            @endif

            <div style="display:flex; gap:10px;">
                <button
                    type="submit"
                    style="
                        background:#111;
                        color:white;
                        border:none;
                        padding:12px 22px;
                        border-radius:6px;
                        cursor:pointer;
                        font-weight:bold;
                    "
                >
                    Simpan Perubahan
                </button>

                <a href="{{ route('seller.products.index') }}"
                   style="
                        background:#e5e7eb;
                        color:#111;
                        padding:12px 22px;
                        border-radius:6px;
                        text-decoration:none;
                   ">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-app-layout>