<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileContent extends Model
{
    protected $fillable = [
        'key',
        'title',
        'content',
    ];
}
