<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Post extends Model
{
    use HasFactory, CascadeSoftDeletes, SoftDeletes;

    protected $cascadeDeletes = [
        'posts'
    ];

    protected $fillable = [
        'user_id',
        'heading',
        'content'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function users ()
    {
        return $this->belongsToMany(User::class, 'likeds','post_id', 'user_id');
    }

    public function comments ()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}
