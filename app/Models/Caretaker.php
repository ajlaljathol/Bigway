<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caretaker extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'staff_id',
        'salary_id',
        'vehicle_id',
    ];

    /**
     * A caretaker belongs to a staff entry.
     */
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    /**
     * A caretaker belongs to a salary.
     */
    public function salary()
    {
        return $this->belongsTo(Salary::class);
    }

    /**
     * A caretaker belongs to a vehicle.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
