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
        Schema::connection('rekam_medis')->create('diagnosa', function (Blueprint $table) {
            $table->id();
            $table->string('kunjungan_id');
            $table->string('diagnosa_id');
            $table->string('keterangan');
            $table->string('kategori');
            $table->string('tanggal');
            $table->string('petugas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('rekam_medis')->dropIfExists('diagnosa');
    }
};
