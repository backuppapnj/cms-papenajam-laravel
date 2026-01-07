<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadiusFee extends Model
{
    /** @use HasFactory<\Database\Factories\RadiusFeeFactory> */
    use HasFactory;

    protected $fillable = [
        'region',
        'radius',
        'fee',
        'description',
    ];
}
