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
    ];

    public function Vehicle()
    {
        return $this->belongsToMany( Driver::class);
    }

    public function Salary()
    {
        return $this->hasOne(Driver::class);
    }
}
