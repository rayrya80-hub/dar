<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Smart Assistant Guru Wali</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { min-height:100vh; background:linear-gradient(135deg,#1a3a6b 0%,#2563a8 100%); display:flex; align-items:center; justify-content:center; }
        .login-card { background:white; border-radius:16px; padding:40px; width:100%; max-width:420px; box-shadow:0 20px 60px rgba(0,0,0,0.2); }
        .login-logo { width:64px; height:64px; background:#1a3a6b; border-radius:16px; display:flex; align-items:center; justify-content:center; font-size:28px; color:white; margin:0 auto 20px; }
        .form-control:focus { border-color:#1a3a6b; box-shadow:0 0 0 3px rgba(26,58,107,0.1); }
        .btn-login { background:#1a3a6b; border:none; padding:12px; font-weight:600; }
        .btn-login:hover { background:#142d54; }
    </style>
</head>
<body>
<div class="login-card">
    <div class="login-logo"><i class="bi bi-mortarboard-fill"></i></div>
    <h5 class="text-center fw-bold mb-1">Smart Assistant Guru Wali</h5>
    <p class="text-center text-muted mb-4" style="font-size:13px">SMKN 1 Sungailiat</p>
    @if($errors->any())
    <div class="alert alert-danger py-2" style="font-size:13px">
        <i class="bi bi-exclamation-circle me-1"></i>{{ $errors->first() }}
    </div>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold" style="font-size:14px">Email</label>
            <input type="email" name="email" class="form-control" placeholder="email@smkn1sungailiat.sch.id" value="{{ old('email') }}" required autofocus>
        </div>
        <div class="mb-4">
            <label class="form-label fw-semibold" style="font-size:14px">Password</label>
            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn btn-login btn-primary w-100 text-white">
            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
        </button>
    </form>
    <div class="mt-4 p-3 bg-light rounded" style="font-size:12px">
        <div class="fw-semibold mb-1 text-muted">Akun Demo:</div>
        <div>Admin: <code>admin@smkn1sungailiat.sch.id</code></div>
        <div>Guru Wali: <code>budi@smkn1sungailiat.sch.id</code></div>
        <div>Password: <code>password123</code></div>
    </div>
</div>
</body>
</html>