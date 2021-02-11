<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Post extends Model
{
    //
    use CommentableTrait;
    protected $table = 'posts';

    protected $fillable = [
        'topic', 'category_id', 'body', 'photo', 'user_ip'
    ];

    public static function boot() {
        parent::boot();
        static::creating(function ($post){
            $post->slug = Str::slug($post->topic);
        });
    }

    protected $with = ['category'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
      return $this->morphMany(Comment::class,'commentable');
    }
    
    // public function comments()
    // {
    //   return $this->morphMany(Comment::class,'commentable');
    // }
}
