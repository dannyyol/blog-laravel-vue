<?php
namespace App;
use Illuminate\Http\Request;


trait CommentableTrait
{


    public function comments()
    {
      return $this->morphMany(Comment::class,'commentable');
    }

}
