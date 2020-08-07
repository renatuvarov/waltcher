<?php

namespace App\Http\Requests\Admin\Blog\Tags;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name_ru' => 'nullable|string|min:3|max:30|unique:blog_tags,name_ru,' . $this->tag->id . ',id',
            'name_en' => 'nullable|string|min:3|max:30|unique:blog_tags,name_en,' . $this->tag->id . ',id',
            'slug' => 'nullable|string|min:3|max:30|unique:blog_tags,slug,' . $this->tag->id . ',id',
        ];
    }

    public function messages()
    {
        return [
            'name_ru.string' => 'Некорректное значение',
            'name_ru.min' => 'Минимум 3 символа',
            'name_ru.max' => 'Максимум 30 символов',
            'name_ru.unique' => 'Такое наименование уже существует',

            'name_en.string' => 'Некорректное значение',
            'name_en.min' => 'Минимум 3 символа',
            'name_en.max' => 'Максимум 30 символов',
            'name_en.unique' => 'Такое наименование уже существует',

            'slug.required' => 'Обязательный параметр',
            'slug.string' => 'Некорректное значение',
            'slug.min' => 'Минимум 3 символа',
            'slug.max' => 'Максимум 30 символов',
            'slug.unique' => 'Такое наименование уже существует',
        ];
    }
}
