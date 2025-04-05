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
        Schema::connection('aplikasi')->create('dokter_to_ruangan', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('ruangan_id');
            $table->string('jadwal');
            $table->string('jam_buka');
            $table->string('jam_tutup');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('aplikasi')->dropIfExists('dokter_to_ruangans');
    }
};
