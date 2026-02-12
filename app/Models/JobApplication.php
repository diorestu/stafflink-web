<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'age',
        'religion',
        'province',
        'city',
        'speaks_english',
        'english_level',
        'willing_to_travel',
        'has_motorbike',
        'has_passport',
        'can_drive_car',
        'position_title',
        'resume_path',
        'status',
    ];

    protected $casts = [
        'speaks_english' => 'boolean',
        'willing_to_travel' => 'boolean',
        'has_motorbike' => 'boolean',
        'has_passport' => 'boolean',
        'can_drive_car' => 'boolean',
    ];
}
