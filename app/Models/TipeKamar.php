<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeKamar extends Model
{
    use HasFactory;

    protected $table = 'tipe_kamar';
    protected $primaryKey = 'id_tipe_kamar';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'nama_tipe',
        'kode_tipe',
        'harga_per_malam',
        'deskripsi',
        'foto_kamar',
        'jumlah_tamu',
    ];

    protected $casts = [
        'foto_kamar' => 'array',
    ];

    public function kamars()
    {
        return $this->hasMany(Kamar::class, 'id_tipe_kamar', 'id_tipe_kamar');
    }
}
