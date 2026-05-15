<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table = 'grades';
    protected $fillable = ['description'];
    public $timestamps = false;

    public function firefighters()
    {
        return $this->hasMany(Firefighter::class, 'id_grade');
    }
}
