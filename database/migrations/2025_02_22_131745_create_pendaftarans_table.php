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
            $table->foreignUlid('id_register')->references('id')->on('registers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUlid('id_user')->nullable()->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->date('tanggal_daftar');
            $table->enum('confirmations', ['0', '1'])->default('0');
            $table->enum('decline', ['0', '1'])->default('0');
            $table->string('status');
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
