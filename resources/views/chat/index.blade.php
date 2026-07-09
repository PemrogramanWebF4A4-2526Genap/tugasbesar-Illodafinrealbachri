<x-app-layout>

<div style="max-width:1000px; margin:auto; padding:40px;">

    <h1 style="
        font-size:32px;
        font-weight:bold;
        margin-bottom:25px;
    ">
        Inbox Chat
    </h1>

    @forelse($conversations as $conversation)

        <a href="{{ route('chat.show',$conversation) }}"
           style="
                display:block;
                background:white;
                border:1px solid #ddd;
                border-radius:10px;
                padding:20px;
                margin-bottom:15px;
                text-decoration:none;
                color:#111;
           ">

            <h3>

                @if(auth()->user()->role === 'seller')

                    {{ $conversation->buyer->name }}

                @else

                    {{ $conversation->seller->name }}

                @endif

            </h3>

            <p>
                Produk:
                {{ $conversation->product->name }}
            </p>

        </a>

    @empty

        <p>Belum ada percakapan.</p>

    @endforelse

</div>

</x-app-layout>