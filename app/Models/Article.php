<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use Sluggable;
    public function sluggable() : array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    protected $fillable = [
        'title',
        'slug',
        'author',
        'hidden',
        'views',
        'comments',
        'likes',
        'created_at',
        'updated_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsToMany(Category::class);
    }
    public function tag()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function comment() {
        return $this->hasMany(Comment::class);
    }
    public function gallery() {
        return $this->hasOne(Gallery::class);
    }
}
