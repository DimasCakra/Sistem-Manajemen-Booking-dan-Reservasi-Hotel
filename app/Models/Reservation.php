<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    protected $fillable = [
        'user_id', 'room_type', 'room_number', 'kamar_id', 'nama_lengkap', 'id_type', 'id_number', 'whatsapp', 
        'email', 'jumlah_tamu', 'check_in_out', 'check_in', 'check_out', 'status', 'total_biaya',
        'nama_tamu_lain', 'id_type_tamu_lain', 'id_number_tamu_lain', 'permintaan_khusus', 'bukti_pembayaran', 'payment_method'
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
    ];

    public function kamar()
    {
        return $this->belongsTo(\App\Models\Kamar::class, 'kamar_id', 'id_kamar');
    }
}