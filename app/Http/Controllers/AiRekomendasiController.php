<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\LaporanPerkembangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AiRekomendasiController extends Controller
{
    public function generate(Request $request, Siswa $siswa)
    {
        $jurnal = $siswa->jurnalPertemuan()->latest()->take(10)->get();

        $ringkasanJurnal = $jurnal->map(function ($j) {
            return "- [{$j->tanggal_pertemuan->format('d/m/Y')}] Aspek: {$j->aspek_label}, Catatan: {$j->catatan}";
        })->join("\n");

        $prompt = "Kamu adalah asisten pendidikan untuk Guru Wali di SMKN 1 Sungailiat.

Berikut data siswa:
Nama    : {$siswa->nama}
Kelas   : {$siswa->kelas}
Jurusan : {$siswa->jurusan}

Riwayat jurnal pertemuan terakhir:
{$ringkasanJurnal}

Berikan rekomendasi penanganan yang spesifik, praktis, dan terstruktur untuk Guru Wali dalam mendampingi siswa ini. Fokus pada:
1. Identifikasi pola masalah utama
2. Rekomendasi pendekatan akademik
3. Rekomendasi pengembangan karakter
4. Saran koordinasi dengan orang tua
5. Rencana tindak lanjut

Gunakan bahasa Indonesia yang profesional namun mudah dipahami.";

        $response = Http::withHeaders([
            'x-api-key'         => config('services.claude.api_key'),
            'anthropic-version' => '2023-06-01',
            'content-type'      => 'application/json',
        ])->post('https://api.anthropic.com/v1/messages', [
            'model'      => config('services.claude.model'),
            'max_tokens' => 1024,
            'messages'   => [
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        if ($response->successful()) {
            $rekomendasi = $response->json('content.0.text');
            return response()->json(['rekomendasi' => $rekomendasi]);
        }

        return response()->json(['error' => 'Gagal menghubungi AI.'], 500);
    }
}