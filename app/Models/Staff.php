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
        'email',
        'no_hp',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];
}
