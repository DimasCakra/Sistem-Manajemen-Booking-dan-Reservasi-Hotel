<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    protected $table = 'staffs';

    protected $fillable = [
        'id_admin',
        'id_resepsionis',
        'name',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];
}
