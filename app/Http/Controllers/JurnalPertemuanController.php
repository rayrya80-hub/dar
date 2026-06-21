<?php

namespace App\Http\Controllers;

use App\Models\JurnalPertemuan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JurnalPertemuanController extends Controller
{
    public function index()
    {
        $jurnal = JurnalPertemuan::with('siswa')
            ->where('guru_wali_id', Auth::id())
            ->latest()
            ->paginate(10);
        return view('jurnal.index', compact('jurnal'));
    }

    public function create()
    {
        $siswaList = Siswa::where('guru_wali_id', Auth::id())->get();
        return view('jurnal.create', compact('siswaList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id'          => 'required|exists:siswa,id',
            'tanggal_pertemuan' => 'required|date',
            'jenis_pertemuan'   => 'required|in:tatap_muka,online,telepon,via_ortu',
            'aspek'             => 'required|in:akademik,karakter,bakat,keterampilan,lainnya',
            'catatan'           => 'required|string',
            'tindak_lanjut'     => 'nullable|string',
        ]);

        JurnalPertemuan::create([
            ...$request->all(),
            'guru_wali_id' => Auth::id(),
        ]);

        return redirect()->route('jurnal.index')
            ->with('success', 'Jurnal pertemuan berhasil disimpan.');
    }

    public function show(JurnalPertemuan $jurnal)
    {
        $jurnal->load('siswa', 'guruWali');
        return view('jurnal.show', compact('jurnal'));
    }

    public function edit(JurnalPertemuan $jurnal)
    {
        $siswaList = Siswa::where('guru_wali_id', Auth::id())->get();
        return view('jurnal.edit', compact('jurnal', 'siswaList'));
    }

    public function update(Request $request, JurnalPertemuan $jurnal)
    {
        $request->validate([
            'siswa_id'          => 'required|exists:siswa,id',
            'tanggal_pertemuan' => 'required|date',
            'jenis_pertemuan'   => 'required|in:tatap_muka,online,telepon,via_ortu',
            'aspek'             => 'required|in:akademik,karakter,bakat,keterampilan,lainnya',
            'catatan'           => 'required|string',
            'tindak_lanjut'     => 'nullable|string',
        ]);

        $jurnal->update($request->all());

        return redirect()->route('jurnal.index')
            ->with('success', 'Jurnal pertemuan berhasil diperbarui.');
    }

    public function destroy(JurnalPertemuan $jurnal)
    {
        $jurnal->delete();
        return redirect()->route('jurnal.index')
            ->with('success', 'Jurnal pertemuan berhasil dihapus.');
    }
}