<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $table = 'kamar';
    protected $primaryKey = 'id_kamar';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'no_kamar',
        'tipe_kamar',
        'status_kamar',
        'harga_per_malam',
        'deskripsi',
        'foto_kamar'
    ];
}
