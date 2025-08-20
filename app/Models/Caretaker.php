<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Caretaker extends Model
{
    /** @use HasFactory<\Database\Factories\CaretakerFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'staff_id',
        'user_id',
        'salary_id',
        'vehicle_id',
    ];

    public function Vehicle()
    {
        return $this->belongsTo( Caretaker::class);
    }

    public function Salary()
    {
        return $this->hasOne(Caretaker::class);
    }

    public function User()
    {
        return $this->hasOne(Caretaker::class);
    }
}
