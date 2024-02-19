<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertise extends Model
{
    protected $fillable = [
        'title',
        'content',
        'state',
        'views',
        'slug',
        'created_at',
        'updated_at',
    ];
}
