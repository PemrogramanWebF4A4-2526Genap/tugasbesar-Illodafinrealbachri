<x-app-layout>

<div style="max-width:900px; margin:auto; padding:40px;">

    <h1 style="font-size:28px; font-weight:bold; margin-bottom:15px;">
        Chat Produk: {{ $conversation->product->name }}
    </h1>

    <div style="
        background:white;
        border:1px solid #ddd;
        border-radius:10px;
        padding:20px;
        height:500px;
        overflow-y:auto;
        margin-bottom:20px;
    ">

        @foreach($conversation->messages as $message)

            <div style="
                margin-bottom:15px;
                text-align:
                {{ $message->sender_id == auth()->id() ? 'right' : 'left' }};
            ">

                <div style="
                    display:inline-block;
                    background:
                    {{ $message->sender_id == auth()->id() ? '#111' : '#eee' }};
                    color:
                    {{ $message->sender_id == auth()->id() ? 'white' : '#111' }};
                    padding:12px 16px;
                    border-radius:10px;
                    max-width:70%;
                ">
                    <strong>
                        {{ $message->sender->name }}
                    </strong>

                    <br>

                    {{ $message->message }}
                </div>

            </div>

        @endforeach

    </div>

    <form
        action="{{ route('chat.send',$conversation) }}"
        method="POST">

        @csrf

        <div style="display:flex; gap:10px;">

            <input
                type="text"
                name="message"
                placeholder="Tulis pesan..."
                style="
                    flex:1;
                    padding:12px;
                    border:1px solid #ddd;
                    border-radius:8px;
                "
                required>

            <button
                style="
                    background:#111;
                    color:white;
                    border:none;
                    padding:12px 24px;
                    border-radius:8px;
                ">
                Kirim
            </button>

        </div>

    </form>

</div>

</x-app-layout>