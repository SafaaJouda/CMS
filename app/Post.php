<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Tag;
use App\Category;
use App\PostTags;


class Post extends Model
{
    use SoftDeletes;
    protected $fillable=(['title','description','content','image','category_id']);
    //protected $dates = ["deleted_at"];


    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function tags(){
        return $this->belongsToMany(PostTags::class);

    }
    public function hasTag($tagID){

        return in_array($tagID,$this->tags()->pluck('id')->toArray());

    }
}
