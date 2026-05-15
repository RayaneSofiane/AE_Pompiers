<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicles';
    protected $fillable = ['no_identification', 'immatriculation', 'annee_mise_en_service', 'marque', 'modele', 'id_type_vehicle', 'id_fire_station'];
    public $timestamps = false;

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class, 'id_type_vehicle');
    }

    public function fireStation()
    {
        return $this->belongsTo(FireStation::class, 'id_fire_station');
    }
}
