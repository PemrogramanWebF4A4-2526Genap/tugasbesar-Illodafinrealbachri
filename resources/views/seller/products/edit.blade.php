<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Produk - CAFFIN
        </h2>
    </x-slot>

    <div class="py-12 max-w-3xl mx-auto">
        <div class="bg-white p-6 rounded shadow">
            <form action="{{ route('seller.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block font-medium mb-1">Kategori</label>
                    <select name="category_id" class="w-full border-gray-300 rounded">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Nama Produk</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border-gray-300 rounded">
                    @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Deskripsi</label>
                    <textarea name="description" rows="4" class="w-full border-gray-300 rounded">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Harga</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full border-gray-300 rounded">
                    @error('price') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Stok</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full border-gray-300 rounded">
                    @error('stock') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Gambar Produk</label>

                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" class="w-24 h-24 object-cover rounded mb-2">
                    @endif

                    <input type="file" name="image" class="w-full border-gray-300 rounded">
                    @error('image') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <button class="px-4 py-2 bg-black text-white rounded">Update</button>
                <a href="{{ route('seller.products.index') }}" class="px-4 py-2 bg-gray-200 rounded">Kembali</a>
            </form>
        </div>
    </div>
</x-app-layout>