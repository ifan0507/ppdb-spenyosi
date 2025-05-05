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
        Schema::create('non_akademiks', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('nama_prestasi')->nullable();
            $table->string('tingkat_prestasi')->nullable();
            $table->year('thn_perolehan')->nullable();
            $table->string('perolehan')->nullable();
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
        Schema::dropIfExists('non_akademiks');
    }
};
