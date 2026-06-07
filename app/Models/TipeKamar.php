<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeKamar extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi plural Laravel
    protected $table = 'tipe_kamars';

    // Daftarkan primary key jika nama kolomnya bukan 'id'
    protected $primaryKey = 'id_tipe_kamar';

    protected $fillable = [
        'nama_tipe',
        'kode_tipe',
        'harga_per_malam',
        'deskripsi',
        'foto_kamar',
    ];

    /**
     * Relasi: Satu tipe kamar memiliki banyak unit kamar (1 to Many)
     */
    public function kamars()
    {
        return $this->hasMany(Kamar::class, 'id_tipe_kamar', 'id_tipe_kamar');
    }
}
