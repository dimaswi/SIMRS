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
        Schema::connection('pembayaran')->create('tagihan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('pendaftaran_id');
            $table->string('jenis_tagihan');
            $table->string('jenis_id');
            $table->integer('nominal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('pembayaran')->dropIfExists('tagihan');
    }
};
