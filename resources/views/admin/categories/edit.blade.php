<x-app-layout>
    <div style="padding:40px; max-width:900px; margin:auto;">
        <h1 style="font-size:32px; font-weight:bold; margin-bottom:25px;">
            Edit Kategori - CAFFIN
        </h1>

        <div style="background:white; padding:25px; border-radius:12px; border:1px solid #ddd;">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')

                <div style="margin-bottom:15px;">
                    <label>Nama Kategori</label>
                    <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                           style="width:100%; border:1px solid #ccc; padding:10px; border-radius:6px;">
                </div>

                <div style="margin-bottom:15px;">
                    <label>Deskripsi</label>
                    <textarea name="description" rows="5"
                              style="width:100%; border:1px solid #ccc; padding:10px; border-radius:6px;">{{ old('description', $category->description) }}</textarea>
                </div>

                <button type="submit"
                        style="background:black; color:white; padding:10px 20px; border-radius:6px; border:none;">
                    Update Kategori
                </button>

                <a href="{{ route('admin.categories.index') }}"
                   style="margin-left:10px; background:#e5e7eb; color:#111; padding:10px 20px; border-radius:6px;">
                    Kembali
                </a>
            </form>
        </div>
    </div>
</x-app-layout>