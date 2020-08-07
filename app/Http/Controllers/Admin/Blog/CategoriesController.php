<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Entities\Blog\Category;
use App\Handlers\FileManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blog\Categories\CreateRequest;
use App\Http\Requests\Admin\Blog\Categories\UpdateRequest;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index()
    {
        return view('admin.blog.categories.index', [
            'categories' => Category::paginate(2),
        ]);
    }

    public function create()
    {
        return view('admin.blog.categories.create');
    }

    public function store(CreateRequest $request)
    {
        Category::create([
            'name_ru' => $request->input('name_ru'),
            'name_en' => $request->input('name_en'),
            'slug' => Str::slug(mb_strtolower($request->input('slug'))) ?: Str::slug(mb_strtolower($request->input('name_en'))),
        ]);

        return redirect()->route('admin.blog.categories.index');
    }

    public function edit(Category $category)
    {
        return view('admin.blog.categories.edit', compact('category'));
    }

    public function update(UpdateRequest $request, Category $category)
    {
        $category->update([
            'name_ru' => $request->input('name_ru') ?: $category->name_ru,
            'name_en' => $request->input('name_en') ?: $category->name_en,
            'slug' => Str::slug(mb_strtolower($request->input('slug'))) ?: $category->slug,
        ]);

        return redirect()->route('admin.blog.categories.index');
    }

    public function destroy(Category $category, FileManager $manager)
    {
        if (! empty($images = array_filter($category->posts()->pluck('images')->toArray()))) {
            $manager->delete(array_merge(...$images));
        }
        $category->delete();
        return redirect()->route('admin.blog.categories.index');
    }
}
