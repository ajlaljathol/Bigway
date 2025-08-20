<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    protected $fillabel = [
        'name',
        'emergency_contact',
        'blood_group',
        'address',
        'guardian_id',
        'school_id',
    ];

    public function School()
    {
        return $this->belongsTo(student::class);
    }

    public function Guardian()
    {
        return $this->belongsTo(student::class);
    }

    public function Vehicle()
    {
        return $this->hasOne(student::class);
    }

    public function Attendance()
    {
        return $this->hasOne(student::class);
    }
}
