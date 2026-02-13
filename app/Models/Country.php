<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'phonecode',
        'currency',
    ];

    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }
}
