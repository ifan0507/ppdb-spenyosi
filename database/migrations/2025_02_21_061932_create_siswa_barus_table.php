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
            $table->string('nik')->nullable();
            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan'])->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('desa')->nullable();
            $table->string('dusun')->nullable();
            $table->char('rt', length: 4)->nullable();
            $table->char('rw', length: 4)->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('foto_kk')->nullable();
            $table->string('foto_siswa')->nullable();
            $table->string('foto_akte')->nullable();
            $table->enum('status_berkas', ['0', '1'])->default('0');
            // $table->ulid('id_register_siswa');
            $table->foreignUlid('id_register_siswa')->references('id')->on('registers')->onDelete('cascade')->onUpdate('cascade');
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
