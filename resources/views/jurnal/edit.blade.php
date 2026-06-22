 @extends('layouts.app')
@section('title', 'Edit Jurnal')
@section('page-title', 'Edit Jurnal Pertemuan')
@section('page-subtitle', $jurnal->siswa->nama ?? '')

@section('content')
<div class="card" style="max-width:700px">
    <div class="card-header py-3">
        <i class="bi bi-pencil me-2 text-primary"></i>Edit Jurnal Pertemuan
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('guru.jurnal.update', $jurnal) }}">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-semibold">Siswa</label>
                <select name="siswa_id" class="form-select" required>
                    @foreach($siswaList as $s)
                    <option value="{{ $s->id }}" {{ old('siswa_id', $jurnal->siswa_id) == $s->id ? 'selected' : '' }}>
                        {{ $s->nama }} — {{ $s->kelas }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tanggal Pertemuan</label>
                    <input type="date" name="tanggal_pertemuan" class="form-control"
                        value="{{ old('tanggal_pertemuan', $jurnal->tanggal_pertemuan->format('Y-m-d')) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Jenis Pertemuan</label>
                    <select name="jenis_pertemuan" class="form-select" required>
                        <option value="tatap_muka" {{ old('jenis_pertemuan', $jurnal->jenis_pertemuan) == 'tatap_muka' ? 'selected' : '' }}>Tatap Muka</option>
                        <option value="online"     {{ old('jenis_pertemuan', $jurnal->jenis_pertemuan) == 'online'     ? 'selected' : '' }}>Online</option>
                        <option value="telepon"    {{ old('jenis_pertemuan', $jurnal->jenis_pertemuan) == 'telepon'    ? 'selected' : '' }}>Telepon</option>
                        <option value="via_ortu"   {{ old('jenis_pertemuan', $jurnal->jenis_pertemuan) == 'via_ortu'   ? 'selected' : '' }}>Via Orang Tua</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Aspek Pendampingan</label>
                <select name="aspek" class="form-select" required>
                    <option value="akademik"     {{ old('aspek', $jurnal->aspek) == 'akademik'     ? 'selected' : '' }}>Akademik</option>
                    <option value="karakter"     {{ old('aspek', $jurnal->aspek) == 'karakter'     ? 'selected' : '' }}>Karakter</option>
                    <option value="bakat"        {{ old('aspek', $jurnal->aspek) == 'bakat'        ? 'selected' : '' }}>Bakat</option>
                    <option value="keterampilan" {{ old('aspek', $jurnal->aspek) == 'keterampilan' ? 'selected' : '' }}>Keterampilan</option>
                    <option value="lainnya"      {{ old('aspek', $jurnal->aspek) == 'lainnya'      ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Catatan Pertemuan</label>
                <textarea name="catatan" rows="4" class="form-control" required>{{ old('catatan', $jurnal->catatan) }}</textarea>
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Tindak Lanjut <span class="text-muted fw-normal">(opsional)</span></label>
                <textarea name="tindak_lanjut" rows="3" class="form-control">{{ old('tindak_lanjut', $jurnal->tindak_lanjut) }}</textarea>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Update Jurnal
                </button>
                <a href="{{ route('guru.jurnal.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
