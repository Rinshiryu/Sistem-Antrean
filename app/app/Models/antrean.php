<?php
namespace App\Models;
public function pasien()
{
    return $this->belongsTo(
        Pasien::class,
        'id_pasien'
    );
}

public function poli()
{
    return $this->belongsTo(
        Poli::class,
        'id_poli'
    );
}