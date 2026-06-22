 @extends('layouts.app')
@section('title', 'Detail Siswa')
@section('page-title', 'Detail Siswa')
@section('page-subtitle', $siswa->nama)

@section('content')
<div class="row g-3">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header py-3">
                <i class="bi bi-person-circle me-2 text-primary"></i>Profil Siswa
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <div style="width:72px;height:72px;background:#e3f0ff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:28px;margin:0 auto">
                        <i class="bi bi-person text-primary"></i>
                    </div>
                    <h6 class="mt-2 mb-0">{{ $siswa->nama }}</h6>
                    <small class="text-muted">{{ $siswa->nis }}</small>
                </div>
                <table class="table table-borderless mb-0" style="font-size:13px">
                    <tr><td class="text-muted">Kelas</td><td>{{ $siswa->kelas }}</td></tr>
                    <tr><td class="text-muted">Jurusan</td><td>{{ $siswa->jurusan }}</td></tr>
                    <tr><td class="text-muted">Jenis Kelamin</td><td>{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
                    <tr><td class="text-muted">Tempat Lahir</td><td>{{ $siswa->tempat_lahir ?? '-' }}</td></tr>
                    <tr><td class="text-muted">Tgl Lahir</td><td>{{ $siswa->tanggal_lahir ? $siswa->tanggal_lahir->format('d M Y') : '-' }}</td></tr>
                    <tr><td class="text-muted">Alamat</td><td>{{ $siswa->alamat ?? '-' }}</td></tr>
                    <tr><td class="text-muted">No HP</td><td>{{ $siswa->no_hp_siswa ?? '-' }}</td></tr>
                    <tr><td class="text-muted">Orang Tua</td><td>{{ $siswa->nama_orang_tua ?? '-' }}</td></tr>
                    <tr><td class="text-muted">HP Ortu</td><td>{{ $siswa->no_hp_orang_tua ?? '-' }}</td></tr>
                    <tr><td class="text-muted">Guru Wali</td><td>{{ $siswa->guruWali->name ?? '-' }}</td></tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        @role('guru_wali')
        <div class="card mb-3">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <span><i class="bi bi-stars me-2 text-warning"></i>Rekomendasi AI</span>
                <button class="btn btn-warning btn-sm" onclick="generateAI({{ $siswa->id }})">
                    <i class="bi bi-magic me-1"></i>Generate Rekomendasi
                </button>
            </div>
            <div class="card-body">
                <div id="ai-loading" class="text-center py-3 d-none">
                    <div class="spinner-border spinner-border-sm text-warning me-2"></div>
                    <span class="text-muted" style="font-size:13px">AI sedang menganalisis data siswa...</span>
                </div>
                <div id="ai-result" style="font-size:14px;line-height:1.8;white-space:pre-wrap"></div>
                <div id="ai-placeholder" class="text-muted text-center py-2" style="font-size:13px">
                    Klik "Generate Rekomendasi" untuk mendapatkan saran penanganan dari AI
                </div>
            </div>
        </div>
        @endrole

        <div class="card">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <span><i class="bi bi-journal-text me-2 text-primary"></i>Jurnal Pertemuan</span>
                @role('guru_wali')
                <a href="{{ route('guru.jurnal.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus"></i> Tambah
                </a>
                @endrole
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Tanggal</th>
                            <th>Aspek</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswa->jurnalPertemuan->sortByDesc('tanggal_pertemuan') as $j)
                        <tr>
                            <td class="ps-3" style="font-size:13px">{{ $j->tanggal_pertemuan->format('d M Y') }}</td>
                            <td><span class="badge badge-{{ $j->aspek }}">{{ $j->aspek_label }}</span></td>
                            <td style="font-size:13px">{{ Str::limit($j->catatan, 100) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-3" style="font-size:13px">Belum ada jurnal</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function generateAI(siswaId) {
    document.getElementById('ai-loading').classList.remove('d-none');
    document.getElementById('ai-result').textContent = '';
    document.getElementById('ai-placeholder').classList.add('d-none');

    fetch(`/guru/ai/rekomendasi/${siswaId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
        }
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('ai-loading').classList.add('d-none');
        if (data.rekomendasi) {
            document.getElementById('ai-result').textContent = data.rekomendasi;
        } else {
            document.getElementById('ai-result').textContent = 'Gagal mendapatkan rekomendasi. Coba lagi.';
        }
    })
    .catch(() => {
        document.getElementById('ai-loading').classList.add('d-none');
        document.getElementById('ai-result').textContent = 'Terjadi kesalahan koneksi.';
    });
}
</script>
@endpush
