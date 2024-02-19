<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Sluggable;
    public function sluggable() : array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function article()
    {
        return $this->belongsToMany(Article::class);
    }
}
