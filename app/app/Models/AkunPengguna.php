<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AkunPengguna extends Model
{
    protected $table = 'akun_pengguna';

    protected $primaryKey = 'id_akun';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'role',
        'telepon'
    ];
}
