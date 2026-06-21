@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')
@section('page-subtitle', 'Kelola data sistem')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex align-items-center gap-3">
                <div class="icon" style="background:#e3f0ff"><i class="bi bi-people text-primary"></i></div>
                <div>
                    <div style="font-size:28px;font-weight:700;color:#1a3a6b">{{ $data['total_siswa'] }}</div>
                    <div class="text-muted" style="font-size:13px">Total Siswa</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex align-items-center gap-3">
                <div class="icon" style="background:#e6f9f0"><i class="bi bi-person-badge" style="color:#0f6e56"></i></div>
                <div>
                    <div style="font-size:28px;font-weight:700;color:#0f6e56">{{ $data['total_guru'] }}</div>
                    <div class="text-muted" style="font-size:13px">Guru Wali</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex align-items-center gap-3">
                <div class="icon" style="background:#fff8e6"><i class="bi bi-journal-text" style="color:#854f0b"></i></div>
                <div>
                    <div style="font-size:28px;font-weight:700;color:#854f0b">{{ $data['total_jurnal'] }}</div>
                    <div class="text-muted" style="font-size:13px">Total Jurnal</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex align-items-center gap-3">
                <div class="icon" style="background:#f0ecff"><i class="bi bi-file-earmark-text" style="color:#534ab7"></i></div>
                <div>
                    <div style="font-size:28px;font-weight:700;color:#534ab7">{{ $data['total_laporan'] }}</div>
                    <div class="text-muted" style="font-size:13px">Total Laporan</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header py-3"><i class="bi bi-info-circle me-2 text-primary"></i>Informasi Sistem</div>
    <div class="card-body">
        <p class="text-muted mb-0" style="font-size:14px">Selamat datang di Smart Assistant Guru Wali SMKN 1 Sungailiat. Gunakan menu di sebelah kiri untuk mengelola data.</p>
    </div>
</div>
@endsection