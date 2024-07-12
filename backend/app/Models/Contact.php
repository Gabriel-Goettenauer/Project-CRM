<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name', 'email', 'stage_id'];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
}
