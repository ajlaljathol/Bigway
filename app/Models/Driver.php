<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    /** @use HasFactory<\Database\Factories\DriverFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'vehicle_id',
        'salary_id',
        'user_id',
        'staff_id',
    ];

    // A driver belongs to one vehicle
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // A driver belongs to one salary record
    public function salary()
    {
        return $this->belongsTo(Salary::class);
    }

    // A driver belongs to one user account
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A driver belongs to one staff record
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
