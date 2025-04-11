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
        Schema::connection('rekam_medis')->create('odontogram_detail', function (Blueprint $table) {
            $table->id();
            $table->string('kunjungan_id');
            $table->string('odontogram_id');
            $table->string('occlusi');
            $table->string('torus_platinus');
            $table->string('torus_mandibularis');
            $table->string('palatum');
            $table->string('diastema');
            $table->string('anomali');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('rekam_medis')->dropIfExists('odontogram_detail');
    }
};
