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
        Schema::create('data_raports', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('id_register')->references('id')->on('registers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_mapel')->references('id')->on('mata_pelajarans')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('kelas4_1')->nullable();
            $table->integer('kelas4_2')->nullable();
            $table->integer('kelas5_1')->nullable();
            $table->integer('kelas5_2')->nullable();
            $table->integer('kelas6_1')->nullable();
            $table->decimal('rata_kelas4_sem1', 5, 2)->nullable();
            $table->decimal('rata_kelas4_sem2', 5, 2)->nullable();
            $table->decimal('rata_kelas5_sem1', 5, 2)->nullable();
            $table->decimal('rata_kelas5_sem2', 5, 2)->nullable();
            $table->decimal('rata_kelas6_sem1', 5, 2)->nullable();
            $table->decimal('total_rata_rata', 5, 2)->nullable();
            $table->enum('status', ['0', '1'])->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_raports');
    }
};
