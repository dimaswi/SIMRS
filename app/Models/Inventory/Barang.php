<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $connection = 'inventory';

    protected $table = 'barang';

    protected $fillable = [
        'nama_barang',
        'merk',
        'harga_beli',
        'harga_jual',
        'stok_minimum',
        'jenis',
        'kategori',
        'satuan',
        'vendor',
        'generik',
        'jenis_penggunaan',
    ];

    public function KategoriBarang()
    {
        return $this->belongsTo(KategoriBarang::class, 'kategori');
    }

    public function SatuanBarang()
    {
        return $this->belongsTo(SatuanBarang::class,'satuan');
    }

    public function vendorBarang()
    {
        return $this->belongsTo(VendorBarang::class,'vendor');
    }

    public function jenisBarang()
    {
        return $this->belongsTo(JenisBarang::class,'jenis');
    }
}
