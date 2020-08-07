<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Entities\Catalog\Tag;
use App\Handlers\FileManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Catalog\Tags\CreateRequest;
use App\Http\Requests\Admin\Catalog\Tags\UpdateRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::paginate();
        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(CreateRequest $request, FileManager $fileManager)
    {
        Tag::create([
            'name' => mb_strtolower($request->input('name')),
            'slug' => $request->input('slug') ?: Str::slug($request->input('name')),
            'main' => (bool)$request->input('main') ?? false,
            'img' => $fileManager->load($request->file('img'), 'tags'),
        ]);

        return redirect()->route('admin.tag.index');
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(UpdateRequest $request, Tag $tag, FileManager $fileManager)
    {
        if ($request->hasFile('img')) {
            $path = $fileManager->replace($tag->img, $request->file('img'), 'tags');
        }

        $tag->update([
            'name' => mb_strtolower($request->input('name')),
            'slug' => $request->input('slug') ?: Str::slug($request->input('name')),
            'main' => (bool)$request->input('main') ?? false,
            'img' => $path ?? $tag->img,
        ]);

        return redirect()->route('admin.tag.index');
    }

    public function destroy(Tag $tag, FileManager $fileManager)
    {
        $fileManager->delete(Collection::make($tag->img));
        $tag->delete();
        return redirect()->route('admin.tag.index');
    }
}
