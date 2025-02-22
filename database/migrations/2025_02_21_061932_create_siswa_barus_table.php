<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswa_barus', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('nisn');
            $table->string('nama');
            $table->string('nik');
            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('asal_sekolah');
            $table->string('kabupaten');
            $table->string('kecamatan');
            $table->string('desa');
            $table->string('dusun');
            $table->char('rt', length: 4);
            $table->char('rw', length: 4);
            $table->text('alamat');
            $table->string('no_hp');
            $table->string('email');
            $table->string('jalur_ppdb');
            $table->string('lokasi');
            $table->string('foto_kk');
            $table->string('foto_siswa');
            $table->string('foto_akte');
            $table->string('documents');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa_barus');
    }
};
