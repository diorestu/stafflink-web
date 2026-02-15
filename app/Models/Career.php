<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Career extends Model
{
    protected $fillable = [
        'career_category_id',
        'title',
        'description',
        'thumbnail_path',
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(CareerCategory::class, 'career_category_id');
    }

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
