<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Smart Assistant Guru Wali') — SMKN 1 Sungailiat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background:#f4f6f9; font-family:'Segoe UI',sans-serif; }
        .sidebar { min-height:100vh; width:250px; background:#1a3a6b; position:fixed; top:0; left:0; z-index:100; }
        .sidebar-brand { background:#142d54; padding:20px 16px; color:white; font-weight:600; font-size:14px; border-bottom:1px solid rgba(255,255,255,0.1); }
        .sidebar-brand small { font-size:11px; opacity:0.7; display:block; margin-top:2px; }
        .sidebar .nav-link { color:rgba(255,255,255,0.75); padding:10px 20px; font-size:14px; display:flex; align-items:center; gap:10px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color:white; background:rgba(255,255,255,0.12); border-left:3px solid #4da3ff; }
        .sidebar .nav-section { font-size:10px; color:rgba(255,255,255,0.4); padding:16px 20px 6px; text-transform:uppercase; letter-spacing:0.08em; }
        .main-content { margin-left:250px; padding:24px; min-height:100vh; }
        .topbar { background:white; border-radius:10px; padding:12px 20px; margin-bottom:24px; display:flex; align-items:center; justify-content:space-between; box-shadow:0 1px 4px rgba(0,0,0,0.06); }
        .stat-card { background:white; border-radius:12px; padding:20px; box-shadow:0 1px 4px rgba(0,0,0,0.06); }
        .stat-card .icon { width:48px; height:48px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:22px; }
        .card { border:none; border-radius:12px; box-shadow:0 1px 4px rgba(0,0,0,0.06); }
        .card-header { background:white; border-bottom:1px solid #f0f0f0; font-weight:600; border-radius:12px 12px 0 0 !important; }
        .btn-primary { background:#1a3a6b; border-color:#1a3a6b; }
        .btn-primary:hover { background:#142d54; border-color:#142d54; }
        .table th { font-size:12px; text-transform:uppercase; color:#6c757d; font-weight:600; }
        .badge-akademik { background:#e3f0ff; color:#1a3a6b; }
        .badge-karakter { background:#e6f9f0; color:#0f6e56; }
        .badge-bakat { background:#fff8e6; color:#854f0b; }
        .badge-keterampilan { background:#f0ecff; color:#534ab7; }
        .badge-lainnya { background:#f5f5f5; color:#555; }
    </style>
</head>
<body>
<div class="sidebar">
    <div class="sidebar-brand">
        <i class="bi bi-mortarboard-fill me-2"></i> Smart Assistant
        <small>SMKN 1 Sungailiat</small>
    </div>
    <nav class="mt-2">
        @auth
        <div class="nav-section">Menu Utama</div>
        @role('admin')
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="{{ route('admin.siswa.index') }}" class="nav-link {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Data Siswa
        </a>
        @endrole
        @role('guru_wali')
        <a href="{{ route('guru.dashboard') }}" class="nav-link {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="{{ route('guru.siswa.index') }}" class="nav-link {{ request()->routeIs('guru.siswa.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Siswa Dampingan
        </a>
        <a href="{{ route('guru.jurnal.index') }}" class="nav-link {{ request()->routeIs('guru.jurnal.*') ? 'active' : '' }}">
            <i class="bi bi-journal-text"></i> Jurnal Pertemuan
        </a>
        <a href="{{ route('guru.laporan.index') }}" class="nav-link {{ request()->routeIs('guru.laporan.*') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-text"></i> Laporan Perkembangan
        </a>
        @endrole
        @role('orang_tua')
        <a href="{{ route('ortu.dashboard') }}" class="nav-link {{ request()->routeIs('ortu.dashboard') ? 'active' : '' }}">
            <i class="bi bi-house"></i> Dashboard
        </a>
        @endrole
        @role('siswa')
        <a href="{{ route('siswa.dashboard') }}" class="nav-link {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
            <i class="bi bi-house"></i> Dashboard
        </a>
        @endrole
        <div class="nav-section">Akun</div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link w-100 border-0 bg-transparent text-start">
                <i class="bi bi-box-arrow-left"></i> Keluar
            </button>
        </form>
        @endauth
    </nav>
</div>
<div class="main-content">
    <div class="topbar">
        <div>
            <h6 class="mb-0 fw-bold">@yield('page-title', 'Dashboard')</h6>
            <small class="text-muted">@yield('page-subtitle', '')</small>
        </div>
        <div class="d-flex align-items-center gap-3">
            <span class="badge bg-primary">{{ Auth::user()->roles->first()->name ?? '' }}</span>
            <strong style="font-size:14px">{{ Auth::user()->name ?? '' }}</strong>
        </div>
    </div>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>