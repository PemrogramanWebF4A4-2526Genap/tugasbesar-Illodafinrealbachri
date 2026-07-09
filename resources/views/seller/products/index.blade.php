<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Produk Saya - CAFFIN
            </h2>

            <a href="{{ route('seller.products.create') }}"
               class="px-4 py-2 bg-black text-white rounded">
                + Tambah Produk
            </a>
        </div>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto">

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3">Gambar</th>
                        <th class="px-4 py-3">Produk</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Harga</th>
                        <th class="px-4 py-3">Stok</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($products as $product)
                        <tr class="border-t">

                            <td class="px-4 py-3">
                                @if($product->image)
                                    <img src="{{ asset('storage/'.$product->image) }}"
                                         class="w-16 h-16 object-cover rounded">
                                @else
                                    -
                                @endif
                            </td>

                            <td class="px-4 py-3">
                                {{ $product->name }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $product->category->name }}
                            </td>

                            <td class="px-4 py-3">
                                Rp {{ number_format($product->price,0,',','.') }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $product->stock }}
                            </td>

                            <td class="px-4 py-3 flex gap-2">

                                <a href="{{ route('seller.products.edit',$product) }}"
                                   class="px-3 py-1 bg-yellow-500 text-white rounded">
                                    Edit
                                </a>

                                <form action="{{ route('seller.products.destroy',$product) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            onclick="return confirm('Yakin hapus produk?')"
                                            class="px-3 py-1 bg-red-600 text-white rounded">
                                        Hapus
                                    </button>
                                </form>

                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-6">
                                Belum ada produk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</x-app-layout>