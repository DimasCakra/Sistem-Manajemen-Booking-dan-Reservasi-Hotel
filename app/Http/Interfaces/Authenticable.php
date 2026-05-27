<?php

namespace App\Http\Interfaces;
interface Authenticable

{
    public function login();
    public function logout();
}
