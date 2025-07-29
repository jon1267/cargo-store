<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    protected function tripAuto(): Attribute
    {
        return Attribute::make(
            get: fn () => "{$this->type} {$this->car_number}" ?? ''
        );
    }

    public function drivers(): BelongsToMany
    {
        return $this->belongsToMany(Driver::class);
    }

    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }
}
