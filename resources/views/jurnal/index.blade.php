 @extends('layouts.app')
@section('title', 'Jurnal Pertemuan')
@section('page-title', 'Jurnal Pertemuan')
@section('page-subtitle', 'Catatan pendampingan siswa')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <span><i class="bi bi-journal-text me-2 text-primary"></i>Daftar Jurnal</span>
        <a href="{{ route('guru.jurnal.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus"></i> Tambah Jurnal
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-3">#</th>
                    <th>Siswa</th>
                    <th>Tanggal</th>
                    <th>Jenis</th>
                    <th>Aspek</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jurnal as $j)
                <tr>
                    <td class="ps-3 text-muted" style="font-size:13px">{{ $loop->iteration }}</td>
                    <td>
                        <strong style="font-size:14px">{{ $j->siswa->nama }}</strong>
                        <div class="text-muted" style="font-size:12px">{{ $j->siswa->kelas }}</div>
                    </td>
                    <td style="font-size:13px">{{ $j->tanggal_pertemuan->format('d M Y') }}</td>
                    <td style="font-size:13px">{{ $j->jenis_pertemuan_label }}</td>
                    <td><span class="badge badge-{{ $j->aspek }}">{{ $j->aspek_label }}</span></td>
                    <td style="font-size:13px;max-width:200px">{{ Str::limit($j->catatan, 70) }}</td>
                    <td>
                        <a href="{{ route('guru.jurnal.show', $j) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('guru.jurnal.edit', $j) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('guru.jurnal.destroy', $j) }}"
                              class="d-inline" onsubmit="return confirm('Hapus jurnal ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        Belum ada jurnal. <a href="{{ route('guru.jurnal.create') }}">Buat sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($jurnal->hasPages())
    <div class="card-footer">{{ $jurnal->links() }}</div>
    @endif
</div>
@endsection
