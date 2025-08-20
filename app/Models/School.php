<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    /** @use HasFactory<\Database\Factories\SchoolFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'contract_type',
        'payment_status',
        'address',
        'contact',
        'total_amount',
    ];

    public function student()
    {
        return $this->hasMany( School::class);
    }

    public function Vehicle()
    {
        return $this->belongsToMany(School::class);
    }
}
