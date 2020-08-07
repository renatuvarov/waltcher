<?php

namespace App\Entities\Blog;

use App\Entities\Model;

class Tag extends Model
{
    protected $table = 'blog_tags';

    public $timestamps = false;

    protected $guarded = ['id'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'blog_tag_post', 'tag_id', 'post_id');
    }

    public function onlyPosts()
    {
        return $this->posts()->onlyPosts();
    }

    public function onlyExhibitions()
    {
        return $this->posts()->onlyExhibitions();
    }
}
