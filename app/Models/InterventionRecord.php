<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterventionRecord extends Model
{
    public $timestamps = false;
    protected $table = 'intervention_records';
    
    protected $fillable = [
        'date_time_start',
        'address',
        'summary',
        'id_type_intervention',
        'id_fire_station',
        'id_captain',
    ];

    public function interventionType()
    {
        return $this->belongsTo(InterventionType::class, 'id_type_intervention');
    }

    public function fireStation()
    {
        return $this->belongsTo(FireStation::class, 'id_fire_station');
    }

    public function captain()
    {
        return $this->belongsTo(Firefighter::class, 'id_captain');
    }
}
