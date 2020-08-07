<?php

namespace App\Http\Controllers\User\Blog;

use App\Entities\Blog\Tag;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        $posts = $tag->onlyPosts()->paginate();
        return view('user.blog.tags.show', compact('tag', 'posts'));
    }
}
