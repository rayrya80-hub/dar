<?php

namespace App\Http\Controllers;

use App\Models\LaporanPerkembangan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanPerkembanganController extends Controller
{
    public function index()
    {
        $laporan = LaporanPerkembangan::with('siswa')
            ->where('guru_wali_id', Auth::id())
            ->latest()
            ->paginate(10);
        return view('laporan.index', compact('laporan'));
    }

    public function create()
    {
        $siswaList = Siswa::where('guru_wali_id', Auth::id())->get();
        return view('laporan.create', compact('siswaList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id'     => 'required|exists:siswa,id',
            'periode'      => 'required|in:semester_1,semester_2',
            'tahun_ajaran' => 'required|digits:4',
        ]);

        LaporanPerkembangan::create([
            'siswa_id'                  => $request->siswa_id,
            'guru_wali_id'              => Auth::id(),
            'periode'                   => $request->periode,
            'tahun_ajaran'              => $request->tahun_ajaran,
            'perkembangan_akademik'     => $request->perkembangan_akademik,
            'perkembangan_karakter'     => $request->perkembangan_karakter,
            'perkembangan_bakat'        => $request->perkembangan_bakat,
            'perkembangan_keterampilan' => $request->perkembangan_keterampilan,
            'kesimpulan'                => $request->kesimpulan,
            'status'                    => $request->status ?? 'draft',
        ]);

        return redirect()->route('guru.laporan.index')
            ->with('success', 'Laporan perkembangan berhasil disimpan.');
    }

    public function show(LaporanPerkembangan $laporan)
    {
        $laporan->load('siswa', 'guruWali');
        return view('laporan.show', compact('laporan'));
    }

    public function edit(LaporanPerkembangan $laporan)
    {
        $siswaList = Siswa::where('guru_wali_id', Auth::id())->get();
        return view('laporan.edit', compact('laporan', 'siswaList'));
    }

    public function update(Request $request, LaporanPerkembangan $laporan)
    {
        $request->validate([
            'siswa_id'     => 'required|exists:siswa,id',
            'periode'      => 'required|in:semester_1,semester_2',
            'tahun_ajaran' => 'required|digits:4',
        ]);

        $laporan->update([
            'siswa_id'                  => $request->siswa_id,
            'periode'                   => $request->periode,
            'tahun_ajaran'              => $request->tahun_ajaran,
            'perkembangan_akademik'     => $request->perkembangan_akademik,
            'perkembangan_karakter'     => $request->perkembangan_karakter,
            'perkembangan_bakat'        => $request->perkembangan_bakat,
            'perkembangan_keterampilan' => $request->perkembangan_keterampilan,
            'kesimpulan'                => $request->kesimpulan,
            'status'                    => $request->status ?? 'draft',
        ]);

        return redirect()->route('guru.laporan.index')
            ->with('success', 'Laporan perkembangan berhasil diperbarui.');
    }

    public function destroy(LaporanPerkembangan $laporan)
    {
        $laporan->delete();
        return redirect()->route('guru.laporan.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }
}