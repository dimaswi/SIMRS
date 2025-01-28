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
        Schema::connection('inventory')->create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->integer('harga_beli');
            $table->integer('harga_jual');
            $table->integer('stok_minuimum');
            $table->tinyInteger('jenis_barang');
            $table->tinyInteger('kategori_barang');
            $table->tinyInteger('kategori');
            $table->tinyInteger('satuan');
            $table->tinyInteger('vendor');
            $table->tinyInteger('generik');
            $table->tinyInteger('jenis_penggunaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('inventory')->dropIfExists('barang');
    }
};
