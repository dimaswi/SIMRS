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
        Schema::connection('rekam_medis')->create('order_resep', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kunjungan_id');
            $table->string('pemberi_resep');
            $table->string('dokter_dpjp')->nullable();
            $table->string('alergi_obat')->nullable();
            $table->string('diagnosa');
            $table->string('gangguan_fungsi_ginjal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('rekam_medis')->dropIfExists('order_resep');
    }
};
