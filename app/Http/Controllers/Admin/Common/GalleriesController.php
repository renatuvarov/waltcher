<?php

namespace App\Http\Controllers\Admin\Common;

use App\Entities\Common\Gallery;
use App\Handlers\FileManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Common\Galleries\CreateRequest;
use App\Http\Requests\Admin\Common\Galleries\UpdateRequest;

class GalleriesController extends Controller
{
    public function index()
    {
        $galleries = Gallery::query()->paginate(config('site.user.pagination'));
        return view('admin.common.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.common.galleries.create');
    }

    public function store(CreateRequest $request, FileManager $manager)
    {
        $gallery = Gallery::create([
            'name' => $request->input('name'),
            'images' => $manager->loadArray($request->file('images'), 'galleries'),
        ]);

        return redirect()->route('admin.common.galleries.show', ['gallery' => $gallery->id]);
    }

    public function show(Gallery $gallery)
    {
        return view('admin.common.galleries.show', compact('gallery'));
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.common.galleries.edit', compact('gallery'));
    }

    public function update(UpdateRequest $request, Gallery $gallery, FileManager $manager)
    {
        $gallery->update([
            'name' => $request->input('name'),
            'images' => array_merge($gallery->images, $manager->loadArray($request->file('images'), 'galleries')),
        ]);

        return redirect()->route('admin.common.galleries.show', ['gallery' => $gallery->id]);
    }

    public function destroy(Gallery $gallery, FileManager $manager)
    {
        $manager->delete($gallery->images);
        $gallery->delete();
        return redirect()->route('admin.common.galleries.index');
    }
}
