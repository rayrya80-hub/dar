 @extends('layouts.app')
@section('title', 'Detail Jurnal')
@section('page-title', 'Detail Jurnal Pertemuan')
@section('page-subtitle', $jurnal->siswa->nama ?? '')

@section('content')
<div class="card" style="max-width:700px">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <span><i class="bi bi-journal-text me-2 text-primary"></i>Detail Jurnal</span>
        <div class="d-flex gap-2">
            <a href="{{ route('guru.jurnal.edit', $jurnal) }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-pencil me-1"></i>Edit
            </a>
            <a href="{{ route('guru.jurnal.index') }}" class="btn btn-sm btn-outline-primary">
                <i class="bi bi-arrow-left me-1"></i>Kembali
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-borderless" style="font-size:14px">
            <tr><td class="text-muted" style="width:160px">Siswa</td><td><strong>{{ $jurnal->siswa->nama }}</strong></td></tr>
            <tr><td class="text-muted">Kelas</td><td>{{ $jurnal->siswa->kelas }}</td></tr>
            <tr><td class="text-muted">Tanggal</td><td>{{ $jurnal->tanggal_pertemuan->format('d F Y') }}</td></tr>
            <tr><td class="text-muted">Jenis Pertemuan</td><td>{{ $jurnal->jenis_pertemuan_label }}</td></tr>
            <tr><td class="text-muted">Aspek</td><td><span class="badge badge-{{ $jurnal->aspek }}">{{ $jurnal->aspek_label }}</span></td></tr>
            <tr><td class="text-muted">Guru Wali</td><td>{{ $jurnal->guruWali->name }}</td></tr>
        </table>
        <hr>
        <div class="mb-3">
            <div class="text-muted mb-1" style="font-size:13px;font-weight:600">CATATAN PERTEMUAN</div>
            <div style="font-size:14px;line-height:1.8;white-space:pre-wrap">{{ $jurnal->catatan }}</div>
        </div>
        @if($jurnal->tindak_lanjut)
        <div>
            <div class="text-muted mb-1" style="font-size:13px;font-weight:600">TINDAK LANJUT</div>
            <div style="font-size:14px;line-height:1.8;white-space:pre-wrap">{{ $jurnal->tindak_lanjut }}</div>
        </div>
        @endif
    </div>
</div>
@endsection
