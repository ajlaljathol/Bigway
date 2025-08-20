<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    /** @use HasFactory<\Database\Factories\ExpenseFactory> */
    use HasFactory;

    protected $fillable = [
        'date',
        'amount',
        'description',
        'type',
        'user_id',
        'image',
    ];

    public function User()
    {
        return $this->belongsTo(Expense::class);
    }

    public function Salary()
    {
        return $this->hasOne(Expense::class);
    }
}
