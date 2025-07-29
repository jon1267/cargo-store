<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Driver extends Model
{
    protected $table = 'drivers';

    protected $fillable = [
        'first_name','last_name','phone','email','birth_date','image','is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'birth_date' => 'datetime', // Assuming birth_date is stored as a date
    ];

    // need FullName with Phone
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => "{$this->first_name} {$this->last_name} {$this->phone}" ?? ''
        );
    }

    protected function age(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->birth_date ?
                Carbon::createFromDate($this->birth_date)->diff(Carbon::now())->format('%y') :
                null
        );
    }


    public function autos(): BelongsToMany
    {
        return $this->belongsToMany(Auto::class);
    }

    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }
}
