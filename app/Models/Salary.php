<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'amount',
        'date',
    ];

    /**
     * Salary belongs to a Staff member
     */
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    /**
     * Salary has one Expense (created automatically)
     */
    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }
}
