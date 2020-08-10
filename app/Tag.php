<?php

namespace App;
use App\Post;
use App\PostTags;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable=['name'];
    public function posts(){
        return $this->belongsToMany(PostTags::class);


    }
}

