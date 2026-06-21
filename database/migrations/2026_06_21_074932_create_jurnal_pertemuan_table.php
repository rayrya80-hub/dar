<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jurnal_pertemuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->cascadeOnDelete();
            $table->foreignId('guru_wali_id')->constrained('users')->cascadeOnDelete();
            $table->date('tanggal_pertemuan');
            $table->enum('jenis_pertemuan', ['tatap_muka', 'online', 'telepon', 'via_ortu']);
            $table->enum('aspek', ['akademik', 'karakter', 'bakat', 'keterampilan', 'lainnya']);
            $table->text('catatan');
            $table->text('tindak_lanjut')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jurnal_pertemuan');
    }
};