<x-app-layout>

<div style="padding:40px; max-width:1200px; margin:auto;">

    <h1 style="font-size:32px; font-weight:bold; margin-bottom:30px;">
        Wishlist Saya
    </h1>

    <div style="
        display:grid;
        grid-template-columns:repeat(4,1fr);
        gap:20px;
    ">

        @forelse($wishlists as $wishlist)

            <div style="
                background:white;
                border-radius:10px;
                overflow:hidden;
                border:1px solid #ddd;
            ">

                @if($wishlist->product->image)
                    <img
                        src="{{ asset('storage/'.$wishlist->product->image) }}"
                        style="
                            width:100%;
                            height:250px;
                            object-fit:cover;
                        ">
                @endif

                <div style="padding:15px;">

                    <p style="color:#888;">
                        {{ $wishlist->product->category->name }}
                    </p>

                    <h3>
                        {{ $wishlist->product->name }}
                    </h3>

                    <p style="
                        font-size:20px;
                        font-weight:bold;
                    ">
                        Rp {{ number_format($wishlist->product->price,0,',','.') }}
                    </p>

                    <form
                        action="{{ route('buyer.wishlist.destroy',$wishlist) }}"
                        method="POST">

                        @csrf
                        @method('DELETE')

                        <button
                            style="
                                width:100%;
                                background:#dc2626;
                                color:white;
                                padding:10px;
                                border:none;
                                border-radius:6px;
                                margin-top:10px;
                            ">
                            Hapus Wishlist
                        </button>

                    </form>

                </div>

            </div>

        @empty

            <p>Belum ada produk favorit.</p>

        @endforelse

    </div>

</div>

</x-app-layout>