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
        Schema::connection('rekam_medis')->create('order_resep_detil', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('order_resep_id');
            $table->string('obat_id');
            $table->string('aturan_pakai');
            $table->string('dosis');
            $table->string('frekuensi')->nullable();
            $table->string('rute_pemberian')->nullable();
            $table->string('jumlah');
            $table->string('harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('rekam_medis')->dropIfExists('order_resep_detil');
    }
};
