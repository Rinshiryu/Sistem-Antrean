<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antrean extends Model
{
    protected $table = 'antrean';

    protected $primaryKey = 'id_antrean';

    public $timestamps = false;

    protected $fillable = [
        'tanggal_periksa',
        'nomor_urut',
        'kode_poli',
        'jadwal_kedatangan',
        'status',
        'id_pasien',
        'id_akun',
        'id_poli'
    ];
}