<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $table = 'trips';

    protected $fillable = [
        'driver_id','auto_id','title','description',
        'place_from','place_to','distance','trip_start','trip_end',
        'data'
    ];

    protected $casts = [
        'data' => 'array', // Assuming data is stored as JSON
        'trip_start' => 'datetime',
        'trip_end' => 'datetime',
    ];
}
