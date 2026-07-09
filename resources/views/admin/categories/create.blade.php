<x-app-layout>
    <div style="padding: 40px; max-width: 700px; margin: auto;">
        <h1 style="font-size: 28px; font-weight: bold; margin-bottom: 20px;">
            Tambah Kategori - CAFFIN
        </h1>

        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 15px;">
                <label>Nama Kategori</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       style="width:100%; border:1px solid #ccc; padding:10px; border-radius:6px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label>Deskripsi</label>
                <textarea name="description" rows="4"
                          style="width:100%; border:1px solid #ccc; padding:10px; border-radius:6px;">{{ old('description') }}</textarea>
            </div>

            <button type="submit"
                    style="background:black; color:white; padding:10px 20px; border-radius:6px;">
                Simpan
            </button>

            <a href="{{ route('admin.categories.index') }}"
               style="margin-left:10px; background:#ddd; padding:10px 20px; border-radius:6px;">
                Kembali
            </a>
        </form>
    </div>
</x-app-layout>