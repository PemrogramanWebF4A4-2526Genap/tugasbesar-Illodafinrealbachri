<x-app-layout>
    <div style="padding:40px; max-width:1200px; margin:auto;">
        <h1 style="font-size:32px; font-weight:bold; margin-bottom:25px;">
            Kelola Kategori - CAFFIN
        </h1>

        @if(session('success'))
            <div style="background:#d1fae5; padding:15px; border-radius:8px; margin-bottom:20px;">
                {{ session('success') }}
            </div>
        @endif

        <div style="background:white; padding:25px; border-radius:12px; margin-bottom:25px; border:1px solid #ddd;">
            <h2 style="font-size:22px; font-weight:bold; margin-bottom:15px;">
                Tambah Kategori
            </h2>

            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <div style="margin-bottom:15px;">
                    <label>Nama Kategori</label>
                    <input type="text" name="name" required
                           style="width:100%; border:1px solid #ccc; padding:10px; border-radius:6px;">
                </div>

                <div style="margin-bottom:15px;">
                    <label>Deskripsi</label>
                    <textarea name="description" rows="3"
                              style="width:100%; border:1px solid #ccc; padding:10px; border-radius:6px;"></textarea>
                </div>

                <button type="submit"
                        style="background:black; color:white; padding:10px 20px; border-radius:6px;">
                    + Simpan Kategori
                </button>
            </form>
        </div>

        <div style="background:white; border:1px solid #ddd; border-radius:12px; overflow:hidden;">
            <table style="width:100%; border-collapse:collapse;">
                <thead style="background:#f3f4f6;">
                    <tr>
                        <th style="padding:12px;">No</th>
                        <th style="padding:12px;">Nama Kategori</th>
                        <th style="padding:12px;">Deskripsi</th>
                        <th style="padding:12px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($categories as $category)
                        <tr style="border-top:1px solid #ddd;">
                            <td style="padding:12px;">{{ $loop->iteration }}</td>
                            <td style="padding:12px;"><strong>{{ $category->name }}</strong></td>
                            <td style="padding:12px;">{{ $category->description ?? '-' }}</td>
                            <td style="padding:12px;">
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                   style="background:#f59e0b; color:white; padding:8px 14px; border-radius:6px;">
                                    Edit
                                </a>

                                <form action="{{ route('admin.categories.destroy', $category) }}"
                                      method="POST"
                                      style="display:inline;"
                                      onsubmit="return confirm('Yakin hapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            style="background:#dc2626; color:white; padding:8px 14px; border-radius:6px; border:none;">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="padding:20px; text-align:center;">
                                Belum ada kategori.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>