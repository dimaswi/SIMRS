<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBarang extends Model
{
    use HasFactory;

    protected $connection = 'inventory';

    protected $table = 'kategori_barang';

    protected $fillable = [
        'nama_kategori_barang'
    ];
}
