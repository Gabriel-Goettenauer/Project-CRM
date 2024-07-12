<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funnel extends Model
{
    protected $fillable = ['name'];

    public function stages()
    {
        return $this->hasMany(Stage::class);
    }
}
