 @extends('layouts.app')
@section('title', 'Laporan Perkembangan')
@section('page-title', 'Laporan Perkembangan')
@section('page-subtitle', 'Rekap perkembangan siswa per periode')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <span><i class="bi bi-file-earmark-text me-2 text-primary"></i>Daftar Laporan</span>
        <a href="{{ route('guru.laporan.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus"></i> Buat Laporan
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-3">#</th>
                    <th>Siswa</th>
                    <th>Periode</th>
                    <th>Tahun Ajaran</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporan as $l)
                <tr>
                    <td class="ps-3 text-muted" style="font-size:13px">{{ $loop->iteration }}</td>
                    <td>
                        <strong style="font-size:14px">{{ $l->siswa->nama }}</strong>
                        <div class="text-muted" style="font-size:12px">{{ $l->siswa->kelas }}</div>
                    </td>
                    <td style="font-size:13px">{{ $l->periode_label }}</td>
                    <td style="font-size:13px">{{ $l->tahun_ajaran }}</td>
                    <td>
                        <span class="badge {{ $l->status == 'final' ? 'bg-success' : 'bg-secondary' }}">
                            {{ $l->status_label }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('guru.laporan.show', $l) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('guru.laporan.edit', $l) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('guru.laporan.destroy', $l) }}"
                              class="d-inline" onsubmit="return confirm('Hapus laporan ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        Belum ada laporan. <a href="{{ route('guru.laporan.create') }}">Buat sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($laporan->hasPages())
    <div class="card-footer">{{ $laporan->links() }}</div>
    @endif
</div>
@endsection
