<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    /** @use HasFactory<\Database\Factories\GuardianFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'num_student',
        'gender',
        'user_id',
    ];

    public function student()
    {
        return $this->hasMany(Guardian::class);
    }

    public function User()
    {
        return $this->hasOne(Guardian::class);
    }
}
