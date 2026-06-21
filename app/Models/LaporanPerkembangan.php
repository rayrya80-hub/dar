<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaporanPerkembangan extends Model
{
    use HasFactory;

    protected $table = 'laporan_perkembangan';

    protected $fillable = [
        'siswa_id',
        'guru_wali_id',
        'periode',
        'tahun_ajaran',
        'perkembangan_akademik',
        'perkembangan_karakter',
        'perkembangan_bakat',
        'perkembangan_keterampilan',
        'kesimpulan',
        'rekomendasi_ai',
        'status',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function guruWali()
    {
        return $this->belongsTo(User::class, 'guru_wali_id');
    }

    public function getPeriodeLabelAttribute()
    {
        return match($this->periode) {
            'semester_1' => 'Semester 1',
            'semester_2' => 'Semester 2',
            default      => '-',
        };
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'draft' => 'Draft',
            'final' => 'Final',
            default => '-',
        };
    }
}