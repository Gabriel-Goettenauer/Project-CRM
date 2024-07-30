<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funnel extends Model
{
    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    public function stages()
    {
        return $this->hasMany(Stage::class);
    }
}
