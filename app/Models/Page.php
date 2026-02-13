<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'status',
        'excerpt',
        'meta_description',
        'content_html',
        'content_css',
        'builder_data',
        'published_at',
    ];

    protected $casts = [
        'builder_data' => 'array',
        'published_at' => 'datetime',
    ];
}
