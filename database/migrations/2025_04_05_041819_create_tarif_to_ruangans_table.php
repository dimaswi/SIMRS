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
        Schema::connection('aplikasi')->create('tarif_to_ruangan', function (Blueprint $table) {
            $table->id();
            $table->string('ruangan_id');
            $table->string('tarif_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('aplikasi')->dropIfExists('tarif_to_ruangan');
    }
};
