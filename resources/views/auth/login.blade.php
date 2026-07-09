<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - CAFFIN</title>
</head>
<body style="margin:0; font-family:Arial, sans-serif; background:#111;">

<div style="min-height:100vh; display:flex;">
    <div style="flex:1; background:#111; color:white; padding:70px; display:flex; flex-direction:column; justify-content:center;">
        <a href="{{ route('home') }}" style="color:white; text-decoration:none; font-size:34px; font-weight:900; letter-spacing:3px;">
            CAFFIN
        </a>

        <h1 style="font-size:56px; line-height:1.05; margin:35px 0 15px;">
            Welcome Back.
        </h1>

        <p style="font-size:18px; color:#ccc; max-width:460px; line-height:1.7;">
            Masuk ke akun CAFFIN untuk checkout, melihat pesanan, dan menikmati pengalaman belanja fashion.
        </p>
    </div>

    <div style="flex:1; background:#f5f5f5; display:flex; align-items:center; justify-content:center; padding:40px;">
        <div style="width:420px; background:white; padding:40px; border-radius:12px;">
            <h2 style="font-size:32px; margin:0 0 8px;">Login</h2>
            <p style="color:#666; margin-bottom:30px;">Masuk ke akun kamu.</p>

            @if(session('status'))
                <div style="background:#d1fae5; padding:12px; border-radius:6px; margin-bottom:15px;">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div style="margin-bottom:18px;">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           style="width:100%; padding:13px; border:1px solid #ccc; border-radius:6px; margin-top:6px;">
                    @error('email')
                        <p style="color:red; font-size:13px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-bottom:18px;">
                    <label>Password</label>
                    <input type="password" name="password" required
                           style="width:100%; padding:13px; border:1px solid #ccc; border-radius:6px; margin-top:6px;">
                    @error('password')
                        <p style="color:red; font-size:13px;">{{ $message }}</p>
                    @enderror
                </div>

                <label style="display:flex; align-items:center; gap:8px; margin-bottom:22px; color:#555;">
                    <input type="checkbox" name="remember">
                    Remember me
                </label>

                <button type="submit"
                        style="width:100%; background:#111; color:white; padding:14px; border:none; border-radius:6px; font-weight:bold;">
                    LOGIN
                </button>
            </form>

            <p style="margin-top:25px; color:#666; text-align:center;">
                Belum punya akun?
                <a href="{{ route('register') }}" style="color:#111; font-weight:bold;">Register</a>
            </p>

            <p style="text-align:center; margin-top:10px;">
                <a href="{{ route('home') }}" style="color:#777;">← Kembali ke CAFFIN</a>
            </p>
        </div>
    </div>
</div>

</body>
</html>