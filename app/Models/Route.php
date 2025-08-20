<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    /** @use HasFactory<\Database\Factories\RouteFactory> */
    use HasFactory;

    protected $fillable = [
        'starting_time',
        'total_distance',
        //'vehicle_id',
    ];

  //   public function Vehicle()
   //  {
    //    return $this->hasMany(Route::class);
    // }
}
