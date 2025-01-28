<?php

namespace App\Models\Aplikasi;

use App\Models\Inventory\Barang;
use App\Models\Master\Ruangan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangToRuangan extends Model
{
    use HasFactory;

    protected $connection = 'aplikasi';

    protected $table = 'barang_to_ruangan';

    protected $fillable = [
        'id_barang',
        'id_ruangan',
        'stok',
    ];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
