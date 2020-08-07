<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Entities\Blog\Tag;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blog\Tags\CreateRequest;
use App\Http\Requests\Admin\Blog\Tags\UpdateRequest;
use Illuminate\Support\Str;

class TagsController extends Controller
{
    public function index()
    {
        return view('admin.blog.tags.index', [
            'tags' => Tag::paginate(2),
        ]);
    }

    public function create()
    {
        return view('admin.blog.tags.create');
    }

    public function store(CreateRequest $request)
    {
        Tag::create([
            'name' => $request->input('name'),
            'slug' => Str::slug(mb_strtolower($request->input('slug'))) ?: Str::slug(mb_strtolower($request->input('name'))),
        ]);

        return redirect()->route('admin.blog.tags.index');
    }

    public function edit(Tag $tag)
    {
        return view('admin.blog.tags.edit', compact('tag'));
    }

    public function update(UpdateRequest $request, Tag $tag)
    {
        $tag->update([
            'name' => $request->input('name') ?: $tag->name,
            'slug' => Str::slug(mb_strtolower($request->input('slug'))) ?: $tag->slug
        ]);

        return redirect()->route('admin.blog.tags.index');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('admin.blog.tags.index');
    }
}
