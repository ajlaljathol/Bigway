<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'emergency_contact',
        'blood_group',
        'address',
        'guardian_id',
        'school_id',
        'vehicle_id',
    ];

    /**
     * A student belongs to a school.
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /**
     * A student belongs to a guardian.
     */
    public function guardian()
    {
        return $this->belongsTo(Guardian::class);
    }

    /**
     * A student belongs to a vehicle.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * A student has many attendance records.
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
