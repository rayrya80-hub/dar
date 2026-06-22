@extends('layouts.app')
@section('title', 'Data Siswa')
@section('page-title', 'Data Siswa')
@section('page-subtitle', 'Daftar siswa dampingan')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <span><i class="bi bi-people me-2 text-primary"></i>Daftar Siswa</span>
        @role('admin')
        <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus"></i> Tambah Siswa
        </a>
        @endrole
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-3">#</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Guru Wali</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswaList as $s)
                <tr>
                    <td class="ps-3 text-muted" style="font-size:13px">{{ $loop->iteration }}</td>
                    <td style="font-size:13px">{{ $s->nis }}</td>
                    <td>
                        <strong style="font-size:14px">{{ $s->nama }}</strong>
                        <div class="text-muted" style="font-size:12px">
                            {{ $s->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </div>
                    </td>
                    <td style="font-size:13px">{{ $s->kelas }}</td>
                    <td style="font-size:13px">{{ $s->jurusan }}</td>
                    <td style="font-size:13px">{{ $s->guruWali->name ?? '-' }}</td>
                    <td>
                        @role('admin')
                        <a href="{{ route('admin.siswa.show', $s) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('admin.siswa.edit', $s) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.siswa.destroy', $s) }}"
                              class="d-inline" onsubmit="return confirm('Hapus siswa ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                        @endrole
                        @role('guru_wali')
                        <a href="{{ route('guru.siswa.show', $s) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i>
                        </a>
                        @endrole
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        Belum ada data siswa
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($siswaList->hasPages())
    <div class="card-footer">
        {{ $siswaList->links() }}
    </div>
    @endif
</div>
@endsection