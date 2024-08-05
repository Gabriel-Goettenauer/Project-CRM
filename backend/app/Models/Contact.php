<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'cpf',
        'ddd_location',
        'address',
        'date_of_birth',
        'value',
        'stage_id',
    ];
}
