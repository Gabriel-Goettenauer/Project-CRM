<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Login extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'login';
    protected $fillable = [
        'name',
        'dateOfBirth',
        'phone',
        'email',
        'password',
    ];
}
