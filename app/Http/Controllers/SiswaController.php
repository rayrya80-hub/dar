<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $siswaList = Siswa::with('guruWali')->latest()->paginate(10);
        } else {
            $siswaList = Siswa::where('guru_wali_id', $user->id)->latest()->paginate(10);
        }

        return view('siswa.index', compact('siswaList'));
    }

    public function create()
    {
        $guruList = User::role('guru_wali')->get();
        return view('siswa.create', compact('guruList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis'           => 'required|unique:siswa,nis',
            'nama'          => 'required|string|max:255',
            'kelas'         => 'required|string',
            'jurusan'       => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'guru_wali_id'  => 'required|exists:users,id',
        ]);

        Siswa::create($request->all());

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function show(Siswa $siswa)
    {
        $siswa->load('guruWali', 'jurnalPertemuan', 'laporanPerkembangan');
        return view('siswa.show', compact('siswa'));
    }

    public function edit(Siswa $siswa)
    {
        $guruList = User::role('guru_wali')->get();
        return view('siswa.edit', compact('siswa', 'guruList'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nis'           => 'required|unique:siswa,nis,' . $siswa->id,
            'nama'          => 'required|string|max:255',
            'kelas'         => 'required|string',
            'jurusan'       => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'guru_wali_id'  => 'required|exists:users,id',
        ]);

        $siswa->update($request->all());

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }
}