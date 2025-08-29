<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contract_type',
        'payment_status',
        'address',
        'contact_details',
        'charges',
    ];

    /**
     * A school has many students.
     */
    public function students()
    {
        return $this->hasMany(Student::class, 'school_id');
    }

    /**
     * A school has many vehicles.
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'school_id');
    }
}
