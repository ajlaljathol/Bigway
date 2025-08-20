<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Staff extends Model
{
    /** @use HasFactory<\Database\Factories\StaffFactory> */
    use HasFactory;

    protected $fillabel = [
        'salaray_id',
        'name',
        'position',
    ];

    public function Salary()
    {
        return $this->hasOne(Salary::class);
    }
}
