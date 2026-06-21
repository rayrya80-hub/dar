<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\JurnalPertemuan;
use App\Models\LaporanPerkembangan;
use App\Models\User;

class DashboardController extends Controller
{
    public function admin()
    {
        $data = [
            'total_siswa'   => Siswa::count(),
            'total_guru'    => User::role('guru_wali')->count(),
            'total_jurnal'  => JurnalPertemuan::count(),
            'total_laporan' => LaporanPerkembangan::count(),
        ];
        return view('dashboard.admin', compact('data'));
    }

    public function guru()
    {
        $guru = Auth::user();
        $data = [
            'total_siswa'   => Siswa::where('guru_wali_id', $guru->id)->count(),
            'total_jurnal'  => JurnalPertemuan::where('guru_wali_id', $guru->id)->count(),
            'total_laporan' => LaporanPerkembangan::where('guru_wali_id', $guru->id)->count(),
            'jurnal_terbaru' => JurnalPertemuan::where('guru_wali_id', $guru->id)
                                ->with('siswa')
                                ->latest()
                                ->take(5)
                                ->get(),
        ];
        return view('dashboard.guru', compact('data'));
    }

    public function ortu()
    {
        $user   = Auth::user();
        $siswa  = Siswa::where('user_id', $user->id)
                    ->orWhere('nama_orang_tua', $user->name)
                    ->first();
        $jurnal  = $siswa ? JurnalPertemuan::where('siswa_id', $siswa->id)->latest()->take(5)->get() : collect();
        $laporan = $siswa ? LaporanPerkembangan::where('siswa_id', $siswa->id)->latest()->take(3)->get() : collect();
        return view('dashboard.ortu', compact('siswa', 'jurnal', 'laporan'));
    }

    public function siswa()
    {
        $user   = Auth::user();
        $siswa  = Siswa::where('user_id', $user->id)->first();
        $jurnal  = $siswa ? JurnalPertemuan::where('siswa_id', $siswa->id)->latest()->take(5)->get() : collect();
        $laporan = $siswa ? LaporanPerkembangan::where('siswa_id', $siswa->id)->where('status', 'final')->latest()->get() : collect();
        return view('dashboard.siswa', compact('siswa', 'jurnal', 'laporan'));
    }
}