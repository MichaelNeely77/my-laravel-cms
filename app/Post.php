<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

use SoftDeletes;

    protected $fillable = [
        'title', 'description', 'content', 'image', 'published_at', 'category_id'
    ];

    /**
     * Delete post image from storage
     * 
     * @returnvoid
     * 
     */




    public function deleteImage () 
    {
        Storage::delete($this->image);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags() 
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * check if post has tag
     * 
     * @return bool
     * 
     */

    public function hasTag($tagId)  
    {
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }
}
