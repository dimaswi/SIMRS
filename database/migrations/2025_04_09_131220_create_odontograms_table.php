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
        Schema::connection('rekam_medis')->create('odontogram', function (Blueprint $table) {
            $table->id();
            $table->string('kunjungan_id');
            $table->string('pendaftaran_id');
            $table->string('nomor_gigi');
            $table->string('posisi');
            $table->string('kondisi');
            $table->string('tindakan');
            $table->dateTime('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('rekam_medis')->dropIfExists('odontogram');
    }
};
