<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\User;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $guru1 = User::where('email', 'budi@smkn1sungailiat.sch.id')->first();
        $guru2 = User::where('email', 'sari@smkn1sungailiat.sch.id')->first();
        $userSiswa = User::where('email', 'rizky@siswa.smkn1sungailiat.sch.id')->first();

        Siswa::create([
            'nis'             => '2024001',
            'nama'            => 'Rizky Pratama',
            'kelas'           => 'XI',
            'jurusan'         => 'Teknik Komputer dan Jaringan',
            'jenis_kelamin'   => 'L',
            'tempat_lahir'    => 'Sungailiat',
            'tanggal_lahir'   => '2007-03-15',
            'alamat'          => 'Jl. Merdeka No. 12, Sungailiat',
            'no_hp_siswa'     => '081234567890',
            'nama_orang_tua'  => 'Ahmad Fauzi',
            'no_hp_orang_tua' => '082345678901',
            'guru_wali_id'    => $guru1->id,
            'user_id'         => $userSiswa->id,
        ]);

        Siswa::create([
            'nis'             => '2024002',
            'nama'            => 'Putri Rahayu',
            'kelas'           => 'XI',
            'jurusan'         => 'Akuntansi',
            'jenis_kelamin'   => 'P',
            'tempat_lahir'    => 'Pangkalpinang',
            'tanggal_lahir'   => '2007-07-22',
            'alamat'          => 'Jl. Sudirman No. 5, Sungailiat',
            'no_hp_siswa'     => '083456789012',
            'nama_orang_tua'  => 'Hendra Wijaya',
            'no_hp_orang_tua' => '084567890123',
            'guru_wali_id'    => $guru1->id,
            'user_id'         => null,
        ]);

        Siswa::create([
            'nis'             => '2024003',
            'nama'            => 'Muhammad Fajar',
            'kelas'           => 'X',
            'jurusan'         => 'Teknik Komputer dan Jaringan',
            'jenis_kelamin'   => 'L',
            'tempat_lahir'    => 'Sungailiat',
            'tanggal_lahir'   => '2008-11-10',
            'alamat'          => 'Jl. Ahmad Yani No. 8, Sungailiat',
            'no_hp_siswa'     => '085678901234',
            'nama_orang_tua'  => 'Supardi',
            'no_hp_orang_tua' => '086789012345',
            'guru_wali_id'    => $guru2->id,
            'user_id'         => null,
        ]);
    }
}