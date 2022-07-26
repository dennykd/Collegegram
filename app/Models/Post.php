<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use HasTrixRichText;

    protected $guarded = ['id'];

    protected $with = ['author', 'category'];

    public function getRouteKeyName()
    {
        return 'post_code';
    }

    public function isLike($user_id, $post_id)
    {
        return Like::where('user_id', $user_id)->where('post_id', $post_id)->exists();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'post_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
}
