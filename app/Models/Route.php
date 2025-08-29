<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        'starting_time',
        'total_distance',
        // 'vehicle_id',
    ];

    /**
     * Get the vehicle assigned to this route.
     */
  //  public function vehicle()
  //  {
  //      return $this->belongsTo(Vehicle::class);
  //  }
}
