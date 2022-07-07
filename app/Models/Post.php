<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'heading',
        'content'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function users () {
        return $this->belongsToMany(User::class, 'likeds','post_id', 'user_id');
    }

    public function comments () {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, "likeable");
    }
}
