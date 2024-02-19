<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'name',
        'family',
        'email',
        'website',
        'content'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
