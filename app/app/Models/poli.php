<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class poli extends Model
{
    protected $table = 'poli';

    protected $primaryKey = 'id_poli';

    public $timestamps = false;

    protected $fillable = [
        'nama_poli',
        'kode_poli'
    ];
}
