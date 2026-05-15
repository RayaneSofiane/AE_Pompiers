<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterventionType extends Model
{
    public $timestamps = false;
    protected $table = 'intervention_types';
    
    protected $fillable = [
        'no_intervention',
        'description',
    ];

    public function interventionRecords()
    {
        return $this->hasMany(InterventionRecord::class, 'id_type_intervention');
    }
}
