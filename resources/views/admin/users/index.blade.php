<x-app-layout>
    <div style="padding:40px; max-width:1200px; margin:auto;">
        <h1 style="font-size:32px; font-weight:bold; margin-bottom:25px;">
            Manage User
        </h1>

        @if(session('success'))
            <div style="background:#d1fae5; padding:15px; border-radius:8px; margin-bottom:20px;">
                {{ session('success') }}
            </div>
        @endif

        <div style="background:white; border:1px solid #ddd; border-radius:12px; overflow:hidden;">
            <table style="width:100%; border-collapse:collapse;">
                <thead style="background:#f3f4f6;">
                    <tr>
                        <th style="padding:12px;">Nama</th>
                        <th style="padding:12px;">Email</th>
                        <th style="padding:12px;">Role</th>
                        <th style="padding:12px;">Tanggal Daftar</th>
                        <th style="padding:12px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                        <tr style="border-top:1px solid #ddd;">
                            <td style="padding:12px;">{{ $user->name }}</td>
                            <td style="padding:12px;">{{ $user->email }}</td>
                            <td style="padding:12px;">{{ ucfirst($user->role) }}</td>
                            <td style="padding:12px;">{{ $user->created_at->format('d M Y') }}</td>
                            <td style="padding:12px;">
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin hapus user ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button style="background:#dc2626; color:white; padding:8px 14px; border:none; border-radius:6px;">
                                            Hapus
                                        </button>
                                    </form>
                                @else
                                    <span>Akun aktif</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>