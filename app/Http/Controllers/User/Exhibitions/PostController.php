<?php

namespace App\Http\Controllers\User\Exhibitions;

use App\Entities\Blog\Post;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::query()->onlyExhibitions()->paginate();
        return view('user.exhibitions.posts.index', compact('posts'));
    }

    public function show(string $slug)
    {
        $post = Post::query()->with('tags')->where(['slug' => $slug])->first();
        return view('user.exhibitions.posts.show', compact('post'));
    }
}
