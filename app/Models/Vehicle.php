<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    /** @use HasFactory<\Database\Factories\VehicleFactory> */
    use HasFactory;

    protected $fillable = [
        'number_seat',
        'school_id',
        'ownership',
        'caretaker_id',
        'driver_id',
        'number',
        'rent',
        'vehicle_type',
    ];

    public function Student()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function Driver()
    {
        return $this->belongsToMany(Vehicle::class);
    }

    public function Attendance()
    {
        return $this->hasMany(Vehicle::class);
    }
}
