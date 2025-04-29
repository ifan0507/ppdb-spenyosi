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
        Schema::create('document_mutasis', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('asal_tugas')->nullable();
            $table->year('thn_pindah')->nullable();
            $table->string('image')->nullable();
            $table->foreignUlid('id_register')->references('id')->on('registers')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('status_berkas', ['0', '1'])->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_mutasis');
    }
};
