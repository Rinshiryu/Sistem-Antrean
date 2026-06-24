<?php
namespace App\Models;
public function akun()
{
    return $this->belongsTo(
        AkunPengguna::class,
        'id_akun'
    );
}