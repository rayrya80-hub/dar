<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\LaporanPerkembangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiRekomendasiController extends Controller
{
    public function generate(Request $request, Siswa $siswa)
    {
        $jurnal = $siswa->jurnalPertemuan()->latest()->take(10)->get();

        if ($jurnal->isEmpty()) {
            return response()->json([
                'error' => 'Belum ada jurnal pertemuan untuk siswa ini. Tambahkan jurnal terlebih dahulu.'
            ], 422);
        }

        $ringkasanJurnal = $jurnal->map(function ($j) {
            return "- [{$j->tanggal_pertemuan->format('d/m/Y')}] Aspek: {$j->aspek_label}, Jenis: {$j->jenis_pertemuan_label}, Catatan: {$j->catatan}" .
                ($j->tindak_lanjut ? ", Tindak Lanjut: {$j->tindak_lanjut}" : "");
        })->join("\n");

        $prompt = "Kamu adalah asisten pendidikan profesional untuk Guru Wali di SMKN 1 Sungailiat, Bangka Belitung.

Berikut data siswa yang perlu dianalisis:
- Nama         : {$siswa->nama}
- Kelas        : {$siswa->kelas}
- Jurusan      : {$siswa->jurusan}
- Jenis Kelamin: " . ($siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan') . "

Riwayat jurnal pertemuan ({$jurnal->count()} pertemuan terakhir):
{$ringkasanJurnal}

Berdasarkan data di atas, berikan analisis dan rekomendasi terstruktur untuk Guru Wali dalam format berikut:

1. IDENTIFIKASI POLA MASALAH
   Jelaskan pola masalah atau kebutuhan utama yang terlihat dari riwayat pertemuan.

2. REKOMENDASI PENDEKATAN AKADEMIK
   Berikan saran konkret untuk meningkatkan performa akademik siswa.

3. REKOMENDASI PENGEMBANGAN KARAKTER
   Berikan saran untuk pengembangan karakter dan sikap siswa.

4. SARAN KOORDINASI DENGAN ORANG TUA
   Apa yang perlu dikomunikasikan kepada orang tua dan bagaimana caranya.

5. RENCANA TINDAK LANJUT
   Langkah-langkah konkret yang perlu dilakukan Guru Wali dalam 1 bulan ke depan.

Gunakan bahasa Indonesia yang profesional, empati, dan mudah dipahami.";

        try {
            $response = Http::timeout(30)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . config('services.groq.api_key'),
                    'Content-Type'  => 'application/json',
                ])
                ->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model'       => config('services.groq.model'),
                    'max_tokens'  => 1500,
                    'temperature' => 0.7,
                    'messages'    => [
                        [
                            'role'    => 'system',
                            'content' => 'Kamu adalah asisten pendidikan profesional yang membantu Guru Wali di sekolah menengah kejuruan Indonesia.'
                        ],
                        [
                            'role'    => 'user',
                            'content' => $prompt
                        ],
                    ],
                ]);

            if ($response->successful()) {
                $rekomendasi = $response->json('choices.0.message.content');

                // Simpan ke laporan draft terbaru jika ada
                $laporan = LaporanPerkembangan::where('siswa_id', $siswa->id)
                    ->where('status', 'draft')
                    ->latest()
                    ->first();

                if ($laporan) {
                    $laporan->update(['rekomendasi_ai' => $rekomendasi]);
                }

                return response()->json([
                    'rekomendasi'   => $rekomendasi,
                    'siswa'         => $siswa->nama,
                    'jumlah_jurnal' => $jurnal->count(),
                ]);
            }

            Log::error('Groq API Error', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);

            return response()->json([
                'error' => 'Gagal menghubungi AI. Status: ' . $response->status()
            ], 500);

        } catch (\Exception $e) {
            Log::error('Groq API Exception', ['message' => $e->getMessage()]);

            return response()->json([
                'error' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}