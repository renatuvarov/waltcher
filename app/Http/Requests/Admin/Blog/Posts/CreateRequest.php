<?php

namespace App\Http\Requests\Admin\Blog\Posts;

use App\Entities\Blog\Category;
use App\Entities\Blog\Tag;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $tags = implode(',', Tag::pluck('id')->toArray());

        return [
            'title' => 'required|string|min:3|max:255|unique:posts,title',
            'slug' => 'nullable|string|min:3|max:255|unique:posts,slug',
            'tags.*' => 'nullable|integer|in:' . $tags,
            'content' => 'required|string|min:10',
            'short_description' => 'required|string|min:10',
            'meta_description' => 'nullable|string|min:10|max:255',
            'images.*' => 'nullable|string',
            'type' => 'nullable',
            'img' => 'required|file|max:1024|mimes:jpeg,jpg,png',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Обязательный параметр',
            'title.string' => 'Некорректное значение',
            'title.min' => 'Минимум 3 символа',
            'title.max' => 'Максимум 30 символов',
            'title.unique' => 'Такое наименование уже существует',

            'short_description.required' => 'Обязательный параметр',
            'short_description.string' => 'Некорректное значение',
            'short_description.min' => 'Минимум 10 символов',

            'meta_description.max' => 'Максимум 255 символов',
            'meta_description.string' => 'Некорректное значение',
            'meta_description.min' => 'Минимум 10 символов',

            'slug.string' => 'Некорректное значение',
            'slug.min' => 'Минимум 3 символа',
            'slug.max' => 'Максимум 30 символов',
            'slug.unique' => 'Такое наименование уже существует',

            'tags.*.required' => 'Обязательный параметр',
            'tags.*.integer' => 'Некорректное значение',
            'tags.*.in' => 'Такого тэга не существует',

            'content.required' => 'Обязательный параметр',
            'content.string' => 'Некорректное значение',
            'content.min' => 'Минимум 10 символов',
        ];
    }
}
