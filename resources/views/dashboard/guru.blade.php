 @extends('layouts.app')
@section('title', 'Dashboard Guru Wali')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Selamat datang, ' . Auth::user()->name)

@section('content')
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="d-flex align-items-center gap-3">
                <div class="icon" style="background:#e3f0ff"><i class="bi bi-people text-primary"></i></div>
                <div>
                    <div style="font-size:28px;font-weight:700;color:#1a3a6b">{{ $data['total_siswa'] }}</div>
                    <div class="text-muted" style="font-size:13px">Siswa Dampingan</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="d-flex align-items-center gap-3">
                <div class="icon" style="background:#e6f9f0"><i class="bi bi-journal-text" style="color:#0f6e56"></i></div>
                <div>
                    <div style="font-size:28px;font-weight:700;color:#0f6e56">{{ $data['total_jurnal'] }}</div>
                    <div class="text-muted" style="font-size:13px">Total Jurnal</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="d-flex align-items-center gap-3">
                <div class="icon" style="background:#fff8e6"><i class="bi bi-file-earmark-text" style="color:#854f0b"></i></div>
                <div>
                    <div style="font-size:28px;font-weight:700;color:#854f0b">{{ $data['total_laporan'] }}</div>
                    <div class="text-muted" style="font-size:13px">Laporan Dibuat</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center py-3">
                <span><i class="bi bi-journal-text me-2 text-primary"></i>Jurnal Terbaru</span>
                <a href="{{ route('guru.jurnal.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus"></i> Tambah Jurnal
                </a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Siswa</th>
                            <th>Tanggal</th>
                            <th>Aspek</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data['jurnal_terbaru'] as $j)
                        <tr>
                            <td class="ps-3">
                                <strong style="font-size:14px">{{ $j->siswa->nama }}</strong>
                                <div class="text-muted" style="font-size:12px">{{ $j->siswa->kelas }}</div>
                            </td>
                            <td style="font-size:13px">{{ $j->tanggal_pertemuan->format('d M Y') }}</td>
                            <td><span class="badge badge-{{ $j->aspek }}">{{ $j->aspek_label }}</span></td>
                            <td style="font-size:13px">{{ Str::limit($j->catatan, 60) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4" style="font-size:13px">
                                Belum ada jurnal. <a href="{{ route('guru.jurnal.create') }}">Buat jurnal pertama</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header py-3"><i class="bi bi-lightning me-2 text-warning"></i>Aksi Cepat</div>
            <div class="card-body d-flex flex-column gap-2">
                <a href="{{ route('guru.jurnal.create') }}" class="btn btn-outline-primary btn-sm text-start">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Jurnal Pertemuan
                </a>
                <a href="{{ route('guru.siswa.index') }}" class="btn btn-outline-success btn-sm text-start">
                    <i class="bi bi-people me-2"></i>Lihat Siswa Dampingan
                </a>
                <a href="{{ route('guru.laporan.create') }}" class="btn btn-outline-warning btn-sm text-start">
                    <i class="bi bi-file-earmark-plus me-2"></i>Buat Laporan Perkembangan
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
