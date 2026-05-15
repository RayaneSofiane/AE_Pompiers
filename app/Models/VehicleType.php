<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    protected $table = 'vehicle_types';
    protected $fillable = ['code', 'description'];
    public $timestamps = false;

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'id_type_vehicle');
    }
}
