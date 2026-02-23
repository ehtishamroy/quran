<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'features',
        'price',
        'currency',
        'duration_minutes',
        'days_per_week',
        'is_popular',
        'color_theme',
    ];

    protected $casts = [
        'features' => 'array',
        'is_popular' => 'boolean',
        'price' => 'decimal:2',
    ];
}
