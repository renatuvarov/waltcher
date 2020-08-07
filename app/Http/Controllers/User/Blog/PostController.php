<?php

namespace App\Http\Controllers\User\Blog;

use App\Entities\Blog\Post;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::query()->onlyPosts()->paginate();
        return view('user.blog.posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load('tags');
        return view('user.blog.posts.show', compact('post'));
    }
}
