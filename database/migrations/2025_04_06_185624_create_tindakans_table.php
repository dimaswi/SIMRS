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
        Schema::connection('rekam_medis')->create('tindakan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kunjungan_id');
            $table->string('tindakan_id');
            $table->string('petugas');
            $table->dateTime('tanggal_tindakan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('rekam_medis')->dropIfExists('tindakan');
    }
};
