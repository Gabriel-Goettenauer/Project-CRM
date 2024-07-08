<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;

    protected $table = 'login';
    protected $fillable = [
        'name',
        'dateOfBirth',
        'cpf',
        'email',
        'password',
    ];
}
