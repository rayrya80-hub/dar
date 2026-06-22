 @extends('layouts.app')
@section('title', 'Buat Laporan')
@section('page-title', 'Buat Laporan Perkembangan')
@section('page-subtitle', 'Rekap perkembangan siswa per periode')

@section('content')
<div class="card" style="max-width:800px">
    <div class="card-header py-3">
        <i class="bi bi-file-earmark-plus me-2 text-primary"></i>Form Laporan Perkembangan
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('guru.laporan.store') }}">
            @csrf
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Siswa</label>
                    <select name="siswa_id" class="form-select @error('siswa_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach($siswaList as $s)
                        <option value="{{ $s->id }}" {{ old('siswa_id') == $s->id ? 'selected' : '' }}>
                            {{ $s->nama }} — {{ $s->kelas }}
                        </option>
                        @endforeach
                    </select>
                    @error('siswa_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Periode</label>
                    <select name="periode" class="form-select" required>
                        <option value="semester_1" {{ old('periode') == 'semester_1' ? 'selected' : '' }}>Semester 1</option>
                        <option value="semester_2" {{ old('periode') == 'semester_2' ? 'selected' : '' }}>Semester 2</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Tahun Ajaran</label>
                    <input type="number" name="tahun_ajaran" class="form-control"
                        value="{{ old('tahun_ajaran', date('Y')) }}" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Perkembangan Akademik</label>
                <textarea name="perkembangan_akademik" rows="3" class="form-control"
                    placeholder="Deskripsikan perkembangan akademik siswa...">{{ old('perkembangan_akademik') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Perkembangan Karakter</label>
                <textarea name="perkembangan_karakter" rows="3" class="form-control"
                    placeholder="Deskripsikan perkembangan karakter siswa...">{{ old('perkembangan_karakter') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Perkembangan Bakat</label>
                <textarea name="perkembangan_bakat" rows="3" class="form-control"
                    placeholder="Deskripsikan perkembangan bakat siswa...">{{ old('perkembangan_bakat') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Perkembangan Keterampilan</label>
                <textarea name="perkembangan_keterampilan" rows="3" class="form-control"
                    placeholder="Deskripsikan perkembangan keterampilan siswa...">{{ old('perkembangan_keterampilan') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Kesimpulan</label>
                <textarea name="kesimpulan" rows="3" class="form-control"
                    placeholder="Kesimpulan keseluruhan perkembangan siswa...">{{ old('kesimpulan') }}</textarea>
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Status</label>
                <select name="status" class="form-select" style="max-width:200px">
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="final" {{ old('status') == 'final' ? 'selected' : '' }}>Final</option>
                </select>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Simpan Laporan
                </button>
                <a href="{{ route('guru.laporan.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
