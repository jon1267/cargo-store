<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Auto extends Model
{
    protected $table = 'autos';

    protected $fillable = [
        'type', 'car_number', 'description', 'fuel_consumption', 'image', 'is_active', 'data',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'data' => 'array', // Assuming data is stored as JSON
    ];

    public function drivers(): BelongsToMany
    {
        return $this->belongsToMany(Driver::class);
    }
}
