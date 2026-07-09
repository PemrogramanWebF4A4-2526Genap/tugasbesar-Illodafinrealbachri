<x-app-layout>
    <div style="padding:40px; max-width:800px; margin:auto;">

        <h1 style="font-size:32px; font-weight:bold; margin-bottom:25px;">
            Tambah Produk - CAFFIN
        </h1>

        <form
            action="{{ route('seller.products.store') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            <div style="margin-bottom:15px;">
                <label>Kategori</label>

                <select
                    name="category_id"
                    required
                    style="width:100%; border:1px solid #ccc; padding:10px; border-radius:6px;">

                    <option value="">Pilih Kategori</option>

                    @foreach($categories as $category)

                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>

                    @endforeach

                </select>
            </div>

            <div style="margin-bottom:15px;">
                <label>Nama Produk</label>

                <input
                    type="text"
                    name="name"
                    required
                    style="width:100%; border:1px solid #ccc; padding:10px; border-radius:6px;">
            </div>

            <div style="margin-bottom:15px;">
                <label>Deskripsi Produk</label>

                <textarea
                    name="description"
                    rows="5"
                    style="width:100%; border:1px solid #ccc; padding:10px; border-radius:6px;"></textarea>
            </div>

            <div style="margin-bottom:15px;">
                <label>Harga</label>

                <input
                    type="number"
                    name="price"
                    required
                    style="width:100%; border:1px solid #ccc; padding:10px; border-radius:6px;">
            </div>

            <div style="margin-bottom:15px;">
                <label>Stok</label>

                <input
                    type="number"
                    name="stock"
                    required
                    style="width:100%; border:1px solid #ccc; padding:10px; border-radius:6px;">
            </div>

            <div style="margin-bottom:15px;">
                <label>Foto Utama Produk</label>

                <input
                    type="file"
                    name="image"
                    accept="image/*">
            </div>

            <div style="margin-bottom:15px;">
                <label>
                    Gallery Produk
                    <small>(Minimal 3 foto - Maksimal 10 foto)</small>
                </label>

                <input
                    type="file"
                    name="images[]"
                    id="galleryInput"
                    multiple
                    accept="image/*"
                    style="
                        width:100%;
                        border:1px solid #ccc;
                        padding:10px;
                        border-radius:6px;
                    ">

                <div
                    id="previewGallery"
                    style="
                        display:grid;
                        grid-template-columns:repeat(5,1fr);
                        gap:10px;
                        margin-top:15px;
                    ">
                </div>
            </div>

            <button
                type="submit"
                style="
                    background:black;
                    color:white;
                    border:none;
                    padding:12px 24px;
                    border-radius:6px;
                ">
                Simpan Produk
            </button>

        </form>

    </div>

<script>
document.getElementById('galleryInput').addEventListener('change', function(event) {

    const preview = document.getElementById('previewGallery');

    preview.innerHTML = '';

    const files = Array.from(event.target.files);



    if (files.length > 10) {

        alert('Maksimal upload 10 gambar gallery');

        event.target.value = '';

        return;
    }

    files.forEach(file => {

        const reader = new FileReader();

        reader.onload = function(e) {

            const img = document.createElement('img');

            img.src = e.target.result;

            img.style.width = '100%';
            img.style.height = '120px';
            img.style.objectFit = 'cover';
            img.style.borderRadius = '6px';
            img.style.border = '1px solid #ddd';

            preview.appendChild(img);
        };

        reader.readAsDataURL(file);
    });

});
</script>

</x-app-layout>