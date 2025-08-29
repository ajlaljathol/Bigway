<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'gender',
        'relation',
        'contact_number',
        'user_id',
    ];

    /**
     * A guardian has many students.
     */
    public function students()
    {
        return $this->hasMany(Student::class, 'guardian_id', 'id');
    }

    /**
     * A guardian belongs to a user (the person who created/owns this guardian record).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
