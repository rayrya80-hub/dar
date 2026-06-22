 @extends('layouts.app')
@section('title', 'Detail Laporan')
@section('page-title', 'Detail Laporan Perkembangan')
@section('page-subtitle', $laporan->siswa->nama ?? '')

@section('content')
<div class="card" style="max-width:800px">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <span><i class="bi bi-file-earmark-text me-2 text-primary"></i>Laporan Perkembangan</span>
        <div class="d-flex gap-2">
            <a href="{{ route('guru.laporan.edit', $laporan) }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-pencil me-1"></i>Edit
            </a>
            <a href="{{ route('guru.laporan.index') }}" class="btn btn-sm btn-outline-primary">
                <i class="bi bi-arrow-left me-1"></i>Kembali
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row g-2 mb-4">
            <div class="col-auto">
                <span class="badge bg-primary fs-6">{{ $laporan->periode_label }}</span>
            </div>
            <div class="col-auto">
                <span class="badge bg-secondary fs-6">{{ $laporan->tahun_ajaran }}</span>
            </div>
            <div class="col-auto">
                <span class="badge {{ $laporan->status == 'final' ? 'bg-success' : 'bg-warning text-dark' }} fs-6">
                    {{ $laporan->status_label }}
                </span>
            </div>
        </div>

        <table class="table table-borderless mb-4" style="font-size:14px">
            <tr><td class="text-muted" style="width:160px">Siswa</td><td><strong>{{ $laporan->siswa->nama }}</strong></td></tr>
            <tr><td class="text-muted">Kelas</td><td>{{ $laporan->siswa->kelas }}</td></tr>
            <tr><td class="text-muted">Jurusan</td><td>{{ $laporan->siswa->jurusan }}</td></tr>
            <tr><td class="text-muted">Guru Wali</td><td>{{ $laporan->guruWali->name }}</td></tr>
        </table>

        @foreach([
            'perkembangan_akademik'      => 'Perkembangan Akademik',
            'perkembangan_karakter'      => 'Perkembangan Karakter',
            'perkembangan_bakat'         => 'Perkembangan Bakat',
            'perkembangan_keterampilan'  => 'Perkembangan Keterampilan',
            'kesimpulan'                 => 'Kesimpulan',
        ] as $field => $label)
        @if($laporan->$field)
        <div class="mb-3">
            <div class="text-muted mb-1" style="font-size:12px;font-weight:600;text-transform:uppercase">{{ $label }}</div>
            <div style="font-size:14px;line-height:1.8;white-space:pre-wrap">{{ $laporan->$field }}</div>
        </div>
        <hr>
        @endif
        @endforeach

        @if($laporan->rekomendasi_ai)
        <div class="p-3 rounded" style="background:#fff8e6;border-left:4px solid #f0a500">
            <div class="mb-2" style="font-size:12px;font-weight:600;color:#854f0b;text-transform:uppercase">
                <i class="bi bi-stars me-1"></i>Rekomendasi AI
            </div>
            <div style="font-size:14px;line-height:1.8;white-space:pre-wrap">{{ $laporan->rekomendasi_ai }}</div>
        </div>
        @endif
    </div>
</div>
@endsection
