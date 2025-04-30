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
            $table->foreignUlid('id_siswa')->references('id')->on('siswa_barus')->onDelete('cascade')->onUpdate('cascade');
            $table->string('ayah')->nullable();
            $table->enum('status_ayah', ['Hidup', 'Wafat'])->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('pendidikan_ayah')->nullable();
            $table->string('ibu')->nullable();
            $table->enum('status_ibu', ['Hidup', 'Wafat'])->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('pendidikan_ibu')->nullable();
            $table->string('no_hp')->nullable();
            $table->enum('status_berkas', ['0', '1'])->default('0');
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
