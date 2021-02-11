<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    use CommentableTrait;
    protected $table = 'comments';

    protected $fillable = [
        'fullname', 'email', 'body'
    ];

    public function posts()
    {
        return $this->belongsTo(Post::class);
    }

    public function commentable()
    {
        return $this->morphTo();//->sortBy('updated_at', 'asc');
    }
}
