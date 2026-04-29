<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    protected $table = 'staffs';

    protected $fillable = [
        'id_login',
        'name',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];
}
