<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    use HasFactory;

    protected $connection = 'inventory';

    protected $table = 'jenis_barang';

    protected $fillable = [
        'nama_jenis_barang'
    ];
}
