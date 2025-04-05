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
        Schema::connection('master')->create('kartu_identitas_pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('norm');
            $table->string('jenis_kartu');
            $table->string('nomor_kartu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('master')->dropIfExists('kartu_identitas_pasiens');
    }
};
