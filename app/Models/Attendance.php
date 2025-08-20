<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    /** @use HasFactory<\Database\Factories\AttendanceFactory> */
    use HasFactory;

    protected $fillable = [
        'student_id',
        'school_id',
        'vehicle_id',
        'date',
        'home_pickup',
        'school_pickup',
        'home_drop',
        'school_drop',
    ];

    public function student()
    {
        return $this->hasOne( Attendance::class);
    }
    public function Route()
    {
        return $this->hasOne( Attendance::class);
    }
}
