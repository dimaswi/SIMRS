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
        Schema::connection('pendaftaran')->create('kunjungan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('pendaftaran_id');
            $table->string('ruangan_id');
            $table->dateTime('masuk');
            $table->dateTime('terima');
            $table->dateTime('final');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('pendaftaran')->dropIfExists('kunjungan');
    }
};
