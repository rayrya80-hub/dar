 @extends('layouts.app')
@section('title', 'Edit Siswa')
@section('page-title', 'Edit Data Siswa')
@section('page-subtitle', $siswa->nama)

@section('content')
<div class="card" style="max-width:700px">
    <div class="card-header py-3">
        <i class="bi bi-pencil me-2 text-primary"></i>Edit Data Siswa
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.siswa.update', $siswa) }}">
            @csrf @method('PUT')
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">NIS</label>
                    <input type="text" name="nis" class="form-control @error('nis') is-invalid @enderror"
                        value="{{ old('nis', $siswa->nis) }}" required>
                    @error('nis')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                        value="{{ old('nama', $siswa->nama) }}" required>
                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Kelas</label>
                    <select name="kelas" class="form-select" required>
                        <option value="X"   {{ old('kelas', $siswa->kelas) == 'X'   ? 'selected' : '' }}>X</option>
                        <option value="XI"  {{ old('kelas', $siswa->kelas) == 'XI'  ? 'selected' : '' }}>XI</option>
                        <option value="XII" {{ old('kelas', $siswa->kelas) == 'XII' ? 'selected' : '' }}>XII</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Jurusan</label>
                    <select name="jurusan" class="form-select" required>
                        <option value="Teknik Komputer dan Jaringan" {{ old('jurusan', $siswa->jurusan) == 'Teknik Komputer dan Jaringan' ? 'selected' : '' }}>Teknik Komputer dan Jaringan</option>
                        <option value="Akuntansi" {{ old('jurusan', $siswa->jurusan) == 'Akuntansi' ? 'selected' : '' }}>Akuntansi</option>
                        <option value="Administrasi Perkantoran" {{ old('jurusan', $siswa->jurusan) == 'Administrasi Perkantoran' ? 'selected' : '' }}>Administrasi Perkantoran</option>
                        <option value="Pemasaran" {{ old('jurusan', $siswa->jurusan) == 'Pemasaran' ? 'selected' : '' }}>Pemasaran</option>
                        <option value="Multimedia" {{ old('jurusan', $siswa->jurusan) == 'Multimedia' ? 'selected' : '' }}>Multimedia</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control"
                        value="{{ old('tanggal_lahir', $siswa->tanggal_lahir?->format('Y-m-d')) }}">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Alamat</label>
                <textarea name="alamat" class="form-control" rows="2">{{ old('alamat', $siswa->alamat) }}</textarea>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">No HP Siswa</label>
                    <input type="text" name="no_hp_siswa" class="form-control" value="{{ old('no_hp_siswa', $siswa->no_hp_siswa) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nama Orang Tua</label>
                    <input type="text" name="nama_orang_tua" class="form-control" value="{{ old('nama_orang_tua', $siswa->nama_orang_tua) }}">
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">No HP Orang Tua</label>
                    <input type="text" name="no_hp_orang_tua" class="form-control" value="{{ old('no_hp_orang_tua', $siswa->no_hp_orang_tua) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Guru Wali</label>
                    <select name="guru_wali_id" class="form-select" required>
                        @foreach($guruList as $g)
                        <option value="{{ $g->id }}" {{ old('guru_wali_id', $siswa->guru_wali_id) == $g->id ? 'selected' : '' }}>
                            {{ $g->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Update Data
                </button>
                <a href="{{ route('admin.siswa.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
