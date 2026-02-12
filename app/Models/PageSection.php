<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    protected $fillable = ['section', 'content'];

    protected $casts = [
        'content' => 'array',
    ];

    public static function getSection(string $slug): array
    {
        $section = static::where('section', $slug)->first();

        return $section ? $section->content : [];
    }
}
