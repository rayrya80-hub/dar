 @extends('layouts.app')
@section('title', 'Tambah Jurnal')
@section('page-title', 'Tambah Jurnal Pertemuan')
@section('page-subtitle', 'Catat hasil pertemuan dengan siswa')

@section('content')
<div class="card" style="max-width:700px">
    <div class="card-header py-3">
        <i class="bi bi-journal-plus me-2 text-primary"></i>Form Jurnal Pertemuan
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('guru.jurnal.store') }}">
            @csrf
            <div class="mb-3">
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
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tanggal Pertemuan</label>
                    <input type="date" name="tanggal_pertemuan"
                        class="form-control @error('tanggal_pertemuan') is-invalid @enderror"
                        value="{{ old('tanggal_pertemuan', date('Y-m-d')) }}" required>
                    @error('tanggal_pertemuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Jenis Pertemuan</label>
                    <select name="jenis_pertemuan" class="form-select @error('jenis_pertemuan') is-invalid @enderror" required>
                        <option value="">-- Pilih --</option>
                        <option value="tatap_muka" {{ old('jenis_pertemuan') == 'tatap_muka' ? 'selected' : '' }}>Tatap Muka</option>
                        <option value="online"     {{ old('jenis_pertemuan') == 'online'     ? 'selected' : '' }}>Online</option>
                        <option value="telepon"    {{ old('jenis_pertemuan') == 'telepon'    ? 'selected' : '' }}>Telepon</option>
                        <option value="via_ortu"   {{ old('jenis_pertemuan') == 'via_ortu'   ? 'selected' : '' }}>Via Orang Tua</option>
                    </select>
                    @error('jenis_pertemuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Aspek Pendampingan</label>
                <select name="aspek" class="form-select @error('aspek') is-invalid @enderror" required>
                    <option value="">-- Pilih Aspek --</option>
                    <option value="akademik"     {{ old('aspek') == 'akademik'     ? 'selected' : '' }}>Akademik</option>
                    <option value="karakter"     {{ old('aspek') == 'karakter'     ? 'selected' : '' }}>Karakter</option>
                    <option value="bakat"        {{ old('aspek') == 'bakat'        ? 'selected' : '' }}>Bakat</option>
                    <option value="keterampilan" {{ old('aspek') == 'keterampilan' ? 'selected' : '' }}>Keterampilan</option>
                    <option value="lainnya"      {{ old('aspek') == 'lainnya'      ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('aspek')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Catatan Pertemuan</label>
                <textarea name="catatan" rows="4"
                    class="form-control @error('catatan') is-invalid @enderror"
                    placeholder="Tuliskan hasil pertemuan secara detail..." required>{{ old('catatan') }}</textarea>
                @error('catatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Tindak Lanjut <span class="text-muted fw-normal">(opsional)</span></label>
                <textarea name="tindak_lanjut" rows="3" class="form-control"
                    placeholder="Rencana tindak lanjut dari pertemuan ini...">{{ old('tindak_lanjut') }}</textarea>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Simpan Jurnal
                </button>
                <a href="{{ route('guru.jurnal.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
