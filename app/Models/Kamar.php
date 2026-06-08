<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamar';
    protected $primaryKey = 'id_kamar';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'id_kamar',
        'no_kamar',
        'id_tipe_kamar',
        'status_kamar',
    ];

    public function tipe()
    {
        return $this->belongsTo(TipeKamar::class, 'id_tipe_kamar', 'id_tipe_kamar');
    }
}
