 @extends('layouts.app')
@section('title', 'Edit Laporan')
@section('page-title', 'Edit Laporan Perkembangan')
@section('page-subtitle', $laporan->siswa->nama ?? '')

@section('content')
<div class="card" style="max-width:800px">
    <div class="card-header py-3">
        <i class="bi bi-pencil me-2 text-primary"></i>Edit Laporan Perkembangan
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('guru.laporan.update', $laporan) }}">
            @csrf @method('PUT')
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Siswa</label>
                    <select name="siswa_id" class="form-select" required>
                        @foreach($siswaList as $s)
                        <option value="{{ $s->id }}" {{ old('siswa_id', $laporan->siswa_id) == $s->id ? 'selected' : '' }}>
                            {{ $s->nama }} — {{ $s->kelas }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Periode</label>
                    <select name="periode" class="form-select" required>
                        <option value="semester_1" {{ old('periode', $laporan->periode) == 'semester_1' ? 'selected' : '' }}>Semester 1</option>
                        <option value="semester_2" {{ old('periode', $laporan->periode) == 'semester_2' ? 'selected' : '' }}>Semester 2</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Tahun Ajaran</label>
                    <input type="number" name="tahun_ajaran" class="form-control"
                        value="{{ old('tahun_ajaran', $laporan->tahun_ajaran) }}" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Perkembangan Akademik</label>
                <textarea name="perkembangan_akademik" rows="3" class="form-control">{{ old('perkembangan_akademik', $laporan->perkembangan_akademik) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Perkembangan Karakter</label>
                <textarea name="perkembangan_karakter" rows="3" class="form-control">{{ old('perkembangan_karakter', $laporan->perkembangan_karakter) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Perkembangan Bakat</label>
                <textarea name="perkembangan_bakat" rows="3" class="form-control">{{ old('perkembangan_bakat', $laporan->perkembangan_bakat) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Perkembangan Keterampilan</label>
                <textarea name="perkembangan_keterampilan" rows="3" class="form-control">{{ old('perkembangan_keterampilan', $laporan->perkembangan_keterampilan) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Kesimpulan</label>
                <textarea name="kesimpulan" rows="3" class="form-control">{{ old('kesimpulan', $laporan->kesimpulan) }}</textarea>
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Status</label>
                <select name="status" class="form-select" style="max-width:200px">
                    <option value="draft" {{ old('status', $laporan->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="final" {{ old('status', $laporan->status) == 'final' ? 'selected' : '' }}>Final</option>
                </select>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Update Laporan
                </button>
                <a href="{{ route('guru.laporan.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
