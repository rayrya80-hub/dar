<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        'nis',
        'nama',
        'kelas',
        'jurusan',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_hp_siswa',
        'nama_orang_tua',
        'no_hp_orang_tua',
        'guru_wali_id',
        'user_id',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function guruWali()
    {
        return $this->belongsTo(User::class, 'guru_wali_id');
    }

    public function userAkun()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jurnalPertemuan()
    {
        return $this->hasMany(JurnalPertemuan::class, 'siswa_id');
    }

    public function laporanPerkembangan()
    {
        return $this->hasMany(LaporanPerkembangan::class, 'siswa_id');
    }

    public function getUmurAttribute()
    {
        return $this->tanggal_lahir
            ? $this->tanggal_lahir->age . ' tahun'
            : '-';
    }
}