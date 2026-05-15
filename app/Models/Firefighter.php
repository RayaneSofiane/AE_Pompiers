<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Firefighter extends Model
{
    protected $table = 'firefighters';
    protected $fillable = ['matricule', 'id_grade', 'nom', 'prenom', 'id_fire_station'];
    public $timestamps = false;

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'id_grade');
    }

    public function fireStation()
    {
        return $this->belongsTo(FireStation::class, 'id_fire_station');
    }

    public function interventionRecordsAsCaptain()
    {
        return $this->hasMany(InterventionRecord::class, 'id_captain');
    }
}
