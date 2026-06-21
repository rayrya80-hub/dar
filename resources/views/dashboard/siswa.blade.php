 @extends('layouts.app')
@section('title', 'Dashboard Siswa')
@section('page-title', 'Dashboard Siswa')
@section('page-subtitle', 'Pantau perkembangan kamu')

@section('content')
@if($siswa)
<div class="card mb-4">
    <div class="card-header py-3"><i class="bi bi-person-circle me-2 text-primary"></i>Profil Saya</div>
    <div class="card-body">
        <table class="table table-borderless mb-0" style="font-size:14px">
            <tr><td class="text-muted" style="width:140px">Nama</td><td><strong>{{ $siswa->nama }}</strong></td></tr>
            <tr><td class="text-muted">NIS</td><td>{{ $siswa->nis }}</td></tr>
            <tr><td class="text-muted">Kelas</td><td>{{ $siswa->kelas }}</td></tr>
            <tr><td class="text-muted">Jurusan</td><td>{{ $siswa->jurusan }}</td></tr>
            <tr><td class="text-muted">Guru Wali</td><td>{{ $siswa->guruWali->name ?? '-' }}</td></tr>
        </table>
    </div>
</div>
<div class="card">
    <div class="card-header py-3"><i class="bi bi-journal-text me-2 text-primary"></i>Riwayat Pertemuan</div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr><th class="ps-3">Tanggal</th><th>Aspek</th><th>Catatan</th><th>Tindak Lanjut</th></tr>
            </thead>
            <tbody>
                @forelse($jurnal as $j)
                <tr>
                    <td class="ps-3" style="font-size:13px">{{ $j->tanggal_pertemuan->format('d M Y') }}</td>
                    <td><span class="badge badge-{{ $j->aspek }}">{{ $j->aspek_label }}</span></td>
                    <td style="font-size:13px">{{ Str::limit($j->catatan, 80) }}</td>
                    <td style="font-size:13px">{{ Str::limit($j->tindak_lanjut ?? '-', 60) }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-muted py-3" style="font-size:13px">Belum ada riwayat pertemuan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@else
<div class="card">
    <div class="card-body text-center py-5">
        <i class="bi bi-person-x" style="font-size:48px;color:#ccc"></i>
        <p class="mt-3 text-muted">Data kamu belum terhubung.<br>Hubungi Guru Wali atau admin.</p>
    </div>
</div>
@endif
@endsection
