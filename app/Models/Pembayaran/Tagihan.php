<?php

namespace App\Models\Pembayaran;

use App\Models\Inventory\Barang;
use App\Models\Master\Tarif;
use App\Models\Master\Tindakan;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory, HasUuids;

    protected $connection = 'pembayaran';

    protected $table = 'tagihan';

    protected $fillable = [
        'pendaftaran_id',
        'tarif_id',
        'tindakan_id',
        'barang_id',
        'nominal',
        'jumlah',
    ];

    public function tindakan()
    {
        return $this->belongsTo(Tindakan::class, 'tindakan_id');
    }

    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'tarif_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
