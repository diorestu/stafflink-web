<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeddingEvent extends Model
{
    protected $fillable = [
        'couple_names',
        'unique_code',
        'wedding_date',
        'wedding_start_time',
        'wedding_location_address',
        'wedding_venue_name',
        'share_token',
        'is_active',
    ];

    protected $casts = [
        'wedding_date' => 'date',
        'is_active' => 'bool',
    ];
}
