<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    protected $fillable = [
        'room_type', 'room_number', 'nama_lengkap', 'whatsapp', 
        'email', 'jumlah_tamu', 'check_in_out', 'status', 'total_biaya'
    ];
}