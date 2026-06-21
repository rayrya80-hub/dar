<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_perkembangan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->cascadeOnDelete();
            $table->foreignId('guru_wali_id')->constrained('users')->cascadeOnDelete();
            $table->enum('periode', ['semester_1', 'semester_2']);
            $table->year('tahun_ajaran');
            $table->text('perkembangan_akademik')->nullable();
            $table->text('perkembangan_karakter')->nullable();
            $table->text('perkembangan_bakat')->nullable();
            $table->text('perkembangan_keterampilan')->nullable();
            $table->text('kesimpulan')->nullable();
            $table->text('rekomendasi_ai')->nullable();
            $table->enum('status', ['draft', 'final'])->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_perkembangan');
    }
};