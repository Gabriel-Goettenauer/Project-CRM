<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    protected $fillable = ['name', 'funnel_id','user_color'];
    
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function funnel()
    {
        return $this->belongsTo(Funnel::class);
    }
}
