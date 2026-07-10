<nav style="background:white; border-bottom:1px solid #ddd;">
    <div style="max-width:1200px; margin:auto; padding:16px 30px; display:flex; justify-content:space-between; align-items:center;">

        <div style="display:flex; align-items:center; gap:25px;">
            <a href="{{ route('home') }}" style="display:flex; align-items:center;">
            <img src="{{ asset('images/logo-caffin.png') }}"
                alt="CAFFIN"
                style="height:55px; width:auto;">
            </a>

            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" style="color:#111; text-decoration:none;">Dashboard</a>
                    <a href="{{ route('admin.categories.index') }}" style="color:#111; text-decoration:none;">Kategori</a>
                    <a href="{{ route('admin.orders.index') }}" style="color:#111; text-decoration:none;">Pesanan</a>
                    <a href="{{ route('admin.users.index') }}" style="color:#111; text-decoration:none;">User</a>
                @endif

                @if(auth()->user()->role === 'seller')
                    <a href="{{ route('seller.dashboard') }}" style="color:#111; text-decoration:none;">Dashboard</a>
                    <a href="{{ route('seller.products.index') }}" style="color:#111; text-decoration:none;">Produk Saya</a>
                    <a href="{{ route('seller.products.create') }}" style="color:#111; text-decoration:none;">Tambah Produk</a>
                    <a href="{{ route('seller.orders.index') }}" style="color:#111; text-decoration:none;">Pesanan Produk</a>
                    <a href="{{ route('chat.index') }}"style="color:#111; text-decoration:none;">Chat</a>
                    
                @endif

                @if(auth()->user()->role === 'buyer')
                    <a href="{{ route('buyer.dashboard') }}" style="color:#111; text-decoration:none;">Dashboard</a>
                    <a href="{{ route('public.products.index') }}" style="color:#111; text-decoration:none;">Produk</a>
                    <a href="{{ route('buyer.cart.index') }}" style="color:#111; text-decoration:none;">Keranjang</a>
                    <a href="{{ route('buyer.orders.index') }}" style="color:#111; text-decoration:none;">Pesanan Saya</a>
                    <a href="{{ route('chat.index') }}" style="color:#111; text-decoration:none;">Chat</a>
                @endif
            @endauth
        </div>

        <div>
            @auth
                <span style="margin-right:15px; color:#555;">
                    {{ Auth::user()->name }} ({{ Auth::user()->role }})
                </span>

                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:#111; color:white; border:none; padding:8px 14px; border-radius:6px; cursor:pointer;">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" style="margin-right:15px; color:#111; text-decoration:none;">Login</a>
                <a href="{{ route('register') }}" style="background:#111; color:white; padding:8px 14px; border-radius:6px; text-decoration:none;">Register</a>
            @endauth
        </div>
    </div>
</nav>