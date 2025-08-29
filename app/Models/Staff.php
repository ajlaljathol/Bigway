<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'position',
        'cnic',
        'phone',
        'address',
        'salary_id',
        'vehicle_id',
    ];

    /**
     * A staff member belongs to a salary record.
     */
    public function salary()
    {
        return $this->belongsTo(Salary::class);
    }

    /**
     * A staff member may be assigned a vehicle.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Scope for filtering by role.
     */
    public function scopeRole($query, $role)
    {
        return $query->where('role', $role);
    }
}
