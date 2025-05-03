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
        Schema::create('rata_rata_raports', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('id_register')->references('id')->on('registers')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('total_rata_rata', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rata_rata_raports');
    }
};
