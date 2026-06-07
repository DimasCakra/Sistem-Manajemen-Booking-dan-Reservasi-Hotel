<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamar';
    protected $primaryKey = 'no_kamar';

    // Penting: Karena ID kita buat manual (STD10), bukan auto-increment
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'no_kamar', 'id_tipe_kamar', 'status_kamar'
    ];
    /**
     * Relasi: Un+it kamar ini termasuk ke dalam tipe kamar apa (Belongs To)
     */
    public function tipeKamar()
    {
        return $this->belongsTo(TipeKamar::class, 'id_tipe_kamar', 'id_tipe_kamar');
    }
}
