<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
public function akun()
{
    return $this->belongsTo(
        AkunPengguna::class,
        'id_akun'
    );
}