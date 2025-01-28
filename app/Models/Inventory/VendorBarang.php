<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorBarang extends Model
{
    use HasFactory;

    protected $connection = 'inventory';

    protected $table = 'vendor_barang';

    protected $fillable = [
        'nama_vendor',
        'alamat',
        'nomor_telefon',
    ];
}
