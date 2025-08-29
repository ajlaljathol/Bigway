<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'amount',
        'description',
        'type',
        'user_id',
        'salary_id', // add if you want to link to salary
        'image',
    ];

    /**
     * The user who created this expense.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The salary associated with this expense (if any).
     */
    public function salary()
    {
        return $this->belongsTo(Salary::class);
    }
}
