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
        'minimum_salary',
        'maximum_salary',
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

    public function getSalaryRangeAttribute($value): ?string
    {
        $min = $this->attributes['minimum_salary'] ?? null;
        $max = $this->attributes['maximum_salary'] ?? null;

        if ($min !== null || $max !== null) {
            $min = $min !== null ? number_format((int) $min) : null;
            $max = $max !== null ? number_format((int) $max) : null;

            if ($min !== null && $max !== null) {
                return "IDR {$min} - {$max}";
            }

            if ($min !== null) {
                return "IDR {$min}";
            }

            if ($max !== null) {
                return "IDR {$max}";
            }
        }

        return $value;
    }
}
