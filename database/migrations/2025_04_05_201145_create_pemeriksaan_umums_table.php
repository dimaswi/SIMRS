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
        Schema::connection('rekam_medis')->create('pemeriksaan_umum', function (Blueprint $table) {
            $table->id();
            $table->string('kunjungan_id');
            $table->string('keadaan_umum')->nullable();
            $table->string('tingkat_kesadaran')->nullable();
            $table->string('eye')->nullable();
            $table->string('motorik')->nullable();
            $table->string('verbal')->nullable();
            $table->string('GCS')->nullable();
            $table->string('tekanan_darah_sistolik')->nullable();
            $table->string('tekanan_darah_distolik')->nullable();
            $table->string('frekuensi_nafas')->nullable();
            $table->string('frekuensi_nadi')->nullable();
            $table->string('suhu')->nullable();
            $table->string('saturasi_oksigen')->nullable();
            $table->string('tanggal_pemeriksaan')->nullable();
            $table->string('berat_badan');
            $table->string('tinggi_badan');
            $table->string('lingkar_lengan_atas');
            $table->string('lingkar_kepala');
            $table->string('tinggi_lutut');
            $table->string('panjang_ulna');
            $table->string('lingkar_perut');
            $table->string('kondisi_anak');
            $table->string('pemeriksaan_ke');
            $table->boolean('alat_bantu_nafas')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('rekam_medis')->dropIfExists('pemeriksaan_umums');
    }
};
