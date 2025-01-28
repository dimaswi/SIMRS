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
        Schema::connection('master')->create('tindakan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tindakan');
            $table->bigInteger('tagihan_perawat');
            $table->bigInteger('tagihan_dokter');
            $table->bigInteger('tagihan_sarana');
            $table->bigInteger('tagihan_farmasi');
            $table->bigInteger('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('master')->dropIfExists('tindakans');
    }
};
