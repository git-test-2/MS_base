<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

//Нужно поменять наследование с Model на Authenticatable, чтобы сработало
class AdminUser extends Authenticatable // с Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password',
    ];

}
