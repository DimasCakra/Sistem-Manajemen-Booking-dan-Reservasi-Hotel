<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    protected $fillable = [
        'user_id', 'room_type', 'room_number', 'nama_lengkap', 'nik', 'whatsapp', 
        'email', 'jumlah_tamu', 'check_in_out', 'status', 'total_biaya',
        'nama_tamu_lain', 'nik_tamu_lain', 'permintaan_khusus', 'bukti_pembayaran', 'payment_method'
    ];
}