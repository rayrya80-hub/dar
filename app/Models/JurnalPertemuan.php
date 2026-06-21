<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JurnalPertemuan extends Model
{
    use HasFactory;

    protected $table = 'jurnal_pertemuan';

    protected $fillable = [
        'siswa_id',
        'guru_wali_id',
        'tanggal_pertemuan',
        'jenis_pertemuan',
        'aspek',
        'catatan',
        'tindak_lanjut',
    ];

    protected $casts = [
        'tanggal_pertemuan' => 'date',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function guruWali()
    {
        return $this->belongsTo(User::class, 'guru_wali_id');
    }

    public function getJenisPertemuanLabelAttribute()
    {
        return match($this->jenis_pertemuan) {
            'tatap_muka' => 'Tatap Muka',
            'online'     => 'Online',
            'telepon'    => 'Telepon',
            'via_ortu'   => 'Via Orang Tua',
            default      => '-',
        };
    }

    public function getAspekLabelAttribute()
    {
        return match($this->aspek) {
            'akademik'      => 'Akademik',
            'karakter'      => 'Karakter',
            'bakat'         => 'Bakat',
            'keterampilan'  => 'Keterampilan',
            'lainnya'       => 'Lainnya',
            default         => '-',
        };
    }
}