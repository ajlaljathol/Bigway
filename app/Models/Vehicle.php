<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'num_seats',
        'school_id',
        'ownership',
        'caretaker_id',
        'driver_id',
        'reg_number',
        'rent',
        'vehicle_type',
        'route_id',
    ];

    /**
     * A vehicle belongs to a school.
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /**
     * A vehicle has a caretaker (staff member with role = caretaker).
     */
    public function caretaker()
    {
        return $this->belongsTo(Staff::class, 'caretaker_id');
    }

    /**
     * A vehicle has a driver (staff member with role = driver).
     */
    public function driver()
    {
        return $this->belongsTo(Staff::class, 'driver_id');
    }

    /**
     * A vehicle belongs to a route.
     */
    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    /**
     * A vehicle can have many students assigned to it.
     */
    public function students()
    {
        return $this->hasMany(Student::class, 'vehicle_id');
    }

    /**
     * A vehicle can have many attendance records.
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
