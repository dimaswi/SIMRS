<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatuanBarang extends Model
{
    use HasFactory;

    protected $connection = 'inventory';

    protected $table = 'satuan_barang';

    protected $fillable = [
        'nama_satuan_barang'
    ];
}
