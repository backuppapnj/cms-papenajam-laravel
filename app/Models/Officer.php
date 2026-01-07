<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Officer extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\OfficerFactory> */
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'position',
        'order',
        'level',
    ];
}
