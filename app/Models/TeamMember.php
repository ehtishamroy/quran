<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name',
        'role',
        'bio',
        'image_path',
        'social_links',
        'display_order',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];
}
