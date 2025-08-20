<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    /** @use HasFactory<\Database\Factories\SalaryFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'staff_id',
        'salary',
        'date',
        'expense_id',
    ];

    public function Staff()
    {
        return $this->hasOne(Salary::class);
    }

    public function Expense()
    {
        return $this->hasOne( Salary::class);
    }
}
