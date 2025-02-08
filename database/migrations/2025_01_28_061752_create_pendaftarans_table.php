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
        Schema::connection('pendaftaran')->create('pendaftaran', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nomor_pendaftaran');
            $table->string('norm');
            $table->string('pendaftar');
            $table->integer('keluarga_pasien');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('pendaftaran')->dropIfExists('pendaftaran');
    }
};
