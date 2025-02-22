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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->ulid('id_siswa');
            $table->foreign('id_siswa')->references('id')->on('siswa_barus');
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'user_id'
            );
            $table->date('tanggal_daftar');
            $table->enum('confirmations', ['0', '1'])->default('0');
            $table->enum('decline', ['0', '1'])->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
