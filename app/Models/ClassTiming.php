<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassTiming extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'time_range',
        'icon',
        'order',
        'is_active',
    ];
}
