<?php

namespace App\Models\MedicalRecord;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanUmum extends Model
{
    use HasFactory, HasUuids;

    protected $connection = 'rekam_medis';

    protected $table = 'pemeriksaan_umum';

    protected $fillable = [
        'kunjungan_id',
        'keadaan_umum',
        'tingkat_kesadaran',
        'eye',
        'motorik',
        'verbal',
        'GCS',
        'tekanan_darah_sistolik',
        'tekanan_darah_distolik',
        'frekuensi_nafas',
        'frekuensi_nadi',
        'suhu',
        'saturasi_oksigen',
        'berat_badan',
        'tinggi_badan',
        'lingkar_lengan_atas',
        'lingkar_kepala',
        'tinggi_lutut',
        'panjang_ulna',
        'lingkar_perut',
        'kondisi_anak',
        'pemeriksaan_ke',
        'alat_bantu_nafas',
        'petugas',
        'tanggal_pemeriksaan',
        ];

    public function user()
    {
        return $this->belongsTo(User::class, 'petugas');
    }
}
