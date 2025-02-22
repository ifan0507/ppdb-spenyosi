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
        Schema::create('ortu_siswas', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->ulid('id_siswa');
            $table->foreign('id_siswa')->references('id')->on('siswa_barus')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_ortu');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('kabupaten');
            $table->string('kecamatan');
            $table->string('desa');
            $table->string('dusun');
            $table->string('rt');
            $table->string('rw');
            $table->text('alamat');
            $table->string('pekerjaan');
            $table->string('pendidikan');
            $table->string('no_hp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ortu_siswas');
    }
};
