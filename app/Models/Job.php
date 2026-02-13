<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'career_jobs';
    
    protected $fillable = [
        'title',
        'description',
        'location',
        'country',
        'state',
        'type',
        'salary_range',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function getLocationDisplayAttribute(): ?string
    {
        $parts = array_values(array_filter([
            $this->state,
            $this->country,
        ]));

        if (count($parts) > 0) {
            return implode(', ', $parts);
        }

        return $this->location;
    }
}
