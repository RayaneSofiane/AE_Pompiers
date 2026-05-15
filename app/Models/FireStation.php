<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FireStation extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'address',
        'city',
        'phone',
        'id_state',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'id_state');
    }
}
